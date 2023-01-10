<?php
$message = 'test';
   $chatid = 335765864;
   $token = '1676752364:AAGGiloYgE49Z0Y1-0FwOKZbCiujaw3qORU';
   $url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chatid}&text=";
   $url .= urlencode($message);
   $ch = curl_init();
   var_dump($url);
   $options = array(
       CURLOPT_URL => $url,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_SSL_VERIFYHOST => false,
       CURLOPT_SSL_VERIFYPEER => false,
   );
   curl_setopt_array($ch, $options);
   $result = curl_exec($ch);
   curl_close($ch);
?>