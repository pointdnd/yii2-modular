<?php

namespace mii\modules\products\models\base;

use Yii;

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=Packages::findOne($id);
 * // Or create a new record
 * // $model=new Packages;
 * $model->name='value';
 * $model->owner='value';
 * $model->email='value';
 * $model->phone='value';
 * $model->money='value';
 * $model->info='value';
 * $model->files='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $products_packages=Packages::find()->orderBy('order_id')->all();
 * <?php foreach($products_packages as $data): ?>
 * <?=$data->id;?>
 * <?=$data->name;?>
 * <?=$data->owner;?>
 * <?=$data->email;?>
 * <?=$data->phone;?>
 * <?=$data->money;?>
 * <?=$data->info;?>
 * <?=$data->filesPath;?>
 * <?= \yii\helpers\Html::link('<i class="fa fa-download"></i>',$data->filesPath,array('font-size:100%'));?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $products_packages=Packages::model()->find()->one();
 * <?=$products_packages->id;?>
 * <?=$products_packages->name;?>
 * <?=$products_packages->owner;?>
 * <?=$products_packages->email;?>
 * <?=$products_packages->phone;?>
 * <?=$products_packages->money;?>
 * <?=$products_packages->info;?>
 * <?=$products_packages->filesPath;?>
 * <?= \yii\helpers\Html::link('<i class="fa fa-download"></i>',$products_packages->filesPath,array('font-size:100%'));?>
 * 
 * This is the model class for table "products_packages".
 *
 * @property integer $id
 * @property string $name
 * @property string $owner
 * @property string $email
 * @property string $phone
 * @property integer $money
 * @property string $info
 * @property string $files
 */
class BasePackages extends \yii\db\ActiveRecord
{
	public $files_path;

    public function afterFind()
    {
        parent::afterFind();
		$this->files_path = \Yii::getAlias('@web/uploads').'/'.$this->files;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_packages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'owner', 'email', 'phone'], 'required'],
            [['money'], 'integer'],
            [['info'], 'string'],
            [['email'], 'trim'],
            [['email'], 'email'],
            [['name'], 'string', 'max' => 150],
            [['owner', 'email'], 'string', 'max' => 255],
            [['phone', 'files'], 'string', 'max' => 100]
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
			'owner',
			'email',
			'phone',
			'money',
			'info',
			'files',
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
            'name' => y('app', 'Name'),
            'owner' => y('app', 'Owner'),
            'email' => y('app', 'Email'),
            'phone' => y('app', 'Phone'),
            'money' => y('app', 'Money'),
            'info' => y('app', 'Info'),
            'files' => y('app', 'Files'),
        ];
    }

}
