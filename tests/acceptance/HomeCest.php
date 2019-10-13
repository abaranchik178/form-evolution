<?php 

class HomeCest
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
        $I->amOnPage('/');
        $I->see('Home page');
    }
}
