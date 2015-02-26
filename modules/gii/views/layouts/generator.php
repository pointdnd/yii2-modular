<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $generators \mii\modules\gii\Generator[] */
/* @var $activeGenerator \mii\modules\gii\Generator */
/* @var $content string */

$generators = Yii::$app->controller->module->generators;
$activeGenerator = Yii::$app->controller->generator;
?>
<?php $this->beginContent('@yii/gii/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-md-3 col-sm-4">
        <div class="list-group">
            <?php
            foreach ($generators as $id => $generator) {
                $label = '<i class="glyphicon glyphicon-chevron-right"></i>' . Html::encode($generator->getName());
                echo Html::a($label, ['default/view', 'id' => $id], [
                    'class' => $generator === $activeGenerator ? 'list-group-item active' : 'list-group-item',
                ]);
            }
            ?>
        </div>
        <h4>Your modules</h4>
        <?php foreach(\Yii::$app->getModules() as $id => $module):
            $module=\Yii::$app->getModule($id); ?>
            <?php echo ucfirst($module->id)?> <span class="pull-right"><a href="<?php echo \Yii::$app->urlManager->createUrl(['/gii/default/view','id'=>'crud','module'=>$module->id])?>">CRUD</a> | <a href="<?php echo \Yii::$app->urlManager->createUrl(['/gii/default/view','id'=>'model','module'=>$module->id])?>">Model</a></span>
            <hr style="margin-top:5px;margin-buttom:5px">
        <?php endforeach;?>
    </div>
    <div class="col-md-9 col-sm-8">
        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>
