<?php

namespace app\modules\booking\models\base;

use Yii;

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=Items::findOne($id);
 * // Or create a new record
 * // $model=new Items;
 * $model->name='value';
 * $model->description='value';
 * $model->image='value';
 * $model->created_at=date('Y-m-d H:i:s');
 * $model->map_address_lat='value';
 * $model->map_address_lng='value';
 * $model->map_address='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $booking_items=Items::find()->orderBy('order_id')->all();
 * <?php foreach($booking_items as $data): ?>
 * <?=$data->id;?>
 * <?=$data->name;?>
 * <?= \Yii::$app->formatter->toBr($data->description);?>
 * <?=$data->imagePath;?>
 * <?= \yii\helpers\Html::image($data->imagePath,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$data->created_at;?>
 * <?=$data->map_address_lat;?>
 * <?=$data->map_address_lng;?>
 * <?=$data->map_address;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $booking_items=Items::model()->find()->one();
 * <?=$booking_items->id;?>
 * <?=$booking_items->name;?>
 * <?= \Yii::$app->formatter->toBr($booking_items->description);?>
 * <?=$booking_items->imagePath;?>
 * <?= \yii\helpers\Html::image($booking_items->imagePath,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$booking_items->created_at;?>
 * <?=$booking_items->map_address_lat;?>
 * <?=$booking_items->map_address_lng;?>
 * <?=$booking_items->map_address;?>
 * 
 * This is the model class for table "booking_items".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $created_at
 * @property double $map_address_lat
 * @property double $map_address_lng
 * @property string $map_address
 *
 * @property BookingMessages[] $bookingMessages
 */
class BaseItems extends \yii\db\ActiveRecord
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
        return 'booking_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'image', 'map_address_lat', 'map_address_lng', 'map_address'], 'required'],
            [['description'], 'string'],
            [['created_at'], 'integer'],
            [['map_address_lat', 'map_address_lng'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['image', 'map_address'], 'string', 'max' => 100]
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
			'map_address_lat',
			'map_address_lng',
			'map_address',
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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'created_at' => Yii::t('app', 'Created At'),
            'map_address_lat' => Yii::t('app', 'Map Address Lat'),
            'map_address_lng' => Yii::t('app', 'Map Address Lng'),
            'map_address' => Yii::t('app', 'Map Address'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingMessages()
    {
        return $this->hasMany(BookingMessages::className(), ['booking_items_id' => 'id']);
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
