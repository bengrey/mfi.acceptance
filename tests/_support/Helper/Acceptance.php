<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\TestInterface;
use \Codeception\Events;

class Acceptance extends \Codeception\Module
{
    public function FBLogout($I)
    {
        $I->executeJS('window.location="https://m.facebook.com/"');
        $I->wait(3);
        $I->executeJS("setTimeout(function() {
        document.querySelector('#bookmarks_jewel>a').click();
        console.log('clicked bookmarks_jewel');
        }, 3000)");
        $I->wait(3);
        $I->executeJS("setTimeout(function() {
                document.querySelector('a[data-sigil=\"logout\"]').click()
        console.log('clicked logout');
        }, 3000)");
        if ($I->tryToSeeElement('button[value="Сохранить и выйти"]')) {
            $I->click('button[value="Сохранить и выйти"]');
        }
        $I->wait(3);
        $I->executeJS('window.location="https://investments.mentorsflow.com/test_ambassador_mihail_m/"');
    }
    public function getCurrentUrl()
    {
        return $this->getModule('WebDriver')->_getUrl().$this->getModule('WebDriver')->_getCurrentUri();
    }

    public function deleteUser($I) {
        $I->executeJS("document.querySelector('.pr_sub_menu .rcb_line:nth-child(2) a').click();");
        $I->wait(3);
        $fullurl = parse_url($I->getCurrentUrl());
        parse_str($fullurl['query'], $result);
        $id = $result['user'];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://investments.mentorsflow.com/wp-json/dcp3450/test_endpoint2/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                "delete" => $id,
                'action' => 'user_deleter',
            )
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        var_dump($server_output);

        curl_close ($ch);
    }

    public function deletePost($I) {
        $I->wait(3);
        $I->executeJS("document.querySelector('.post-edit-link').click();");
        $fullurl = parse_url($I->getCurrentUrl());
        parse_str($fullurl['query'], $result);
        $id= $result['rcl-post-edit'];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://investments.mentorsflow.com/wp-json/dcp3450/test_endpoint/");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                "delete" => $id,
                'action' => 'deleter_post',
            )
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        var_dump($server_output);

        curl_close ($ch);
    }

}
