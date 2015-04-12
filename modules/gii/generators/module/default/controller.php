<?php
/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator mii\modules\gii\generators\module\Generator */

echo "<?php\n";
?>

namespace <?= $generator->getControllerNamespace() ?>;

class DefaultController extends \mii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }
}
