<?php

namespace TestCases;

use Pages\AccountSettingPage;
use Pages\DeleteAccountPage;
use Pages\LoginPage;

class PartTwoTest extends BaseTest
{
    public function testDeleteAccount()
    {
        // initialize pages
        $loginPage = new LoginPage($this->driver);
        $accountPage = new AccountSettingPage($this->driver);
        $deleteAccountPage= new DeleteAccountPage($this->driver);

        //open
        $loginPage->open();
        $this->takeScreen();

        //accept cookies
        $loginPage->acceptCookies();

        //login
        $loginPage->login();
        $this->takeScreen();

        //open settings
        $accountPage->openSettings();
        $this->takeScreen();

        //delete account
        $accountPage->goToDelete();
        $this->takeScreen();

        $deleteAccountPage->deleteAccount();
        $this->takeScreen();

    }

    private function takeScreen(): void
    {
        $this->driver->takeScreenshot(__DIR__ . "\screenshots\partTwo\/" . time() . ".png");
    }


}