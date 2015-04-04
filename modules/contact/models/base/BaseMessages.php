<?php

namespace mii\modules\contact\models\base;

use Yii;

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=Messages::findOne($id);
 * // Or create a new record
 * // $model=new Messages;
 * $model->name='value';
 * $model->email='value';
 * $model->phone='value';
 * $model->message='value';
 * $model->created_at=date('Y-m-d H:i:s');
 * $model->save();
 *
 *
 * Retrive Severals records
 * $contact_messages=Messages::find()->orderBy('order_id')->all();
 * <?php foreach($contact_messages as $data): ?>
 * <?=$data->id;?>
 * <?=$data->name;?>
 * <?=$data->email;?>
 * <?=$data->phone;?>
 * <?= \Yii::$app->formatter->toBr($data->message);?>
 * <?=$data->created_at;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $contact_messages=Messages::model()->find()->one();
 * <?=$contact_messages->id;?>
 * <?=$contact_messages->name;?>
 * <?=$contact_messages->email;?>
 * <?=$contact_messages->phone;?>
 * <?= \Yii::$app->formatter->toBr($contact_messages->message);?>
 * <?=$contact_messages->created_at;?>
 * 
 * This is the model class for table "contact_messages".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property integer $created_at
 */
class BaseMessages extends \yii\db\ActiveRecord
{

    public function afterFind()
    {
        parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'message'], 'required'],
            [['message'], 'string'],
            [['created_at'], 'integer'],
            [['email'], 'email'],
            [['name', 'email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 100]
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
			'email',
			'phone',
			'message',
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
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'message' => 'Message',
            'created_at' => 'Created At',
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
