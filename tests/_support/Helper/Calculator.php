<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Calculator extends \Codeception\Module
{
	public function getElements($locator)
	{
		$els = $this->getModule('WebDriver')->_findElements($locator);
		return $els;	
	}

}
