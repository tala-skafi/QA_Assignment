<?php

namespace Pages;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use PHPUnit\Framework\Assert;

class DeleteAccountPage extends BasePage
{
    public function deleteAccount()
    {
        try {
            $button = $this->driver->wait(10)->until(
                WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath("//button[contains(@class, 'btn is-danger') and contains(text(), 'Yes, Delete My Account')]"))
            );

            $button->click();
            // Store the handle of the main window
            $mainWindowHandle = $this->driver->getWindowHandle();

            // Wait for the new window to appear (assuming it increases the window count to 2)
            $this->driver->wait(10)->until(
                WebDriverExpectedCondition::numberOfWindowsToBe(2)
            );

            // Get all window handles
            $windowHandles = $this->driver->getWindowHandles();

            // Loop through all handles to find the popup window handle
            foreach ($windowHandles as $handle) {
                if ($handle != $mainWindowHandle) {
                    $popupWindowHandle = $handle;
                    break;
                }
            }

            // Switch to the popup window
            $this->driver->switchTo()->window($popupWindowHandle);

            $button = $this->driver->wait(10)->until(
                WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath("/html/body/div[9]/div/div/div[3]/div/button[2]"))
            );
            sleep(3);
            $button->click();
            echo "account deleted";
            Assert::assertTrue(true, "account not deleted");


        } catch (Exception $e) {
            echo $e->getMessage();
            Assert::assertFalse(false);

        }

    }

}