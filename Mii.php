<?php

namespace mii;

/**
 * Wrhite less do more
 *
 * @author Gustavo Salgado <gsalgadotoledo@gmail.com>
 * @since 1.0
 */
class Mii extends \yii\base\Component {

	protected $_aliasesDefault;
	
	public $aliases = [];

	//y('@webroot','/alias/...'); // set alias Url alias
	//y('app','Translate message');
	//y('app','Translate message {key}',['{key}'=>$id]);
	//y('@webroot'); // Url alias
	//y('@web'); // Path alias
	
	//y('users')->loginUrl; // component
	//y('users')->loginUrl; // module
	//y('users')->loginUrl; // alias of statics
	
	// For resove conflicts
	//y('#users')->loginUrl; // if have two alias of modules 
	//y('.users')->loginUrl; // if have two alias of components
	//y('.user')->identity->id;

	// Pending for this bacause the idea is that you hava to made an alias
	//y('Log')->error('Hello... im error jijiji...');
	//y('Url')->to(); alias \yii\helpers\Url::to()
	//y('GridView')->widget(); alias \yii\widgets\GridView::widget()

	//y(['class'=>'\yii\filters...']); // \Yii::createObject(['class'=>'\yii\filters...']);
	//y(); // return \Yii::$container
	//y()->set('alias',['class'=>'mii\test\Test']);

	public function init()
	{
		parent::init();
		if($this->_aliasesDefault===null)
			$this->_aliasesDefault = include(__DIR__."/base/classes.php");
		$this->aliases=array_merge($this->_aliasesDefault,$this->aliases);
	}

    public function run($one=null,$two=null,$three=null) {
		
		if(is_string($one) && $one==='c' && $two===null) {
    		return \Yii::$container;
		}

		if(is_array($one)) {
    		return \Yii::createObject($one);
		}

		if($one===null && $two===null && $three===null) {
			return \Yii::$container;
		}
	
		if(is_string($one) && is_string($two) && $three===null) {
			return \Yii::t($one,$two);
		}
		
		if(is_string($one) && is_string($two) && is_array($three)) {
			return \Yii::t($one,$two,$three);
		}

		if(is_string($one) && stripos($one, '#')!==false) {
			return \Yii::$app->getModule(substr($one, 1));
		}
		

		if(is_string($one) && stripos($one, '.')!==false) {
			if(($component=\Yii::$app->get(substr($one, 1),false))!==null) {
				return $component;
			}
		}

		if(is_string($one) && isset($this->aliases[$one])) {
			if(!\Yii::$container->hasSingleton($one)) {

				return \Yii::$container->setSingleton($one,[
					'class'=>'mii\base\Query',
					'selector'=>$this->aliases[$one],
				])->get($one);

			}
			return \Yii::$container->get($one);
		}

		if(is_string($one) && stripos($one, '@')!==false && $two!==null) {
			return \Yii::setAlias($one,$two);
		}
		return \Yii::$app;
	}
}
