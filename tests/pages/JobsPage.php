<?php

namespace Pages;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use PHPUnit\Framework\Assert;

class JobsPage extends BasePage
{
    public function clickFirstJob(): void
    {
        $firstJobCategory = $this->driver->wait()->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="results_inner_card"]/ul/li[2]'))
        );
        $firstJobCategory->click();

    }

    public function clickApply($isMobile): void
    {
        $registrationPage = new RegistrationPage($this->driver);
        if ($isMobile) {
            $by = WebDriverBy::xpath('//*[@id="view_inner"]/div/div[1]/div[5]/div[1]/div[1]');
        } else {
            $by = WebDriverBy::id('applyLink_1');
        }
        $applyButton = $this->driver->wait()->until(
            WebDriverExpectedCondition::visibilityOfElementLocated($by)
        );
        $applyButton->click();

        Assert::assertTrue($registrationPage->checkRegistrationElement(), "Registration form is not displayed");

    }

}
