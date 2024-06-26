<?php

namespace Pages;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use PHPUnit\Exception;
use utils\TestUtils;

class PostJobPage extends BasePage
{
    public function open($language) {
        switch ($language) {
            case 'english':
                $this->driver->get("https://www.bayt.com/en/employer-tests/qaTest/");
                break;
            case 'french':
                $this->driver->get("https://www.bayt.com/fr/employer-tests/qaTest/");
                break;
            case 'arabic':
                $this->driver->get("https://www.bayt.com/ar/employer-tests/qaTest/");
                break;
            default:
                echo "Language not supported.";
                break;
        }

    }
    public function fillPostJobForm($data): bool
    {
        try{

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
            $this->scrollToElement();
            sleep(3);
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="QaTestFormModel_job_skills"]'))->click()->sendKeys($data["job_skills"]);
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="QaTestFormModel_min_age"]'))->click()->sendKeys($data["age_min"]);
            $this->driver->findElement(WebDriverBy::xpath('//*[@id="QaTestFormModel_max_age"]'))->click()->sendKeys($data["age_max"]);

            //take screen
            $this->takeScreen();

            $this->driver->findElement(WebDriverBy::xpath('//*[@id="submitCIForm"]'))->click();
            sleep(2);


            return true;
        }
        catch (Exception $e){
            return false;
        }

    }
    public function fillPostJobFormEmptyField():bool
    {
        $this->scrollToElement();
        sleep(2);
        $this->driver->findElement(WebDriverBy::xpath('//*[@id="submitCIForm"]'))->click();
        sleep(5);
        $currentUrl = $this->driver->getCurrentURL();
        if($currentUrl==="https://www.bayt.com/en/employer-tests/qaTest/")
            return true;
        else
            return false;
    }
    public function fillPostJobFormInvalidField($data): bool
    {
        $this->fillPostJobForm($data);
        $this->scrollUp();
        sleep(2);
        $element = $this->driver->findElement(WebDriverBy::xpath('//*[@id="yw0"]/div[2]/div/div[4]/div/div/div/div[2]/div[1]'));
        $classAttribute = $element->getAttribute('class');
        if (str_contains($classAttribute, 'has-error')) {
            echo "The class 'has-error' is activated.";
            return true;
        } else {
            echo "The class 'has-error' is not activated.";
            return false;
        }

    }

    private function scrollToElement(): void
    {
        $this->driver->executeScript('window.scrollBy(0, 600);');
    }
    private function scrollUp(): void
    {
        $this->driver->executeScript('window.scrollBy(0, -600);');

    }
    private function takeScreen(): void{
        $this->driver->takeScreenshot('C:\\Users\\user\\Desktop\\QA_Assignment\\screenshots\\partFive\\' . time() . ".png");
    }

}