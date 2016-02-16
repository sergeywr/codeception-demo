<?php
/**
 *  Feature: Country Picker from dropdown menu
 *      In order to be able to send money from my country
 *      As a customer
 *      I want to be able to select country from varios different countries
 *
 *      Scenario: Select Send From Country
 *          Given I am using calculator service
 *          When I select country from "Send From" option
 *          Then I see country is selected
 *          And I see country flag is displayed
 *
 *      Scenario: Select Send To Country
 *          Given I am using calculator service
 *          When I select country from "Send To" option
 *          Then I see country is selected
 *          And I see country flag is displayed
 *          And I see calculation data is displayed
 *          And I see Payment Correspodent details
 *
 *      Scenario: Change "Send To" country
 *          Given I am using calculator service
 *          When I select country from "Send To" option
 *          And I select other "Send To" country
 *          Then I see country is selected
 *          And I see country flag is displayed
 *          And I see calculation data is displayed
 *          And I see Payment Correspodent details
 */

use Step\Calculator\CalculatorSteps as CalculatorSteps;

class ServicePicker_Cest
{
    public function _before(CalculatorSteps $I)
    {
        $I->wantTo("Test Country Picker");
    }

    public function _after(CalculatorSteps $I)
    {
    }

    /**
     * @Scenario: Select Send From Country
     */
    public function selectSendFromCountry(CalculatorSteps $I)
    {
        $I->amUsingCalculatorService();
        $I->selectCountryOptionFor("Send From");
        $I->seeCountryIsSelectedFor("Send From");
        $I->seeFlagIsDisplayed("Send From");
    }

    /**
     * @Scenario: Select Send To Country
     */
    public function selectSendToCountry(CalculatorSteps $I)
    {
        $I->amUsingCalculatorService();
        $I->selectCountryOptionFor("Send To");
        $I->seeCountryIsSelectedFor("Send To");
        $I->seeFlagIsDisplayed("Send To");
        $I->seeCalculationData();
        $I->seePaymentCorrespodent();

    }

    /**
     * @Scenario: Change "Send To" country
     */
    public function changeSendToCountry(CalculatorSteps $I)
    {
        $I->amUsingCalculatorService();
        $I->selectCountryOptionFor("Send To");
        $I->changeToOtherCountry("Send To");
        $I->seeCountryIsChangedFor("Send To");
        $I->seeFlagIsDisplayed("Send To");
        $I->seeCalculationData();
        $I->seePaymentCorrespodent();

    }

}
