<?php

namespace TestCases;

use Facebook\WebDriver\WebDriverDimension;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;

class BaseTest extends TestCase
{
    protected $driver;

    protected function setUp(): void
    {
        $options = new ChromeOptions();
        //$options->addArguments(['--headless']);
        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);
        $this->driver = RemoteWebDriver::create('http://localhost:9515', $capabilities);
        $this->driver->manage()->window()->maximize();

    }

    protected function modifyWindowToMobileSize(): void
    {
        $this->driver->manage()->window()->setSize(new WebDriverDimension(480, 800));
    }

    protected function tearDown(): void
    {
        $this->driver->quit();
    }
}
