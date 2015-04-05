<?php

namespace mii\modules\outlet;
use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = 'mii\modules\outlet\controllers';

    public $proyectsLists = [];
    
    public $questionLists = [];

    public $homeTitle = '';
    
    public $homeSubTitle = '';

    public $homeButton = '';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

        /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var $module Module */
        if ($app->hasModule('outlet') && ($module = $app->getModule('outlet')) instanceof Module) {
            
            if ($app instanceof ConsoleApplication) {
                $module->controllerNamespace = 'mii\modules\outlet\commands';

            } else {
				// config urls example
                $app->get('urlManager')->addRules([

                    $this->id => $this->id . '/default/index',
                    $this->id . '/<controller:[\w\-]+>/<action:[\w\-]+>' => $this->id . '/<controller>/<action>',
            
                ],false);

                /**
				 * $configUrlRule = [
				 *    'prefix' => 'outlet',
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
            array('label'=>\Yii::t('app','Outlet'), 'icon'=>'fa fa-folder-open', 'url'=>array('#'), 'items'=>array(
                array('label'=>\Yii::t('app','Proyects'), 'url'=>array("/{$this->id}/projects/index")),
            )),
        );
    }
}
