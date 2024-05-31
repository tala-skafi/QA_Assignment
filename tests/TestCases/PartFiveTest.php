<?php

namespace TestCases;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use Pages\PostJobPage;
use utils\TestUtils;

class PartFiveTest extends BaseTest
{

    // Functionality testing
    public function testFunctionality()
    {
        // Test functionality of the post job form submission
        // Assert that the form submits successfully and redirects to the expected page
        // Assert that buttons, links, and other elements behave as expected

        $postJobPage = new PostJobPage($this->driver);

        //open
        $postJobPage->open("english");
        $this->takeScreen();

        //accept cookies
        $postJobPage->acceptCookies();

        // get a job data to fill the form
        $JobData = TestUtils::getJsonData("JobsData")[0];
        $this->assertTrue($postJobPage->fillPostJobForm($JobData), "failed to fill post job form");
        echo "functionality is working well";
    }

    //UI/UX testing
    public function testUIUX()
    {
        // Test UI/UX elements and interactions
        // Assert that all form fields are visible and interactable

        $postJobPage = new PostJobPage($this->driver);
        //open
        $postJobPage->open("english");
        $this->takeScreen();

        //accept cookies
        $postJobPage->acceptCookies();

        $elements = [
            'jobTitle' => WebDriverBy::xpath('//*[@id="QaTestFormModel_job_title"]'),
            'jobIndustries' => WebDriverBy::id('QaTestFormModel_job_industries__r'),
            'careerLevel' => WebDriverBy::id('QaTestFormModel_job_career_level__r'),
            'minExperience' => WebDriverBy::xpath('//*[@id="QaTestFormModel_job_min_experience"]'),
            'maxExperience' => WebDriverBy::xpath('//*[@id="QaTestFormModel_job_max_experience"]'),
            'remoteWorkingTypeLabel2' => WebDriverBy::xpath('//*[@id="QaTestFormModel_remote_working_type"]/label[2]'),
            'remoteWorkingTypeLabel1' => WebDriverBy::xpath('//*[@id="QaTestFormModel_remote_working_type"]/label[1]'),
            'jobDesc' => WebDriverBy::xpath('//*[@id="QaTestFormModel_job_desc"]'),
            'jobSkills' => WebDriverBy::xpath('//*[@id="QaTestFormModel_job_skills"]'),
            'minAge' => WebDriverBy::xpath('//*[@id="QaTestFormModel_min_age"]'),
            'maxAge' => WebDriverBy::xpath('//*[@id="QaTestFormModel_max_age"]'),
            'submitButton' => WebDriverBy::xpath('//*[@id="submitCIForm"]')
        ];

        // Check visibility and clickability of elements
        foreach ($elements as $name => $locator) {
            $element = $this->driver->findElement($locator);
            $this->assertTrue($element->isDisplayed(), "$name is not visible");
            $this->assertTrue($element->isEnabled(), "$name is not clickable");

        }
        $this->takeScreen();
        echo "UI/UX is working well";

    }

    // Validation testing
    public function testValidation()
    {
        // Test validation messages and behavior on the post job form
        // Assert that validation messages appear correctly for invalid inputs
        $this->submitWithInvalidField();
        // Assert that the form does not submit if required fields are not filled
        sleep(2);
        $this->submitWithEmptyField();

        $this->assertTrue(true); // Placeholder assertion
        echo "validation is working well";
    }

    // Languages testing
    public function testLanguages()
    {
        // Test the post job form in different languages
        // Submit the form with different language settings
        // Assert that the form behaves correctly and displays messages in the selected language
        $postJobPage = new PostJobPage($this->driver);

        //open
        $postJobPage->open("arabic");
        $this->takeScreen();
        //accept cookies
        $postJobPage->acceptCookies();

        // get a job data to fill the form
        $JobData = TestUtils::getJsonData("JobsData")[2];
        $this->assertTrue($postJobPage->fillPostJobForm($JobData), "failed to fill post job form");

        //open
        $postJobPage->open("french");
        $this->takeScreen();

        // get a job data to fill the form
        $JobData = TestUtils::getJsonData("JobsData")[1];
        $this->assertTrue($postJobPage->fillPostJobForm($JobData), "failed to fill post job form");
        echo "languages are working well";
    }


    private function submitWithEmptyField(): void
    {
        $postJobPage = new PostJobPage($this->driver);

        //open
        $postJobPage->open("english");
        $this->takeScreen();

        //accept cookies
        $postJobPage->acceptCookies();

        // get a job data to fill the form
        $JobData = TestUtils::getJsonData("JobsData")[0];
        $this->assertTrue($postJobPage->fillPostJobFormEmptyField($JobData), "submitted, which is wrong");

    }

    private function submitWithInvalidField(): void
    {
        $postJobPage = new PostJobPage($this->driver);

        //open
        $postJobPage->open("english");
        $this->takeScreen();

        //accept cookies
        $postJobPage->acceptCookies();

        // get a job data to fill the form
        $JobData = TestUtils::getJsonData("JobsData")[0];
        $JobData["exp_max"] = 0; // make it < min_experience which is invalid
        $this->assertTrue($postJobPage->fillPostJobFormInvalidField($JobData), "there is no warning for invalid input");


    }

    private function takeScreen(): void
    {
        $this->driver->takeScreenshot('C:\\Users\\user\\Desktop\\QA_Assignment\\screenshots\\partFive\\' . time() . ".png");
    }


}