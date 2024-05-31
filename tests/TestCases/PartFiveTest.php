<?php

namespace TestCases;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use Pages\PostJobPage;
use utils\TestUtils;

class PartFiveTest extends BaseTest
{
    public function intensiveTesting(): void
    {
        $this->testFunctionality();

    }

    // Functionality testing
    public function testFunctionality()
    {
        // Test functionality of the post job form submission
        // Assert that the form submits successfully and redirects to the expected page
        // Assert that the submitted data is correctly saved in the backend
        $postJobPage = new PostJobPage($this->driver);
        //open
        $postJobPage->open();
        $this->takeScreen();

        //accept cookies
        $postJobPage->acceptCookies();

        $this->assertTrue($postJobPage->fillPostJobForm(),"failed to fill post job form");
    }

     //UI/UX testing
    public function testUIUX()
    {
        // Test UI/UX elements and interactions on the post job form page
        // Assert that all form fields are visible and interactable
        // Assert that buttons, links, and other UI elements behave as expected
        // Find all form fields
        $postJobPage = new PostJobPage($this->driver);
        //open
        $postJobPage->open();
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

    }
//
//    // Validation testing
//    public function testValidation()
//    {
//        // Test validation messages and behavior on the post job form
//        // Assert that validation messages appear correctly for invalid inputs
//        // Assert that the form does not submit if required fields are not filled
//        // Test validation messages and behavior on the post job form
//        $this->assertTrue(true); // Placeholder assertion
//    }
//
//    // Languages testing
//    public function testLanguages()
//    {
//        // Test the post job form in different languages
//        // Submit the form with different language settings
//        // Assert that the form behaves correctly and displays messages in the selected language
//        $this->assertTrue(true); // Placeholder assertion
//    }
//
//    // Enhancements
//    public function testEnhancements()
//    {
//        // Test any potential enhancements or improvements suggested for the post job form
//        // Implement and test new features or changes to existing features
//        // Ensure that the enhancements improve the user experience and functionality of the form
//
//        $this->assertTrue(true); // Placeholder assertion
//    }
    private function takeScreen(): void
    {
        $this->driver->takeScreenshot('C:\\Users\\user\\Desktop\\QA_Assignment\\screenshots\\partFive\\' . time() . ".png");
    }


}