<?php
namespace Step\Calculator;

use Page\WR_CalculatorPage as CalculatorPage;


class CalculatorSteps extends \CalculatorTester
{
    /**
     * << Page Object class var: CalculatorPage >>>
     */
    protected $calc_page;
    
    private static $flag            =   '/images/flags';

	private static $testData = [
		"ORIGIN_COUNTRY"			=>	"United Kingdom",
		"ORIGIN_OTHER_COUNTRY"		=>	"France",
		"DESTINATION_COUNTRY"		=>	"Philippines",
		"DESTINATION_OTHER_COUNTRY"	=>	"Austria"

	];
	
    public function amUsingCalculatorService()
    {
        $I = $this;
        $I->amOnPage(CalculatorPage::$URL);
        $this->calc_page = new CalculatorPage($I);

        return $this;
    }

    /**
     * @param $option - Send To || Send From
     */
    public function selectCountryOptionFor($option)
    {
    	$I = $this;
    	    	
        switch ($option) {
            case 'Send From':
                $this->calc_page->selectCountry($option, self::$testData['ORIGIN_COUNTRY']);      
                break;
            case 'Send To':
                $this->calc_page->selectCountry($option, self::$testData['DESTINATION_COUNTRY']);     
                break;
            default:
                $I->fail('Please provide option - Send From or Send To');
                break;
        }
        return $this;
    }

    /**
     * @param $option - Send To || Send From
     */
    public function seeCountryIsSelectedFor($option)
    {
    	$I = $this;
    	    	
        switch ($option) {
            case 'Send From':
                $I->assertEquals(self::$testData['ORIGIN_COUNTRY'], $this->calc_page->returnSelectedCountry($option));
                break;
            case 'Send To':
                $I->assertEquals(self::$testData['DESTINATION_COUNTRY'], $this->calc_page->returnSelectedCountry($option));
                break;
            default:
                $I->fail('Please provide option - Send From or Send To');
                break;
    	}
    	return $this;
    }

    /**
     * @param $option - Send To || Send From
     */
    public function changeToOtherCountry($option)
    {
    	$I = $this;
    	
        switch ($option) {
            case 'Send From':
                $this->calc_page->selectCountry($option, self::$testData['ORIGIN_OTHER_COUNTRY']);    
                break;
            case 'Send To':
                $this->calc_page->selectCountry($option, self::$testData['DESTINATION_OTHER_COUNTRY']);     
                break;  
            default:
                $I->fail('Please provide option - Send From or Send To');
                break;
        }
        return $this;
    }

    /**
     * @param $option - Send To || Send From
     */
    public function seeCountryIsChangedFor($option)
    {
    	$I = $this;
    	    	
        switch ($option) {
            case 'Send From':
                $I->assertEquals(self::$testData['ORIGIN_OTHER_COUNTRY'], $this->calc_page->returnSelectedCountry($option));
                break;
            case 'Send To':
                $I->assertEquals(self::$testData['DESTINATION_OTHER_COUNTRY'], $this->calc_page->returnSelectedCountry($option));
                break;
            default:
                $I->fail('Please provide option - Send From or Send To');
                break;
        }
    	return $this;
    }

    /**
     * @param $option - Send To || Send From
     */
    public function seeFlagIsDisplayed($option)
    {
    	$I = $this;

        $I->assertContains(self::$flag, $this->calc_page->returnSelectedCountryFlag($option));

        return $this;
    }

    public function seeCalculationData()
    {
        $I = $this;

        $I->assertNotNull($this->calc_page->returnCalculationData("EXCHANGE_RATE"));
        $I->assertNotNull($this->calc_page->returnCalculationData("FEES"));
        $I->assertNotNull($this->calc_page->returnCalculationData("TOTAL_TO_PAY"));
    }

    public function seePaymentCorrespodent()
    {
        $I = $this;

        $I->assertNotNull($this->calc_page->returnService('SERVICE_CONTAINER'));
        $I->assertNotNull($this->calc_page->returnService('CORIDOR_CONTAINER'));

        return $this;
    }
}