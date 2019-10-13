<?php 

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }

    public function tryOpen(AcceptanceTester $I)
    {
        $I->amOnPage('/login.php');
        $I->see('Login page');
    }
}
