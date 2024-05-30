<?php

namespace TestCases;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Pages\HomePage;
use Pages\AboutUsPage;
use Pages\JobApplicationPage;
use Pages\JobsPage;
use Pages\RegistrationPage;


class PartOneTest extends BaseTest
{
    /**
     */
    public function testApplyForJob()
    {
        $homePage = new HomePage($this->driver);
        $aboutUsPage = new AboutUsPage($this->driver);
        $jobApplicationPage = new JobApplicationPage($this->driver);
        $jobPage = new JobsPage($this->driver);
        $registrationPage = new RegistrationPage($this->driver);

        //open
        $homePage->open();

        //accept cookies
        $homePage->acceptCookies();


        $homePage->scrollToFooter();
        sleep(3);
        $this->driver->takeScreenshot(__DIR__ . "\screenshots\partOne\/" . time() . ".png");
        $homePage->clickAboutUs();
        sleep(2);
        //the way we can reach jobs without going to careers website
        $aboutUsPage->clickFirstJobCategory();
        $this->driver->takeScreenshot(__DIR__ . "\screenshots\partOne\/" . time() . ".png");
        sleep(2);
        $jobPage->clickFirstJob();
        sleep(2);
        $this->driver->takeScreenshot(__DIR__ . "\screenshots\partOne\/" . time() . ".png");
        $jobPage->clickApply(false);
        sleep(2);
        $this->driver->takeScreenshot(__DIR__ . "\screenshots\partOne\/" . time() . ".png");
        $registrationPage->fillRegistrationForm();
        sleep(2);
        // After successful registration, fill out the forms and ensure the job is applied successfully
        $jobApplicationPage->fillForm();
    }


}
