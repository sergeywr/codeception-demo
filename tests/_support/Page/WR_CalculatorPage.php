<?php
namespace Page;

class WR_CalculatorPage
{
    protected $tester;

    public static $URL = '/';

    private static $pageLocators = [
        "ORIGIN_COUNTRY_SELECT"             =>  "#s2id_originCountries",
        "ORIGIN_COUNTRY_SELECTED"           =>  "#select2-chosen-1",
        "ORIGIN_COUNTRY_SEARCH_RESULT"      =>  "//div[contains(@class, 'select2-result-label')]",
        "ORIGIN_COUNTRY_INPUT"              =>  "#s2id_autogen1_search",
        "DESTINATION_COUNTRY_SELECT"        =>  "#s2id_destinationCountries",
        "DESTINATION_COUNTRY_SELECTED"      =>  "#select2-chosen-2", 
        "DESTINATION_COUNTRY_INPUT"         =>  "#s2id_autogen2_search",
        "DESTINATION_COUNTRY_SEARCH_RESULT" =>  "//div[contains(@class, 'select2-result-label')]",
        "COUNTRY_FLAGS"                     =>  "//span[contains(@id,'select2-chosen')]/span/img",
        "CALCULATION_DATA"                  =>  "//*[@id='calculationData']/div",
        "SERVICE_CONTAINER"                 =>  "#servicesContainer",
        "CORIDOR_CONTAINER"                 =>  "#corridorsContainer"



    ];

    public function __construct(\CalculatorTester $I)
    {
        $this->tester = $I;
        $this->waitForElements();

    }

    private function waitForElements()
    {
        $I = $this->tester;

        $I->waitForElementVisible(self::$pageLocators['ORIGIN_COUNTRY_SELECT'], MAX_TIMEOUT);
        $I->waitForElementVisible(self::$pageLocators['ORIGIN_COUNTRY_SELECTED'], MAX_TIMEOUT);
        $I->waitForElementVisible(self::$pageLocators['DESTINATION_COUNTRY_SELECT'], MAX_TIMEOUT);
        
        return $this;
    }

    /**
     * @param $option - Send To || Send From
     * @param $country - country to pick
     */
    public function selectCountry($option, $country)
    {
        $I = $this->tester;

        $this->waitForElements();

        if ($option == "Send From")
        {
            $I->click(self::$pageLocators['ORIGIN_COUNTRY_SELECT']);
            $I->fillField(self::$pageLocators['ORIGIN_COUNTRY_INPUT'], $country);
            $I->click(self::$pageLocators['ORIGIN_COUNTRY_SEARCH_RESULT']);

        } else if ($option == "Send To")
        {
            $I->click(self::$pageLocators['DESTINATION_COUNTRY_SELECT']);
            $I->fillField(self::$pageLocators['DESTINATION_COUNTRY_INPUT'], $country);
            $I->click(self::$pageLocators['DESTINATION_COUNTRY_SEARCH_RESULT']);
        }

        return $this;
    }

    /**
     * @param $option - Send To || Send From
     */
    public function returnSelectedCountry($option)
    {
        $I = $this->tester;

        if ($option == "Send From")
        {
            return $I->grabTextFrom(self::$pageLocators['ORIGIN_COUNTRY_SELECTED']);
        } else if ($option == "Send To")
        {
             return $I->grabTextFrom(self::$pageLocators['DESTINATION_COUNTRY_SELECTED']);

        }
    }

    /**
     * @param $option - Send To || Send From
     */
    public function returnSelectedCountryFlag($option)
    {
        $I = $this->tester;
        
        $el = $I->grabMultiple(self::$pageLocators['COUNTRY_FLAGS'], 'src');
       
        if ($option == "Send From")
        {
           return $el[0];

        } else if ($option == "Send To")
        {
           return $el[1];
        }
    }

    /**
     * @param $type - calculation data type: EXCHANGE_RATE || FEES || TOTAL_TO_PAY
     */
    public function returnCalculationData($type)
    {
        $I = $this->tester;

        $I->waitForElementVisible(self::$pageLocators['CALCULATION_DATA'], MAX_TIMEOUT);

        switch ($type) {
            case 'EXCHANGE_RATE':
                return $I->grabTextFrom(self::$pageLocators['CALCULATION_DATA'] . '[1]/span');
                break;
            case 'FEES':
                return $I->grabTextFrom(self::$pageLocators['CALCULATION_DATA'] . '[2]/span');
                break;
            case 'TOTAL_TO_PAY':
                return $I->grabTextFrom(self::$pageLocators['CALCULATION_DATA'] . '[3]/span');
                break;
        }
    }

    /**
     * @param $type - calculation data type: EXCHANGE_RATE || FEES || TOTAL_TO_PAY
     */
    public function returnCalculationDataValues($type)
    {
        $I = $this->tester;

        $full = $this->returnCalculationData($option);
        $value = split(" ", $full);

        return $value[0];
    }
    
    /**
     * @param $type - calculation data type: SERVICE_CONTAINER || CORIDOR_CONTAINER
     */
    public function returnService($type)
    {
        $I = $this->tester;
        $I->waitForElementVisible(self::$pageLocators[$type]);
        $value = $I->grabTextFrom(self::$pageLocators[$type]);

        return $value;
    }

}
