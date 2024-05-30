<?php
namespace Pages;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class AboutUsPage extends BasePage {

    public function clickFirstJobCategory(): void
    {
        $this->driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');
        sleep(2);
        $firstJobCategory = $this->driver->wait()->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="yw1"]/li[1]/a'))
        );
        $firstJobCategory->click();
    }


}
