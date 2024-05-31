<?php

namespace Pages;

use Exception;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class BasePage
{
    protected $driver;

    public function __construct(RemoteWebDriver $driver)
    {
        $this->driver = $driver;
    }

    public function acceptCookies(): void
    {
        try {
            $button = $this->driver->wait(10)->until(
                WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath("/html/body/div[2]/div/div[2]/div/div[2]/button[2]"))
            );

            $button->click();
        } catch (NoSuchElementException $e) {
            echo "The element is not found.\n";
        } catch (TimeoutException $e) {
            echo "A timeout occurred while waiting for the element to be clickable.\n";


        } catch (Exception $e) {
        }
    }

}
