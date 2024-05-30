<?php

namespace Pages;

use Exception;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use PHPUnit\Framework\Assert;
use utils\TestUtils;

class LoginPage extends BasePage
{

    public function open(): void
    {
        $url = TestUtils::getJsonData("URLs")["login"];
        $this->driver->get($url);


    }
    public function login(): void
    {
        $userData=TestUtils::getJsonData("UsersData")[0];
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('LoginForm_username')));
        $this->driver->findElement(WebDriverBy::id('LoginForm_username'))->sendKeys($userData["email"]);
        $this->driver->findElement(WebDriverBy::id('LoginForm_password'))->sendKeys($userData["password"]);
        $this->driver->takeScreenshot(__DIR__ ."\screenshots\partTwo\/" . time() . ".png");
        $this->driver->findElement(WebDriverBy::id('login-button'))->click();
        try{
            $this->driver->wait(10)->until(
                WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className('g_id_signout'))
            );
            Assert::assertTrue(true, "User is logged in");
            $this->driver->takeScreenshot(__DIR__ ."\screenshots\partTwo\/" . time() . ".png");
        }
        catch (Exception $e) {
            // Class not found or other error occurred
            echo "not logged in";
            $this->driver->takeScreenshot(__DIR__ ."\screenshots\partTwo\/" . time() . ".png");
            Assert::assertTrue(false, "User is not logged in");

        }








    }
    public function scrollToFooter(): void
    {
        $this->driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');
    }

}