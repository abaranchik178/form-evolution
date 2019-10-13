<?php 

class RegistrationCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }

    public function tryRegistration(AcceptanceTester $I)
    {
        $I->amOnPage('registration.php');
        $I->see('Registration page');

        $email = 'andreytest@mail.ru';

        $I->fillField('email', 'andreytest@mail.ru');
        $I->fillField('firstName', 'andrey-test');
        $I->fillField('lastName', 'tuline-test');
        $I->fillField('password1', '123');
        $I->fillField('birthDate', '1988-08-08');
        $I->selectOption('gender', 'male');
        $I->click('submit');

        $I->see('Home page');
        $I->seeInDatabase('users', ['email' => $email]);
    }
}
