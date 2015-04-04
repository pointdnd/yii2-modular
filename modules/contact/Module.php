<?php

namespace mii\modules\contact;
use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = 'mii\modules\contact\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

        /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var $module Module */
        if ($app->hasModule('contact') && ($module = $app->getModule('contact')) instanceof Module) {
            
            if ($app instanceof ConsoleApplication) {
                $module->controllerNamespace = 'app\modules\contact\commands';

            } else {
				// config urls example
                $app->get('urlManager')->addRules([

                    $this->id => $this->id . '/default/index',
                    $this->id . '/<controller:[\w\-]+>/<action:[\w\-]+>' => $this->id . '/<controller>/<action>',
            
                ],false);

                /**
				 * $configUrlRule = [
				 *    'prefix' => 'contact',
				 *    'rules'  => [
				 *       // Put here your module group rules
				 *    ]
				 * ];
				 * $app->get('urlManager')->rules[] = new GroupUrlRule($configUrlRule);
                */
            }
		}
        
    }

    public function getMenuAdmin()
    {
        return array(
            array('label'=>\Yii::t('app','Contact'), 'icon'=>'fa fa-folder-open', 'url'=>array('#'), 'items'=>array(
                array('label'=>\Yii::t('app','List of contact'), 'url'=>array('/'.$this->id.'/messages/index')),
            )),
        );
    }
}
