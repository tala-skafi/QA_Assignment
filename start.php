<?php
require_once('vendor/autoload.php');

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

// Set the path to the ChromeDriver executable
$chromeDriverPath = 'C:\\Users\\user\\Downloads\\chromedriver-win64\\chromedriver-win64\\chromedriver.exe';

// Set Chrome options
$options = new ChromeOptions();
// Add any additional options if needed
// $options->addArguments([...]);

// Set desired capabilities
$capabilities = DesiredCapabilities::chrome();
$capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

// Start a new WebDriver session with local ChromeDriver
$driver = RemoteWebDriver::create('http://localhost:9515', $capabilities);

try {
    // Open the Bayt.com website
    $driver->get('https://www.bayt.com');

    // Scroll down to make the "About Us" link visible
    $driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');
    sleep(2);
    $aboutUsLink = $driver->wait()->until(
        WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//a[text()="About Us"]'))
    );
    $aboutUsLink->click();
    sleep(2);
    $driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');
    sleep(2);
    $fisrtJobCategory = $driver->wait()->until(
        WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="yw1"]/li[1]/a'))
    );
    $fisrtJobCategory->click();
    sleep(5);

} finally {
    $driver->quit();
}
?>
