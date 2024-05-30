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
        $this->driver->takeScreenshot(__DIR__ ."\screenshots\partOne\/" . time() . ".png");
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('skip-btn')))->click();
        $application = TestUtils::getJsonData("UsersData")[0];
        $dateParts = explode('-', $application["birth_date"]);
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('personalInformationForm_birthDay__r')))->click();
        $search = $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[1]/div/div/div/div[1]/div[1]/div/div[1]/div[2]/div/input'));
        $search->sendKeys($dateParts[0]);
        $search->sendKeys(WebDriverKeys::ENTER);

        $this->driver->findElement(WebDriverBy::id('personalInformationForm_birthMonth__r'))->click();
        $search = $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[1]/div/div/div/div[2]/div[1]/div/div[1]/div[2]/div/input'));
        $search->sendKeys($dateParts[1]);
        $search->sendKeys(WebDriverKeys::ENTER);
        $this->driver->findElement(WebDriverBy::id('personalInformationForm_birthYear__r'))->click();
        $search = $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[1]/div/div/div/div[3]/div[1]/div/div[1]/div[2]/div/input'));
        $search->sendKeys($dateParts[2]);
        $search->sendKeys(WebDriverKeys::ENTER);
        $this->driver->takeScreenshot(__DIR__ ."\screenshots\partOne\/" . time() . ".png");
        if ($application["gender"] === 'Female') {
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="personalInformationForm_gender"]/label[2]'))->click();
        } else {
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="personalInformationForm_gender"]/label[1]'))->click();
        }
        sleep(5);
        $this->driver->findElement(WebDriverBy::id('personalInformationForm_nationalityCitizenAc__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[3]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["nationality"] . WebDriverKeys::ENTER);
        sleep(5);
        $this->driver->findElement(WebDriverBy::id('personalInformationForm_resCity__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[5]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["city"] . WebDriverKeys::ENTER);
        sleep(5);
        $this->driver->findElement(WebDriverBy::id('personalInformationForm_visaStatus__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[2]/div[7]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["visa_status"] . WebDriverKeys::ENTER);
        sleep(5);
        $noExperienceElement = $this->driver->findElement(WebDriverBy::xpath('//*[@id="experienceForm_hasExperience"]/label[2]'));
        $this->scrollToElement($noExperienceElement);
        $noExperienceElement->click();
        ///////////////////////////////////////
        sleep(5);
        $this->scrollToElement($this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[4]/p')));
        $this->driver->findElement(WebDriverBy::id('EducationForm_degree__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[5]/div[1]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["degree"] . WebDriverKeys::ENTER);

        $this->driver->findElement(WebDriverBy::id('//*[@id="EducationForm_institution"]'))->click()->sendKeys($application["university"]);

        $this->driver->findElement(WebDriverBy::id('EducationForm_educationCountry__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[5]/div[3]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["university_country"] . WebDriverKeys::ENTER);

        $this->driver->findElement(WebDriverBy::id('//*[@id="EducationForm_major"]'))->click()->sendKeys($application["major"]);
        $dateParts = explode('-', $application["graduation_date"]);
        $this->driver->findElement(WebDriverBy::id('EducationForm_completionMonth__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[5]/div[7]/div/div/div[1]/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($dateParts[0] . WebDriverKeys::ENTER);
        $this->driver->findElement(WebDriverBy::id('EducationForm_completionYear__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[5]/div[7]/div/div/div[2]/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($dateParts[1] . WebDriverKeys::ENTER);

        $this->scrollToElement($this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[6]/p')));

        $this->driver->findElement(WebDriverBy::id('targetJobForm_careerLevel__r'))->click();
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/section[7]/div[2]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($application["job_level"] . WebDriverKeys::ENTER);

        $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/footer/div/input'))->click();

        $this->checkSuccessfulApplication();


    }

    private function scrollToElement($element): void
    {
        $this->driver->executeScript("arguments[0].scrollIntoView(true);", [$element]);
    }


    public function checkSuccessfulApplication(): void
    {
        try {
            $successfulMessage = $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('/html/body/div[7]/div/div[1]/div/div[1]/h1')));
            Assert::assertTrue($successfulMessage->getText() == "Your application has been sent", "can't see success message");
            $this->driver->takeScreenshot(__DIR__ ."\screenshots\partOne\/" . time() . ".png");
        } catch (Exception $e) {
            Assert::assertFalse(false, $e->getMessage());
        }


    }
}
