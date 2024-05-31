<?php

namespace Pages;


use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;


class AccountSettingPage extends BasePage
{
    public function openSettings()
    {
        $button = $this->driver->wait(10)->until(
            WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::className('is-ellipsis-v'))
        );

        $button->click();
        sleep(5);
        $accountSettings = $this->driver->findElement(WebDriverBy::xpath("//a[contains(@class, 'g_id_signout') and contains(text(), 'Account Settings')]"));
        sleep(2);
        $accountSettings->click();
        sleep(2);

    }

    public function goToDelete()
    {
        $this->driver->executeScript('window.scrollBy(0, 1300);');
        $deleteLink = $this->driver->wait(10)->until(
            WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath("//a[@href='/en/jobseeker/my-account/delete-account/']"))
        );
        sleep(10);
        $deleteLink->click();

    }

    public function scrollToFooter(): void
    {
        $this->driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');
    }

}