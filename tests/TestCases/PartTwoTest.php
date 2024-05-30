<?php

namespace TestCases;

use Pages\AccountSettingPage;
use Pages\LoginPage;

class PartTwoTest extends BaseTest
{
    public function testDeleteAccount()
    {
        $loginPage = new LoginPage($this->driver);
        $account = new AccountSettingPage($this->driver);

        //open
        $loginPage->open();
        $this->driver->takeScreenshot(__DIR__ ."\screenshots\partTwo\/" . time() . ".png");

        //accept cookies
        $loginPage->acceptCookies();

        //login
        $loginPage->login();


        //open settings
        $account->openSettings();

        //delete account
        $account->deleteAccount();

    }


}