<?php
/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator app\modules\gii\generators\module\Generator */

echo "<?php\n";
?>

namespace <?= $generator->getControllerNamespace() ?>;

use yii\web\Controller;

class DefaultController extends Controller
{

    public function init()
    {
        //\Yii::$app->getModule('<?=$generator->moduleID?>')->setViewPath('@app/views/<?=$generator->moduleID?>');
        parent::init();
        // custom initialization code goes here
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
