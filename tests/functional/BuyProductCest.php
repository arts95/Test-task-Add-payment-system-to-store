<?php

namespace functional;

use Codeception\Util\Locator;

/**
 * Class BuyProductCest
 * @codingStandardsIgnoreFile
 */
class BuyProductCest
{
    /**
     * @param \FunctionalTester $I
     */
    public function buyProductAndCheckStatusIsApproved(\FunctionalTester $I)
    {
        $I->amOnPage('/products');
        $I->see('Buy');
        $I->click('Buy');
        $I->see('Pay');
        $I->fillField('Card number', '6763428189229070');
        $I->fillField('Card holder', 'JOHN SNOW');
        $I->fillField('Card exp month', '11');
        $I->fillField('Card exp year', '2021');
        $I->fillField('Card cvv', '111');
        $I->fillField('Customer email', 'test@test.email');
        $I->click('Pay');
        $I->seeCurrentUrlEquals('/orders');
        $I->see('Orders');
        $I->see('processing', Locator::firstElement('td.status'));
        $I->see('Check status');
        $I->click('Check status');
        $I->see('approved', Locator::firstElement('td.status'));
    }

    /**
     * @param \FunctionalTester $I
     */
    public function buyProduct1ClickAndCheckStatusIsApproved(\FunctionalTester $I)
    {
        $I->amOnPage('/products');
        $I->see('Buy 1 click');
        $I->click('Buy 1 click');
        $I->see('Pay');
        $I->selectOption("Recurring token", $I->grabTextFrom('select option:first-child'));
        $I->fillField('Customer email', 'test@test.email');
        $I->click('Pay');
        $I->seeCurrentUrlEquals('/orders');
        $I->see('Orders');
        $I->see('processing', Locator::firstElement('td.status'));
        $I->see('Check status');
        $I->click('Check status');
        $I->see('approved', Locator::firstElement('td.status'));
    }
}
