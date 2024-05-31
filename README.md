<h1 align="left">Hello👋 What's up?</h1>

###

<p align="left">My name is Tala Skafi and I implemented this for  testing the website "Bayt.com" as a QA assignment.</p>

###

<h2 align="left">Prerequisits:</h2>

###

<p align="left">• Download php<br>• code editor (I used PhpStorm)<br>• Download selenium webdriver<br>• Composer software</p>

###

<h2 align="left">Structure of my project :</h2>

###

<p align="left">├── tests<br>│   ├── pages<br>│   │   ├── AboutUsPage.php<br>│   │   ├── AccountSettingPage.php<br>│   │   ├── BasePage.php<br>│   │   ├── DeleteAccountPage.php<br>│   │   ├── HomePage.php<br>│   │   ├── JobApplicationPage.php<br>│   │   ├── JobsPage.php<br>│   │   ├── LoginPage.php<br>│   │   ├── PostJobPage.php<br>│   │   └── RegistrationPage.php<br>│   ├── TestCases<br>│   │   ├── BaseTest.php<br>│   │   ├── PartFiveTest.php<br>│   │   ├── PartOneTest.php<br>│   │   ├── PartThreeTest.php<br>│   │   └── PartTwoTest.php<br>│   └── utild<br>│       └── TestUtils.php<br>├── vendor<br>│   └── ...<br>├── resources<br>│   ├── EmployersData.json<br>│   ├── URLs.json<br>│   └── UsersData.json<br>├── screenshots<br>│   ├── partFive<br>│   ├── partOne<br>│   ├── partThree<br>│   └── partTwo<br>├── phpunit.xml<br>└── composer.json</p>

###

<h2 align="left">I coded the project with :</h2>

###

<div align="left">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/phpstorm/phpstorm-original.svg" height="40" alt="phpstorm logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" height="40" alt="php logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/selenium/selenium-original.svg" height="40" alt="selenium logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" height="40" alt="javascript logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/composer/composer-original.svg" height="40" alt="composer logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/chrome/chrome-original.svg" height="40" alt="chrome logo"  />
</div>

###

<h2 align="left">To run the project :</h2>

###

<p align="left">• clone it from here.<br>• run the chrome webdriver.exe before running the code<br>• run any part you need and see the testing results assertions.<br>• each part has it's own folder of screenshots, which will be generated automatically once you run the code.</p>

###

<h2 align="left">Part One:</h2>

###

<p align="left">1. Check the validation message for already registered users.<br>2. Check that it registers user successfully.<br>3. Check that it applies to job successfully.</p>

###

<h2 align="left">Part Two:</h2>

###

<p align="left">1. Check that it loges in successfully.<br>2. Check that it deleted the account successfully.</p>

###

<h2 align="left">Part Three:</h2>

###

<p align="left">1. Check that it register a user and applies to job successfully with mobile size.</p>

###

<h2 align="left">Part Four:</h2>

###

<p align="left">List other test scenarios that could be written as test cases, not automated<br>test cases :<br><br>• Forgot Password Functionality:<br>Verify the "Forgot Password" link on the login page.<br>Ensure that submitting a request for Forgot Password sends a password reset link.<br>Verify that following the password reset link allows the user to set a new password.<br><br>• Job Search Functionality:<br>Verify that job search with proper filters like location, job type, salary range, from home, returns accurate results.<br>Check the sorting feature for ex: by date, relevance, works correctly.<br><br>• Profile Completion Reminder:<br>Verify that the user receives reminders to complete their profile.<br>Check that filling in additional profile information updates the profile completion status.<br>Verify that users can update their profile information (e.g., contact details, experience).<br>Check that changes are reflected immediately in the user's profile.<br><br>• Save Job for Later:<br>Ensure that logged-in users can save jobs for later viewing.<br>Verify that saved jobs appear correctly in the user's saved jobs list.</p>

###

<h2 align="left">Part Five:</h2>

###

<p align="left">1. Functionality testing<br>2. UI/UX testing<br>3. Validation testing<br>4. Languages testing</p>

###

<h2 align="left">Bugs I found:</h2>

###

<p align="left">• in the postJob in part five, the values need to be validated:<br>ex: the age must be > experience. <br>ex: the age or experience fields should take only numbers but it takes letters + symbols.<br>ex: the fields that accepts number mustn't accept negatives.<br><br>• When I have field/s that require user to fill or need an edit,  and the user applies the edit, it's expected to remove the red borders and remove the warning when the user press out of this field.<br><br>• refreshing or cancelling the page not generating popup message to make sure to leave or close. so all the data gone once you refresh the page</p>

###

<h2 align="left">Suggestions:</h2>

###

<p align="left">• For the post job page, convert the whole page to the selected language.<br>• For the post job page, adding autoscroll to error fields.</p>

###

<h2 align="left">Problems I faced:</h2>

###

<p align="left">• The popup window when deleting an account is not reachable.</p>

###
