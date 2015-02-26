<?php

namespace app\modules\users\models;

use app\modules\users\models\base\BaseAccessToken;
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
class AccessToken extends BaseAccessToken
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(),[
            // Here your custon rules that wont be overwrite by generator
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            // Here your custon attributeLabels that wont be overwrite by generator
        ]);
    }
}
