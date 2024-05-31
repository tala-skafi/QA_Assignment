<?php

namespace Pages;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;

class HomePage extends BasePage
{
    public function open()
    {
        $this->driver->get('https://www.bayt.com');
    }

    public function scrollToFooter(): void
    {
        $this->driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');
        sleep(3);
    }

    public function searchJob($title, $location): void
    {

        $searchBox = $this->driver->findElement(WebDriverBy::id('text_search'));

        sleep(2);
        $searchBox->click();
        sleep(2);
        $this->driver->getKeyboard()->sendKeys($title . WebDriverKeys::ENTER);
        sleep(2);
        $locationBox = $this->driver->findElement(WebDriverBy::id('search_country__r'));
        $locationBox->click();
        sleep(2);
        $this->driver->getKeyboard()->sendKeys($location . WebDriverKeys::ENTER);
        $firstChoice = $this->driver->findElement(WebDriverBy::xpath('/html/body/div[10]/div[1]/div[3]/ul/li[1]'));
        $firstChoice->click();
        $submitButton = $this->driver->wait()->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="form"]/div/div[3]/button'))
        );
        $submitButton->click();

    }

    public function clickAboutUs(): void
    {
        $aboutUsLink = $this->driver->wait()->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//a[text()="About Us"]'))
        );
        $aboutUsLink->click();
        sleep(2);
    }
}
