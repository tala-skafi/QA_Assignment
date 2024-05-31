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
        // initialize pages
        $homePage = new HomePage($this->driver);
        $jobPage = new JobsPage($this->driver);
        $jobApplicationPage = new JobApplicationPage($this->driver);
        $registrationPage = new RegistrationPage($this->driver);

        // change wo mobile size
        BaseTest::modifyWindowToMobileSize();

        //open
        $homePage->open();
        $this->takeScreen();

        //accept cookies
        $homePage->acceptCookies();

        //search job
        $homePage->searchJob("Quality Assurance Engineer", "United Arab Emirates");
        $this->takeScreen();

        $jobPage->clickFirstJob();
        $this->takeScreen();

        $jobPage->clickApply(true);
        $this->takeScreen();

        $registrationPage->fillRegistrationForm();
        $this->takeScreen();

        $jobApplicationPage->fillForm();
        $this->takeScreen();


    }

    private function takeScreen(): void
    {
        $this->driver->takeScreenshot('C:\\Users\\user\\Desktop\\QA_Assignment\\screenshots\\partThree\\' . time() . ".png");
    }

}