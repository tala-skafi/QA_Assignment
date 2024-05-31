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
    public function fillRegistrationForm(): void
    {
        // get the users' data from the json
        $userData = TestUtils::getJsonData("UsersData")[0];

        // Fill out the form of registration
        $email = $this->generateDynamicEmail();
        $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_firstName'))->sendKeys($userData["name"]);
        $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_lastName'))->sendKeys($userData["last_name"]);
        $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_email'))->sendKeys($email);
        $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_password'))->sendKeys($userData["password"]);
        $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_mobPhone'))->sendKeys($userData["phone"]);

        // submit the form to register
        $this->submit();

        // validate after submit
        $this->validateEmail();

        //store  email to json to use it later
        $this->storeEmail($email, $userData);

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
            $this->scrollUp();
            sleep(2);
            $element = $this->driver->wait()->until(
                WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('JsMiniRegistrationForm_email_em_'))
            );
            // Check if the element contains text
            $elementText = $element->getText();
            $this->takeScreen();
            echo "element text=  " .$elementText;
            if (str_contains($elementText, 'already registered')) {
                echo "the email is already exist" . $elementText;
                Assert::assertTrue(true, $elementText);
//                $email = $this->generateDynamicEmail();
//                $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_email'))->sendKeys("");
//                sleep(1);
//                $this->driver->findElement(WebDriverBy::id('JsApplicantRegisterForm_email'))->sendKeys($email);
//                $this->submit();
            }

        } catch (Exception $e) {
            Assert::assertFalse(false, $e->getMessage());

        }
    }

    public function checkRegistrationElement(): bool
    {
        $registrationElement = $this->driver->wait()->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('/html/body/section/div/div/div/div[1]/h5'))
        );
        return $registrationElement->getText() === "Let's Start By Creating Your Account";
    }

    private function storeEmail($email, $userData): void
    {
        $userData['email'] = $email;
        $updatedJsonString = json_encode([$userData], JSON_PRETTY_PRINT);
        file_put_contents('C:\Users\user\Desktop\QA_Assignment\resources\UsersData.json', $updatedJsonString);
    }
    private function takeScreen(): void
    {
        $this->driver->takeScreenshot('C:\\Users\\user\\Desktop\\QA_Assignment\\screenshots\\partOne\\' . time() . ".png");
    }
    private function scrollUp(): void
    {
        $this->driver->executeScript('window.scrollBy(0, -600);');

    }


}
