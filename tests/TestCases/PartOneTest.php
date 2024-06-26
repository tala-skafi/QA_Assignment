<?php

namespace TestCases;

use Pages\HomePage;
use Pages\AboutUsPage;
use Pages\JobApplicationPage;
use Pages\JobsPage;
use Pages\RegistrationPage;


class PartOneTest extends BaseTest
{
    public function testApplyForJob()
    {
        //initialize pages
        $registrationPage = new RegistrationPage($this->driver);
        $jobApplicationPage = new JobApplicationPage($this->driver);

        //choose a job to apply
        $this->chooseJob();

        //register new account
        $registrationPage->fillRegistrationForm();
        $this->takeScreen();

        // After successful registration, apply to the job and make sure it's applied successfully
//        $this->driver->get("file:///C:/Users/user/Downloads/Complete%20Your%20CV%20-%20Bayt.com.html");
        $jobApplicationPage->fillForm();
        $this->takeScreen();
    }

    private function chooseJob(): void
    {
        // initialize pages
        $homePage = new HomePage($this->driver);
        $aboutUsPage = new AboutUsPage($this->driver);
        $jobPage = new JobsPage($this->driver);

        //open
        $homePage->open();
        $this->takeScreen();

        //accept cookies
        $homePage->acceptCookies();
        $this->takeScreen();

        $homePage->scrollToFooter();
        $this->takeScreen();

        $homePage->clickAboutUs();
        $this->takeScreen();

        //the way we can reach jobs without going to careers website
        $aboutUsPage->clickFirstJobCategory();
        $this->takeScreen();

        $jobPage->clickFirstJob();
        $this->takeScreen();

        $jobPage->clickApply(false);
        $this->takeScreen();
    }

    private function takeScreen(): void
    {
        $this->driver->takeScreenshot('C:\\Users\\user\\Desktop\\QA_Assignment\\screenshots\\partOne\\' . time() . ".png");
    }


}
