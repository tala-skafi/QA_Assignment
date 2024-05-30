<?php

namespace Pages;

use Exception;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use PHPUnit\Framework\Assert;
use utils\TestUtils;


class RegistrationPage extends BasePage
{
    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     * @throws Exception
     */
    public function checkRegistrationElement() :bool
    {
        $registrationElement = $this->driver->wait()->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('/html/body/section/div/div/div/div[1]/h5'))
        );
        return $registrationElement->getText() === "Let's Start By Creating Your Account";
    }

    public function fillRegistrationForm(): void
    {
        $this->driver->takeScreenshot(__DIR__ ."\screenshots\partOne\/" . time() . ".png");
        $userData = TestUtils::getJsonData("UsersData")[0];
        // Fill out the form of registration
        $email = $this->generateDynamicEmail();
//        $email = "talaskafi1992@gmail.com";
        $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_firstName'))->sendKeys($userData["name"]);
        $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_lastName'))->sendKeys($userData["last_name"]);
        $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_email'))->sendKeys($email);
        $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_password'))->sendKeys($userData["password"]);
        $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_mobPhone'))->sendKeys($userData["phone"]);
        $this->driver->takeScreenshot(__DIR__ ."\screenshots\RegistrationForm\/" . time() . ".png");
        $this->driver->takeScreenshot(__DIR__ ."\screenshots\partThree\/" . time() . ".png");

        // submit the form to register
        $this->submit();
        // validate after submit
        $this->validateEmail();

        //store  email
        $userData['email'] = $email;
        $updatedJsonString = json_encode([$userData], JSON_PRETTY_PRINT);
        file_put_contents('C:\Users\user\Desktop\QA_Assignment\resources\UsersData.json', $updatedJsonString);

    }
    private function submit(): void
    {
        $this->driver->executeScript('window.scrollBy(0, 600);');
        sleep(2);
        $registerButton = $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('register')));
        $registerButton->click();
    }

    private function generateDynamicEmail()
    {
        return 'testuser' . time() . '@gmail.com';
    }

    private function validateEmail(): void
    {
        try {
            $element = $this->driver->findElement(WebDriverBy::id('JsMiniRegistrationForm_email_em_'));
            // Check if the element contains text
            $elementText = $element->getText();
            if (!empty(trim($elementText))) {
                echo "the email is already exist" . $elementText;
                $this->driver->takeScreenshot(__DIR__ ."\screenshots\RegistrationForm\/" . time() . ".png");
                Assert::assertStringContainsString('Email is already registered', $elementText);
                $email = $this->generateDynamicEmail();
                $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_email'))->sendKeys("");
                sleep(1);
                $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_email'))->sendKeys($email);
                $this->submit();
            }

        } catch (Exception $e) {
            Assert::assertFalse(false, $e->getMessage());

        }
    }


}
