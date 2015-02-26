<?php

namespace mii\yquery;

/**
 * Wrhite less do more
 *
 * @author Gustavo Salgado <gsalgadotoledo@gmail.com>
 * @since 1.0
 */
class Query
{

	public $selector;

	public function __get($name) {
		
		$nameClass=$this->selector; 
		if($name==='class')
			return $nameClass::className();
		if(property_exists($nameClass, $name)) {
			return $nameClass::$name;
		} elseif(($constantValue=constant("$nameClass::$name"))!==null) {
			return $constantValue;
		}
		return parent::__get($name);
	}

	public function __call($name, $params) {
		
		$nameClass=$this->selector; 
		
		if(method_exists($nameClass, $name))
			return call_user_func_array(array($nameClass, $name), $params);
		return parent::__call($name, $params);
	}
}
