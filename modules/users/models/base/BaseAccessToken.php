<?php

namespace mii\modules\users\models\base;

use Yii;

/**
 * This is the model class for table "users_access_tokens".
 *
 * @property integer $id
 * @property string $access_token
 * @property string $access_token_refresh
 * @property string $os
 * @property string $ip
 * @property integer $created_at
 * @property integer $users_user_id
 *
 * @property UsersUser $usersUser
 */
class BaseAccessToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_access_tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['access_token', 'access_token_refresh', 'users_user_id'], 'required'],
            [['created_at', 'users_user_id'], 'integer'],
            [['access_token', 'access_token_refresh', 'os', 'ip'], 'string', 'max' => 255],
            [['access_token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'access_token' => Yii::t('app', 'Access Token'),
            'access_token_refresh' => Yii::t('app', 'Access Token Refresh'),
            'os' => Yii::t('app', 'Os'),
            'ip' => Yii::t('app', 'Ip'),
            'created_at' => Yii::t('app', 'Created At'),
            'users_user_id' => Yii::t('app', 'Users User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersUser()
    {
        return $this->hasOne(UsersUser::className(), ['id' => 'users_user_id']);
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
