<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace mii\modules\users\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string  $name
 * @property string  $public_email
 * @property string  $gravatar_email
 * @property string  $gravatar_id
 * @property string  $location
 * @property string  $website
 * @property string  $bio
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class Profile extends ActiveRecord
{
    /** @var \mii\modules\users\Module */
    protected $module;

    /** @inheritdoc */
    public function init()
    {
        $this->module = \Yii::$app->getModule('users');
    }

    /** @inheritdoc */
    public static function tableName()
    {
        return 'users_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bio'], 'string'],
            [['public_email', 'gravatar_email'], 'email'],
            ['website', 'url'],
            [['name', 'public_email', 'gravatar_email', 'location', 'website'], 'string', 'max' => 255],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'name'           => \Yii::t('users', 'Name'),
            'public_email'   => \Yii::t('users', 'Email (public)'),
            'gravatar_email' => \Yii::t('users', 'Gravatar email'),
            'location'       => \Yii::t('users', 'Location'),
            'website'        => \Yii::t('users', 'Website'),
            'bio'            => \Yii::t('users', 'Bio'),
        ];
    }

    /** @inheritdoc */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isAttributeChanged('gravatar_email')) {
                $this->setAttribute('gravatar_id', md5(strtolower($this->getAttribute('gravatar_email'))));
            }
            return true;
        }

        return false;
    }

    /**
     * @return \yii\db\ActiveQueryInterface
     */
    public function getUser()
    {
        return $this->hasOne($this->module->modelMap['User'], ['id' => 'user_id']);
    }
}
