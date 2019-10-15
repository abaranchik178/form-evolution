<?php 

use \Codeception\Util\Fixtures;

class RegistrationCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryRegistration(AcceptanceTester $I)
    {
        $user = Fixtures::get('users')[0];
        $I->amOnPage('registration.php');
        $I->see('Registration page');

        $I->fillField('email', $user['email']);
        $I->fillField('firstName', $user['firstName']);
        $I->fillField('lastName', $user['lastName']);
        $I->fillField('password1', $user['password']);
        $I->fillField('password2', $user['password']);
//        $I->fillField('birthDate', $user['birthDate']);
        $I->selectOption('gender', $user['gender']);
        $I->click('submit');

        $I->see('Home page');
        $I->seeInDatabase('users', ['email' => $user['email']]);
    }

    /**
     * @param AcceptanceTester $I
     * @depends tryRegistration
     */
    public function tryALogin(AcceptanceTester $I)
    {
        $user = Fixtures::get('users')[0];
        $I->amOnPage('login.php');
        $I->see('Login page');
        $I->fillField('email', $user['email']);
        $I->fillField('password', $user['password']);
        $I->click('Login');
        $I->see( $user['firstName'] );
    }
}
