<?php
/**
 * This is the template for generating a module class file.
 */

/* @var $this yii\web\View */
/* @var $generator mii\modules\gii\generators\module\Generator */

$className = $generator->moduleClass;
$pos = strrpos($className, '\\');
$ns = ltrim(substr($className, 0, $pos), '\\');
$className = substr($className, $pos + 1);

echo "<?php\n";
?>

namespace <?= $ns ?>;
use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;

class <?= $className ?> extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = '<?= $generator->getControllerNamespace() ?>';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

        /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var $module Module */
        if ($app->hasModule('<?= $generator->moduleID ?>') && ($module = $app->getModule('<?= $generator->moduleID ?>')) instanceof Module) {
            
            if ($app instanceof ConsoleApplication) {
                $module->controllerNamespace = 'app\modules\<?= $generator->moduleID ?>\commands';

            } else {
				// config urls example
                $app->get('urlManager')->addRules([

                    $this->id => $this->id . '/default/index',
                    $this->id . '/<controller:[\w\-]+>/<action:[\w\-]+>' => $this->id . '/<controller>/<action>',
            
                ],false);

                /**
				 * $configUrlRule = [
				 *    'prefix' => '<?= $generator->moduleID ?>',
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
            array('label'=>\Yii::t('app','<?= ucfirst($generator->moduleID) ?>'), 'icon'=>'fa fa-folder-open', 'url'=>array('#'), 'items'=>array(
                array('label'=>\Yii::t('app','List of <?= $generator->moduleID ?>'), 'url'=>array("/{$this->id}/{$this->id}/index")),
            )),
        );
    }
}
