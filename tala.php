<?php
require_once('vendor/autoload.php');

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\WebDriverBy;

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
    // Navigate to a webpage
    $driver->get('https://www.example.com');

    // Get the title of the webpage
    $title = $driver->getTitle();

    // Print the title
    echo "Title of the webpage: $title\n";
} finally {
    // Quit the WebDriver session
   // $driver->quit();
}
?>
