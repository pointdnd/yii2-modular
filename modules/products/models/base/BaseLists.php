<?php

namespace mii\modules\products\models\base;

use Yii;

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=Lists::findOne($id);
 * // Or create a new record
 * // $model=new Lists;
 * $model->title='value';
 * $model->image='value';
 * $model->description='value';
 * $model->price='value';
 * $model->products_packages_id='value';
 * $model->orden_id='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $products_list=Lists::find()->orderBy('order_id')->all();
 * <?php foreach($products_list as $data): ?>
 * <?=$data->id;?>
 * <?=$data->title;?>
 * <?=$data->imagePath;?>
 * <?= \yii\helpers\Html::image($data->imagePath,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$data->description;?>
 * <?=$data->price;?>
 * <?=$data->products_packages_id;?>
 * <?=$data->orden_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $products_list=Lists::model()->find()->one();
 * <?=$products_list->id;?>
 * <?=$products_list->title;?>
 * <?=$products_list->imagePath;?>
 * <?= \yii\helpers\Html::image($products_list->imagePath,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$products_list->description;?>
 * <?=$products_list->price;?>
 * <?=$products_list->products_packages_id;?>
 * <?=$products_list->orden_id;?>
 * 
 * This is the model class for table "products_list".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property integer $price
 * @property integer $products_packages_id
 * @property integer $orden_id
 */
class BaseLists extends \yii\db\ActiveRecord
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
        return 'products_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'image', 'description', 'price'], 'required'],
            [['description'], 'string'],
            [['price', 'products_packages_id', 'orden_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
			'title',
			'image',
			'description',
			'price',
			'products_packages_id',
			'orden_id',
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => y('app', 'ID'),
            'title' => y('app', 'Title'),
            'image' => y('app', 'Image'),
            'description' => y('app', 'Description'),
            'price' => y('app', 'Price'),
            'products_packages_id' => y('app', 'Products Packages ID'),
            'orden_id' => y('app', 'Orden ID'),
        ];
    }

}
