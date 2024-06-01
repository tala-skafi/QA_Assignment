<?php

namespace Pages;

use Exception;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use PHPUnit\Framework\Assert;
use utils\TestUtils;

class JobApplicationPage extends BasePage
{

    public function fillForm(): void
    {
        // get the users' data from the json
        $applicationData = TestUtils::getJsonData("UsersData")[0];

        //skip CV adding
        $this->skipCV();

        // fill the form
        try{
            $this->takeScreen();
            $this->fillBirthDate($applicationData);
            $this->fillGender($applicationData);
            $this->fillNationality($applicationData);
            $this->fillCity($applicationData);
            $this->fillVisaState($applicationData);
            $this->fillNoExperience();
            $this->fillDegree($applicationData);
            $this->fillUniversity($applicationData);
            $this->fillUniversityCity($applicationData);
            $this->fillUniversityCounter($applicationData);
            $this->fillMajor($applicationData);
            $this->fillGraduationDate($applicationData);
            $this->fillJobLevel($applicationData);
            sleep(5);
            $this->takeScreen();

            //submit
            $this->submit();

            // check if successful application
            $this->checkSuccessfulApplication();
        }
        catch(Exception $e){
            echo $e->getMessage();
            Assert::assertFalse(false);
        }




    }
    private function takeScreen(): void
    {
        // take a screenshot
        $this->driver->takeScreenshot('C:\\Users\\user\\Desktop\\QA_Assignment\\screenshots\\jobApplicationForm\\' . time() . ".png");

    }

    private function scroll(): void
    {
        $this->driver->executeScript('window.scrollBy(0, 500);');
    }

    private function checkSuccessfulApplication(): void
    {
        try {
            $successfulMessage = $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('/html/body/div[7]/div/div[1]/div/div[1]/h1')));
            Assert::assertTrue($successfulMessage->getText() == "Your application has been sent", "can't see success message");

        } catch (Exception $e) {
            Assert::assertFalse(false, $e->getMessage());
        }

    }

    private function skipCV(): void
    {
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('skip-btn')))->click();

    }

    private function fillBirthDate($application): void
    {
        $dateParts = explode('-', $application["birth_date"]);
        // Day
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('personalInformationForm_birthDay__r')))->click();
        $search = $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[1]/div/div/div/div[1]/div[1]/div/div[1]/div[2]/div/input'));
        $search->sendKeys($dateParts[0]);
        $search->sendKeys(WebDriverKeys::ENTER);

        // Moth
        $this->driver->findElement(WebDriverBy::id('personalInformationForm_birthMonth__r'))->click();
        $search = $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[1]/div/div/div/div[2]/div[1]/div/div[1]/div[2]/div/input'));
        $search->sendKeys($dateParts[1]);
        $search->sendKeys(WebDriverKeys::ENTER);

        // Year
        $this->driver->findElement(WebDriverBy::id('personalInformationForm_birthYear__r'))->click();
        $search = $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[1]/div/div/div/div[3]/div[1]/div/div[1]/div[2]/div/input'));
        $search->sendKeys($dateParts[2]);
        $search->sendKeys(WebDriverKeys::ENTER);


    }

    private function fillGender($application): void
    {
        if ($application["gender"] === 'Female') {
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="personalInformationForm_gender"]/label[2]'))->click();
        } else {
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="personalInformationForm_gender"]/label[1]'))->click();
        }

    }

    private function fillNationality($application): void
    {
        $this->driver->findElement(WebDriverBy::id('personalInformationForm_nationalityCitizenAc__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[3]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["nationality"] . WebDriverKeys::ENTER);

    }

    private function fillCity($application): void
    {
        $this->driver->findElement(WebDriverBy::id('personalInformationForm_resCity__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[5]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["city"] . WebDriverKeys::ENTER);

    }

    private function fillVisaState($application): void
    {
        $this->driver->findElement(WebDriverBy::id('personalInformationForm_visaStatus__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[7]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["visa_status"] . WebDriverKeys::ENTER);

    }

    private function fillNoExperience(): void
    {
        $noExperienceElement = $this->driver->findElement(WebDriverBy::xpath('//*[@id="experienceForm_hasExperience"]/label[2]'));
        $noExperienceElement->click();

    }

    private function fillDegree($application): void
    {
        $this->driver->findElement(WebDriverBy::id('EducationForm_degree__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[5]/div[1]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["degree"] . WebDriverKeys::ENTER);

    }

    private function fillUniversity($application): void
    {
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="EducationForm_institution"]'))->click()->sendKeys($application["university"]);

    }

    private function fillUniversityCounter($application): void
    {
        $this->driver->findElement(WebDriverBy::id('EducationForm_educationCountry__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[5]/div[3]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["university_country"] . WebDriverKeys::ENTER);


    }

    private function fillUniversityCity($application): void
    {
        $this->driver->findElement(WebDriverBy::id('EducationForm_educationCity__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[5]/div[4]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["university_country"] . WebDriverKeys::ENTER);

    }

    private function fillMajor($application): void
    {
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="EducationForm_major"]'))->click()->sendKeys($application["major"]);

    }

    private function fillGraduationDate($application): void
    {
        $dateParts = explode('-', $application["graduation_date"]);
        $this->driver->findElement(WebDriverBy::id('EducationForm_completionMonth__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[5]/div[7]/div/div/div[1]/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($dateParts[0] . WebDriverKeys::ENTER);
        $this->driver->findElement(WebDriverBy::id('EducationForm_completionYear__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[5]/div[7]/div/div/div[2]/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($dateParts[1] . WebDriverKeys::ENTER);

    }

    private function fillJobLevel($application): void
    {
        $this->driver->findElement(WebDriverBy::id('targetJobForm_careerLevel__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[7]/div[2]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["job_level"] . WebDriverKeys::ENTER);

    }

    private function submit(): void
    {
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/footer/div/input'))->click();

    }


}
