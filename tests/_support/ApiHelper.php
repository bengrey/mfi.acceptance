<?php
class ApiHelper extends \Codeception\Module
{
    public function _beforeSuite(AcceptanceTester $I) {
        var_dump($I);
        die();
    }
}