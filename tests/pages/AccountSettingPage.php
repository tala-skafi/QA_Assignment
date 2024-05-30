<?php

namespace Pages;

use Exception;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use PHPUnit\Framework\Assert;

class AccountSettingPage extends BasePage
{
    public function openSettings()
    {
        $this->driver->takeScreenshot(__DIR__ ."\screenshots\partTwo\/" . time() . ".png");
    $button = $this->driver->wait(10)->until(
        WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::className('is-ellipsis-v'))
    );

            $button->click();
        sleep(5);
        $accountSettings=$this->driver->findElement(WebDriverBy::xpath("//a[contains(@class, 'g_id_signout') and contains(text(), 'Account Settings')]"));
        sleep(2);
        $accountSettings->click();
        sleep(2);

    }

    public function deleteAccount()
    {
        $this->driver->takeScreenshot(__DIR__ ."\screenshots\partTwo\/" . time() . ".png");
        $this->driver->takeScreenshot(__DIR__ ."\screenshots\partTwo\/" . time() . ".png");
        $this->driver->executeScript('window.scrollBy(0, 1300);');
        $deleteLink = $this->driver->wait(10)->until(
        WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath("//a[@href='/en/jobseeker/my-account/delete-account/']"))
    );
        sleep(10);
        $deleteLink->click();

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
            $this->driver->takeScreenshot(__DIR__ ."\screenshots\partTwo\/" . time() . ".png");
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
            echo "deleted";
            Assert::assertTrue(true, "account not deleted");


        } catch (Exception $e) {
            echo $e->getMessage();
            Assert::assertFalse(true);

        }

    }

    public function scrollToFooter(): void
    {
        $this->driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');
    }

}