<?php
/**
 * This is the template for generating the model class of a specified table.
 */

/* @var $this yii\web\View */
/* @var $generator mii\modules\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

foreach ($tableSchema->columns as $column)
    $safeAttributes[] = $column->name;

$module = \Yii::$app->getModule('gii');
$hideAttributes = $module->hideAttributes();

echo "<?php\n";
?>

namespace <?= $generator->ns ?>\base;

use Yii;

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=<?php echo $className; ?>::findOne($id);
 * // Or create a new record
 * // $model=new <?php echo $className; ?>;
<?php 
foreach($tableSchema->columns as $column)
{
    if($column->name=='id')
        continue;
    if($column->name=='order_id')
    {
        echo " * \$last=".$className."::find()->count();\n";
        echo " * \$model->order_id=count(\$last)+1;\n";
    }
    elseif($column->name=='updated_at')
        echo " * \$model->updated_at=date('Y-m-d H:i:s');\n";
    elseif($column->name=='created_at')
        echo " * \$model->created_at=date('Y-m-d H:i:s');\n";
    elseif($column->name=='users_id' or $column->name=='users_users_id' or $column->name=='user_id')
        echo " * \$model->".$column->name."=\Yii::$app->user->identity->id;\n";
    elseif(stripos($column->name, "money_")!==false)
        echo " * \$model->".$column->name."=strtr(\$model->".$column->name.",array(\",\"=>\"\"));\n";
    else
        echo " * \$model->".$column->name."='value';\n";

}
?>
 * $model->save();
 *
 *
 * Retrive Severals records
 * $<?php echo strtolower($tableName); ?>=<?php echo $className; ?>::find()->orderBy('order_id')->all();
 * <?php echo "<?php foreach(\$".strtolower($tableName)." as \$data): ?>\n"?>
<?php foreach($tableSchema->columns as $column): ?><?php $commentType=$module->getParamsField($column);?>
<?php if($commentType['type']==='file'): ?>
 * <?php echo "<?=\$data->".$column->name."Path;?>\n"; ?>
 * <?php echo "<?= \yii\helpers\Html::link('<i class=\"fa fa-download\"></i>',\$data->".$column->name."Path,array('font-size:100%'));?>\n"; ?>
<?php elseif($commentType['type']==='img'): ?>
 * <?php echo "<?=\$data->".$column->name."Path;?>\n"; ?>
 * <?php echo "<?= \yii\helpers\Html::image(\$data->".$column->name."Path,'',array('class'=>'img-responsive img-thumbnail'));?>\n"; ?>
<?php elseif($commentType['type']==='money'): ?>
 * <?php echo "<?= \Yii::\$app->formatter->money(\$data->".$column->name.");?>\n"; ?>
<?php elseif($commentType['type']==='text'): ?>
 * <?php echo "<?= \Yii::\$app->formatter->toBr(\$data->".$column->name.");?>\n"; ?>
<?php elseif($commentType['type']==='date' or $commentType['type']==='datetime'): ?>
 * <?php echo "<?= \Yii::\$app->formatter->formatAgoComment(\$data->".$column->name.");?>\n"; ?>
<?php else: ?>
 * <?php echo "<?=\$data->".$column->name.";?>\n"; ?>
<?php endif; ?>
<?php endforeach; ?>
 * <?php echo "<?php endforeach; ?>\n"?>
 * 
 *
 * Retrive first record
 * $<?php echo strtolower($tableName); ?>=<?php echo $className; ?>::model()->find()->one();
<?php foreach($tableSchema->columns as $column): ?><?php $commentType=$module->getParamsField($column);?>
<?php if($commentType['type']==='file'): ?>
 * <?php echo "<?=\$".strtolower($tableName)."->".$column->name."Path;?>\n"; ?>
 * <?php echo "<?= \yii\helpers\Html::link('<i class=\"fa fa-download\"></i>',\$".strtolower($tableName)."->".$column->name."Path,array('font-size:100%'));?>\n"; ?>
<?php elseif($commentType['type']==='img'): ?>
 * <?php echo "<?=\$".strtolower($tableName)."->".$column->name."Path;?>\n"; ?>
 * <?php echo "<?= \yii\helpers\Html::image(\$".strtolower($tableName)."->".$column->name."Path,'',array('class'=>'img-responsive img-thumbnail'));?>\n"; ?>
<?php elseif($commentType['type']==='money'): ?>
 * <?php echo "<?= \Yii::\$app->formatter->money(\$".strtolower($tableName)."->".$column->name.");?>\n"; ?>
<?php elseif($commentType['type']==='text'): ?>
 * <?php echo "<?= \Yii::\$app->formatter->toBr(\$".strtolower($tableName)."->".$column->name.");?>\n"; ?>
<?php elseif($commentType['type']==='date' or $commentType['type']==='datetime'): ?>
 * <?php echo "<?= \Yii::\$app->formatter->formatAgoComment(\$".strtolower($tableName)."->".$column->name.");?>\n"; ?>
<?php else: ?>
 * <?php echo "<?=\$".strtolower($tableName)."->".$column->name.";?>\n"; ?>
<?php endif; ?>
<?php endforeach; ?>
 * 
 * This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
 *
<?php foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name}\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
 *
<?php foreach ($relations as $name => $relation): ?>
 * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class Base<?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{
<?php
foreach($tableSchema->columns as $name=>$column)
{
    $commentType=$module->getParamsField($column);
    if($commentType['type']==='img' or $commentType['type']==='file')
        echo "\tpublic \${$column->name}_path;\n";
    if($commentType['type']==='cms')
        echo "\tpublic \${$column->name}_html;\n";
}
?>

    public function afterFind()
    {
        parent::afterFind();
<?php
foreach($tableSchema->columns as $name=>$column)
{
    $commentType=$module->getParamsField($column);
    if($commentType['type']==='img' or $commentType['type']==='file') {
        echo "\t\t\$this->{$column->name}_path = \Yii::getAlias('@web/uploads').'/'.\$this->{$column->name};\n";
    }
    if($commentType['type']==='cms') {
        echo "\t\t\$this->{$column->name}_html=\Yii::$app->formatter->sirToHtml(\$this->".$column->name.");\n";
    }
}
?>
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '<?= $generator->generateTableName($tableName) ?>';
    }
<?php if ($generator->db !== 'db'): ?>

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [<?= "\n            " . implode(",\n            ", $rules) . "\n        " ?>];
    }

    // explicitly list every field, best used when you want to make sure the changes
    // in your DB table or model attributes do not cause your field changes (to keep API backward compatibility).
    public function fields()
    {
        return [
            // field name is the same as the attribute name
<?php foreach ($safeAttributes as $attribute) {
        if(in_array($attribute, $hideAttributes)) {
            continue;
        }
        echo "\t\t\t'{$attribute}',\n";
} ?>
            // field name is "email", the corresponding attribute name is "email_address"
            // 'email' => 'email_address',
            // field name is "name", its value is defined by a PHP callback
            // 'name' => function ($model) {
            //    return $model->first_name . ' ' . $model->last_name;
            // },
        ];
    }

    public function extraFields()
    {
        return [
<?php foreach ($safeAttributes as $attribute) {
        if(!in_array($attribute, $hideAttributes)) {
            continue;
        }
        echo "\t\t\t'{$attribute}',\n";
} ?>
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
<?php foreach ($labels as $name => $label): ?>
            <?= "'$name' => " . $generator->generateString($label) . ",\n" ?>
<?php endforeach; ?>
        ];
    }
<?php foreach ($relations as $name => $relation): ?>

    /**
     * @return \yii\db\ActiveQuery
     */
    public function get<?= $name ?>()
    {
        <?= $relation[0] . "\n" ?>
    }
