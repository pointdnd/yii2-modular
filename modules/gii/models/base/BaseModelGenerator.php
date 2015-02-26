<?php

namespace mii\modules\gii\models\base;

use Yii;

/**
 * This is the model class for table "gii_model_generator".
 *
 * @property integer $id
 * @property string $db
 * @property string $ns
 * @property string $tableName
 * @property string $modelClass
 * @property string $baseClass
 * @property integer $generateRelations
 * @property integer $generateLabelsFromComments
 * @property integer $useTablePrefix
 * @property string $templates
 * @property string $template
 * @property integer $enableI18N
 * @property string $messageCategory
 */
class BaseModelGenerator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gii_model_generator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['db', 'ns', 'tableName', 'modelClass', 'baseClass', 'templates', 'template', 'messageCategory'], 'required'],
            [['generateRelations', 'generateLabelsFromComments', 'useTablePrefix', 'enableI18N'], 'integer'],
            [['templates'], 'string'],
            [['db', 'ns', 'tableName', 'modelClass', 'baseClass'], 'string', 'max' => 255],
            [['template', 'messageCategory'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'db' => Yii::t('app', 'Db'),
            'ns' => Yii::t('app', 'Ns'),
            'tableName' => Yii::t('app', 'Table Name'),
            'modelClass' => Yii::t('app', 'Model Class'),
            'baseClass' => Yii::t('app', 'Base Class'),
            'generateRelations' => Yii::t('app', 'Generate Relations'),
            'generateLabelsFromComments' => Yii::t('app', 'Generate Labels From Comments'),
            'useTablePrefix' => Yii::t('app', 'Use Table Prefix'),
            'templates' => Yii::t('app', 'Templates'),
            'template' => Yii::t('app', 'Template'),
            'enableI18N' => Yii::t('app', 'Enable I18 N'),
            'messageCategory' => Yii::t('app', 'Message Category'),
        ];
    }
}
