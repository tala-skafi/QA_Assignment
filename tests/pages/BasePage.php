<?php
namespace Pages;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class BasePage {
    protected $driver;

    public function __construct(RemoteWebDriver $driver) {
        $this->driver = $driver;
    }
    public function acceptCookies(): void
    {
        $button = $this->driver->wait(10)->until(
            WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath("//button[contains(@class, 'cky-btn-accept') and contains(text(), 'Accept all cookies')]"))
        );

        $button->click();
    }
}
