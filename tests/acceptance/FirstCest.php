<?php

class FirstCest
{

    public function tryToRegisterFbWithEmail(AcceptanceTester $I)
    {
        $I->amOnPage('/test_ambassador_mihail_m');
        $I->executeJS("localStorage.setItem('referrer', 9);");
        $I->executeJS("document.querySelector('.rcl-login').click();");
        $I->executeJS("document.querySelector('.rcl-login').click();");
        $I->executeJS("document.querySelector('.btn-facebook').click();");
        $I->wait(3);
        $I->submitForm('#login_form', array(
                'email' => 'wordpress.full.stack@gmail.com',
                'pass' => 'dskllfhjhewfrehOPHG%^&789',
            )
        );
        $I->wait(3);
        if ($I->tryToSeeElement('div[aria-label="Продолжить как Ильядев"]')) {
            $I->click('div[aria-label="Продолжить как Ильядев"]');
        }
        $I->seeElementInDOM('#recallbar');
        $I->deleteUser($I);
        $I->FBLogout($I);
    }

    /* Работает FBLogin1 */
    public function FBLogin1(AcceptanceTester $I)
    {
        $I->amOnPage('/test_ambassador_mihail_m');
        $I->executeJS("localStorage.setItem('referrer', 9);");
        $I->executeJS("document.querySelector('.rcl-login').click();");
        $I->executeJS("document.querySelector('.btn-facebook').click();");
        $I->submitForm('#login_form', array(
                'email' => 'bengreym@gmail.com',
                'pass' => '!lutsk123ns=',)
        );
        if ($I->tryToSeeElement('div[aria-label="Продолжить как Ильядев"]')) {
            $I->click('div[aria-label="Продолжить как Ильядев"]');
        }
        $I->wait(3);
        $I->seeElement('#wpadminbar');
        $I->FBLogout($I);
    }
    /*       */

    /* Работает makeProject */
    public function makeProject($I)
    {
        $I->amOnPage('/test_ambassador_mihail_m');
        $I->executeJS("localStorage.setItem('referrer', 9);");
        $I->executeJS("document.querySelector('.rcl-login').click();");
        $I->executeJS("document.querySelector('.btn-facebook').click();");
        if ($I->tryToSeeElement('#login_form')) {
            $I->submitForm('#login_form', array(
                    'email' => 'bengreym@gmail.com',
                    'pass' => '!lutsk123ns=',)
            );
        }
        $I->executeJS("document.querySelector('.pr_sub_menu .rcb_line:nth-child(2) a').click();");
        $I->wait(3);
        $I->click('#tab-button-postform>a');
        $I->wait(3);
        $elementsarr = array(
            'input#category-424',
            'input#category-410',
            'input#category-415',
            'input#category-842',
            'input#category-166',
            '.rcl-checkbox-box:nth-child(2)>input[type=checkbox]'
        );
        $I->wait(3);
        $I->executeJS('document.querySelector("#rcl-publish-post").removeAttribute("disabled")');
        $I->executeJS('document.querySelectorAll(".rcl-checkbox-box:nth-child(2)>input").forEach(el=>el.click())');
        $I->executeJS('document.querySelectorAll(".rcl-radio-box:nth-child(2)>input").forEach(el=>el.click())');

        $I->fillField('post_title', 'Тестовый пост');
        $I->executeJS('document.querySelector(".next-step").click()');
        /* Step 2 */
        $I->wait(8);
        $I->executeJS('document.querySelector(".next-step").click()');
        /* Step 3 */
        $I->wait(8);
        $I->executeJS('document.querySelector(".next-step").click()');
        /* Step 4 */
        $I->wait(8);
        $I->fillField('summa_investicij_kotorye_nuzhny_biznesu_38', '3'); //4
        $I->fillField('minimum_business_ready_to_get', '3'); //4
        $I->fillField('now_collected_money', '3'); //4
        $I->fillField('posle_kakogo_kolichestva_deneg_nachnetsya_vypolnenie_plana_razvitiya_14', '3'); //4
        $I->fillField('vlozheno_svoih_deneg', '3'); //4
        $I->fillField('dohodnost_v_god_dlya_investora_kreditora', '3'); //4
        $I->fillField('srok_investiciy_let', '3'); //4
        $I->fillField('srok_investicij_maksimum_let_95', '3'); //4

        $I->executeJS('document.querySelector(".next-step").click()');
        /* Step 5 */
        $I->wait(8);
        $I->executeJS('document.querySelector("input[name=data_osnovaniya_biznesa_19]").value = \'2021-06-03\''); //5

        $I->executeJS('document.querySelector(".next-step").click()');
        /* Step 6 */
        $I->wait(8);
        $I->fillField('purpose_of_inv_please', '3'); //6

        $I->executeJS('document.querySelector(".next-step").click()');
        /* Step 7 */
        $I->wait(8);
        $I->executeJS('document.querySelector(".next-step").click()');
        /* Step 8 */
        $I->wait(8);
//        $I->wait(100);

        $I->executeJS('document.querySelector("#rcl-publish-post").click()');
        $I->wait(8);
        $I->deletePost($I);
    }
}
