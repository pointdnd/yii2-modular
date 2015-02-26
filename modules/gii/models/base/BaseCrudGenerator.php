<?php

namespace app\modules\gii\models\base;

use Yii;

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=CrudGenerator::findOne($id);
 * // Or create a new record
 * // $model=new CrudGenerator;
 * $model->modelClass='value';
 * $model->controllerClass='value';
 * $model->viewPath='value';
 * $model->baseControllerClass='value';
 * $model->indexWidgetType='value';
 * $model->searchModelClass='value';
 * $model->templates='value';
 * $model->template='value';
 * $model->enableI18N='value';
 * $model->messageCategory='value';
 * $model->created_at=date('Y-m-d H:i:s');
 * $model->save();
 *
 *
 * Retrive Severals records
 * $gii_crud_generator=CrudGenerator::find()->orderBy('order_id')->all();
 * <?php foreach($gii_crud_generator as $data): ?>
 * <?=$data->id;?>
 * <?=$data->modelClass;?>
 * <?=$data->controllerClass;?>
 * <?=$data->viewPath;?>
 * <?=$data->baseControllerClass;?>
 * <?=$data->indexWidgetType;?>
 * <?=$data->searchModelClass;?>
 * <?= \Yii::$app->formatter->toBr($data->templates);?>
 * <?=$data->template;?>
 * <?=$data->enableI18N;?>
 * <?=$data->messageCategory;?>
 * <?=$data->created_at;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $gii_crud_generator=CrudGenerator::model()->find()->one();
 * <?=$gii_crud_generator->id;?>
 * <?=$gii_crud_generator->modelClass;?>
 * <?=$gii_crud_generator->controllerClass;?>
 * <?=$gii_crud_generator->viewPath;?>
 * <?=$gii_crud_generator->baseControllerClass;?>
 * <?=$gii_crud_generator->indexWidgetType;?>
 * <?=$gii_crud_generator->searchModelClass;?>
 * <?= \Yii::$app->formatter->toBr($gii_crud_generator->templates);?>
 * <?=$gii_crud_generator->template;?>
 * <?=$gii_crud_generator->enableI18N;?>
 * <?=$gii_crud_generator->messageCategory;?>
 * <?=$gii_crud_generator->created_at;?>
 * 
 * This is the model class for table "gii_crud_generator".
 *
 * @property integer $id
 * @property string $modelClass
 * @property string $controllerClass
 * @property string $viewPath
 * @property string $baseControllerClass
 * @property string $indexWidgetType
 * @property string $searchModelClass
 * @property string $templates
 * @property string $template
 * @property integer $enableI18N
 * @property string $messageCategory
 * @property integer $created_at
 */
class BaseCrudGenerator extends \yii\db\ActiveRecord
{

    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gii_crud_generator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modelClass', 'controllerClass', 'baseControllerClass', 'indexWidgetType', 'templates', 'template', 'created_at'], 'required'],
            [['templates'], 'string'],
            [['enableI18N', 'created_at'], 'integer'],
            [['modelClass', 'controllerClass', 'viewPath', 'baseControllerClass', 'indexWidgetType', 'searchModelClass', 'template', 'messageCategory'], 'string', 'max' => 255]
        ];
    }

    // explicitly list every field, best used when you want to make sure the changes
    // in your DB table or model attributes do not cause your field changes (to keep API backward compatibility).
    public function fields()
    {
        return [
            // field name is the same as the attribute name
			'id',
			'modelClass',
			'controllerClass',
			'viewPath',
			'baseControllerClass',
			'indexWidgetType',
			'searchModelClass',
			'templates',
			'template',
			'enableI18N',
			'messageCategory',
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
			'created_at',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'modelClass' => Yii::t('app', 'Model Class'),
            'controllerClass' => Yii::t('app', 'Controller Class'),
            'viewPath' => Yii::t('app', 'View Path'),
            'baseControllerClass' => Yii::t('app', 'Base Controller Class'),
            'indexWidgetType' => Yii::t('app', 'Index Widget Type'),
            'searchModelClass' => Yii::t('app', 'Search Model Class'),
            'templates' => Yii::t('app', 'Templates'),
            'template' => Yii::t('app', 'Template'),
            'enableI18N' => Yii::t('app', 'Enable I18 N'),
            'messageCategory' => Yii::t('app', 'Message Category'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /** @inheritdoc */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->setAttribute('created_at', time());
        }
        return parent::beforeSave($insert);
    }
}
