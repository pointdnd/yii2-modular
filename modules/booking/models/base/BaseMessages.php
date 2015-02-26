<?php

namespace mii\modules\booking\models\base;

use Yii;

/**
 * This is the model class for table "booking_messages".
 *
 * @property integer $id
 * @property string $message
 * @property integer $users_sender_id
 * @property integer $users_owner_id
 * @property integer $created_at
 * @property integer $booking_items_id
 *
 * @property BookingItems $bookingItems
 * @property UsersUser $usersOwner
 * @property UsersUser $usersSender
 */
class BaseMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'users_sender_id', 'booking_items_id'], 'required'],
            [['message'], 'string'],
            [['users_sender_id', 'users_owner_id', 'created_at', 'booking_items_id'], 'integer']
        ];
    }

    // explicitly list every field, best used when you want to make sure the changes
    // in your DB table or model attributes do not cause your field changes (to keep API backward compatibility).
    public function fields()
    {
        return [
            // field name is the same as the attribute name
			'id',
			'message',
			'users_sender_id',
			'users_owner_id',
			'booking_items_id',
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
            'message' => Yii::t('app', 'Message'),
            'users_sender_id' => Yii::t('app', 'Users Sender ID'),
            'users_owner_id' => Yii::t('app', 'Users Owner ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'booking_items_id' => Yii::t('app', 'Booking Items ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingItems()
    {
        return $this->hasOne(BookingItems::className(), ['id' => 'booking_items_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersOwner()
    {
        return $this->hasOne(UsersUser::className(), ['id' => 'users_owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersSender()
    {
        return $this->hasOne(UsersUser::className(), ['id' => 'users_sender_id']);
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
