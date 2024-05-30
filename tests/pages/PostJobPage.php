<?php

namespace Pages;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use PHPUnit\Exception;
use utils\TestUtils;

class PostJobPage extends BasePage
{
    public function open() {
        $this->driver->get("https://www.bayt.com/en/employer-tests/qaTest/");
    }
    public function fillPostJobForm(): bool
    {
        try{
            $data = TestUtils::getJsonData("EmployersData")[0];
            $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="QaTestFormModel_job_title"]')))->click()->sendKeys($data["job_title"]);


            $this->driver->findElement(WebDriverBy::id('QaTestFormModel_job_industries__r'))->click();
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/div[2]/div/div[2]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($data["job_industries"] . WebDriverKeys::ENTER);

            $this->driver->findElement(WebDriverBy::id('QaTestFormModel_job_career_level__r'))->click();
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/div[2]/div/div[3]/div/div[1]/div/div[1]/div[2]/div/input'))->sendKeys($data["job_industries"] . WebDriverKeys::ENTER);

            $this->driver->findElement(WebDriverBy::xpath('//*[@id="QaTestFormModel_job_min_experience"]'))->click()->sendKeys($data["exp_min"]);
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="QaTestFormModel_job_max_experience"]'))->click()->sendKeys($data["exp_max"]);
            if($data["from_home"]==="no"){

                $this->driver->findElement(WebDriverBy::xpath('//*[@id="QaTestFormModel_remote_working_type"]/label[2]'))->click();

            }
            else {
                $this->driver->findElement(WebDriverBy::xpath('//*[@id="QaTestFormModel_remote_working_type"]/label[1]'))->click();
            }
            $descElement=$this->driver->findElement(WebDriverBy::xpath('//*[@id="QaTestFormModel_job_desc"]'));
            $descElement->click()->sendKeys($data["job_desc"]);
            $this->scrollToElement($descElement);
            sleep(3);
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="QaTestFormModel_job_skills"]'))->click()->sendKeys($data["job_skills"]);
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="QaTestFormModel_min_age"]'))->click()->sendKeys($data["age_min"]);
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="QaTestFormModel_max_age"]'))->click()->sendKeys($data["age_max"]);

            $this->driver->findElement(WebDriverBy::xpath('//*[@id="submitCIForm"]'))->click();
            sleep(5);
            return true;
        }
        catch (Exception $e){
            return false;
        }

    }
    private function scrollToElement($element): void
    {
        $this->driver->executeScript('window.scrollBy(0, 600);');
    }

}