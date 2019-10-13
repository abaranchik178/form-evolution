<?php 

class UserProfileCest
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
        $I->amOnPage('/user-profile.php');
        $I->see('User profile page');
    }
}