<?php endforeach; ?>

<?php foreach ($tableSchema->columns as $column): ?>
<?php if ($column->name=='created_at' or $column->name=='updated_at'): ?>
    /** @inheritdoc */
    public function beforeSave($insert)
    {
<?php foreach ($tableSchema->columns as $column): ?>
<?php if ($column->name=='created_at'): ?>
        if ($insert) {
<?php if ($column->type=='integer'): ?>
            $this->setAttribute('<?=$column->name?>', time());
<?php elseif ($column->type=='datetime'): ?>
            $this->setAttribute('<?=$column->name?>', date("Y-m-d H:i:s"));
<?php endif; ?>
<?php if ($column->name=='order_id'): 
echo "\t\t\t// In oreder to create chronologically asc \n";
echo "\t\t\t//\$last=".$this->modelClass."::find()->all();\n";
echo "\t\t\t//\$this->order_id=count(\$last)+1;\n";
echo "\t\t\t// In oreder to create chronologically desc \n";
echo "\t\t\t\$last=".$this->modelClass."::find()->where(['order'=>'order_id'])->all();\n";
echo "\t\t\t\$i=2;\n";
echo "\t\t\tforeach(\$last as \$data)\n";
echo "\t\t\t{\n";
echo "\t\t\t\t\$data->order_id=\$i++;\n";
echo "\t\t\t\t\$data->save(true,['order_id']);\n";
echo "\t\t\t}\n";
echo "\t\t\t\$this->order_id=1;\n";
?>
            $this->setAttribute('<?=$column->name?>', date("Y-m-d H:i:s"));
<?php endif; ?>
        }
<?php endif; ?>
<?php if ($column->name=='updated_at'): ?>
<?php if ($column->type=='integer'): ?>
        $this->setAttribute('<?=$column->name?>', time());
<?php elseif ($column->type=='datetime'): ?>
        $this->setAttribute('<?=$column->name?>', date("Y-m-d H:i:s"));
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
        return parent::beforeSave($insert);
    }
<?php break; ?>
<?php endif; ?>
<?php endforeach; ?>
}
