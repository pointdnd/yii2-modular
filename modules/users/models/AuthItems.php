<?php

namespace mii\modules\users\models;

use mii\modules\users\models\base\BaseAuthItems;
use Yii;

/**
 * This is the model class for table "users_auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property UsersAuthAssignment[] $usersAuthAssignments
 * @property UsersAuthRule $ruleName
 * @property UsersAuthItemChild[] $usersAuthItemChildren
 */
class AuthItems extends BaseAuthItems
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
