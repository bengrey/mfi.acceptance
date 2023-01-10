<?php

/**
 * Created by AutoTestSquared
 */

namespace Codeception\Extension;

class Failure extends \Codeception\Extension
{

    public static $receivers;

    function __construct() {
        Failure::$receivers = [454255748, 335765864];
    }


    public static $events = ["result.print.after" => "printData"];

    public function printData(\Codeception\Event\PrintResultEvent $e) {
        if (@file_get_contents("tests\_output\\failed")) {
            try {
                $errormessage = file_get_contents("tests\_output\\failed");
                $testsarr = [
                    'FbLogin1' => '1. Залогиниться через Fb получилось (ак с E-mail)',
                    // 'FbLoginPhone' => '2. Залогиниться через Fb получилось (ак БЕЗ e-mail, а только с мобильным)',
                    'tryToRegisterFbWithEmail' => '3. Зарегаться чрез Fb (ак с E-mail)',
                    // 'tryToRegisterFbWithPhone' => '4. Зарегаться чрез Fb (ак БЕЗ e-mail, а только с мобильным)',
                    'makeProject' => '5. Опубликовать проект получилось'
                ];
                $message = "Тестирование investments.mentorsflow.com в acceptance провалено. \n";
                foreach ($testsarr as $key=>$value) {
                    if(strpos($errormessage, $key)) {
                        $message.=$value." - не получилось \n";
                    }else {
                        $message.=$value." - получилось \n";
                    }
                }

                foreach (Failure::$receivers as $receiverid) {
                    $this->sendMessage($message, $receiverid);
                }

            } catch (e $ex) {

            }
        }else {
            $message = "Тестирование investments.mentorsflow.com в acceptance успешно завершено. \n
1. Залогиниться через Fb получилось (ак с E-mail) - получилось \n
3. Зарегаться чрез Fb (ак с E-mail) - получилось \n
5. Опубликовать проект - получилось";

            foreach (Failure::$receivers as $receiverid) {
                $this->sendMessage($message, $receiverid);
            }
        }
    }

    private function sendMessage($message, $receiverid) {
        $token = '1676752364:AAGGiloYgE49Z0Y1-0FwOKZbCiujaw3qORU';
        $url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$receiverid}&text=";
        $url .= urlencode($message);
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}