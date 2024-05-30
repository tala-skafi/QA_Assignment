<?php

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\WebDriverDimension;
use Pages\HomePage;
use Pages\JobApplicationPage;
use Pages\JobsPage;
use Pages\RegistrationPage;
use TestCases\BaseTest;

class PartThreeTest extends BaseTest
{
    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function testApplyForJob()
    {
        BaseTest::modifyWindowToMobileSize();
        $homePage=new HomePage($this->driver);
        $jobPage=new JobsPage($this->driver);
        $jobApplicationPage=new JobApplicationPage($this->driver);
        $registrationPage=new RegistrationPage($this->driver);
        //open
        $homePage->open();
        $this->driver->takeScreenshot(__DIR__ ."\screenshots\partThree\/" . time() . ".png");

        //accept cookies
        $homePage->acceptCookies();

        //search job
        $homePage->searchJob("Quality Assurance Engineer","United Arab Emirates");
        $jobPage->clickFirstJob();
        $jobPage->clickApply(true);
        $registrationPage->fillRegistrationForm();
        $jobApplicationPage->fillForm();


    }

}