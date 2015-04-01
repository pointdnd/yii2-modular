<?php

namespace mii\modules\outlet\models\base;

use Yii;

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=Projects::findOne($id);
 * // Or create a new record
 * // $model=new Projects;
 * $model->name='value';
 * $model->description='value';
 * $model->image='value';
 * $last=Projects::find()->count();
 * $model->order_id=count($last)+1;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $outlet_projects=Projects::find()->orderBy('order_id')->all();
 * <?php foreach($outlet_projects as $data): ?>
 * <?=$data->id;?>
 * <?=$data->name;?>
 * <?= \Yii::$app->formatter->toBr($data->description);?>
 * <?=$data->imagePath;?>
 * <?= \yii\helpers\Html::image($data->imagePath,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$data->order_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $outlet_projects=Projects::model()->find()->one();
 * <?=$outlet_projects->id;?>
 * <?=$outlet_projects->name;?>
 * <?= \Yii::$app->formatter->toBr($outlet_projects->description);?>
 * <?=$outlet_projects->imagePath;?>
 * <?= \yii\helpers\Html::image($outlet_projects->imagePath,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$outlet_projects->order_id;?>
 * 
 * This is the model class for table "outlet_projects".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $order_id
 */
class BaseProjects extends \yii\db\ActiveRecord
{
	public $image_path;

    public function afterFind()
    {
        parent::afterFind();
		$this->image_path = \Yii::getAlias('@web/uploads').'/'.$this->image;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outlet_projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'image', 'order_id'], 'required'],
            [['description'], 'string'],
            [['order_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 100]
        ];
    }

    // explicitly list every field, best used when you want to make sure the changes
    // in your DB table or model attributes do not cause your field changes (to keep API backward compatibility).
    public function fields()
    {
        return [
            // field name is the same as the attribute name
			'id',
			'name',
			'description',
			'image',
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
			'order_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'order_id' => 'Order ID',
        ];
    }

}
