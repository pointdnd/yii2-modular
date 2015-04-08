<?php

namespace mii\modules\contact\models;

use mii\modules\contact\models\base\BaseMessages;
use Yii;

/**
 * This is the model class for table "contact_messages".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property string $created_at
 */
class Messages extends BaseMessages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'message'], 'required','message'=>'Por favor envianos un {attribute}'],
            [['message'], 'string'],
            [['created_at', 'sent', 'read'], 'integer'],
            [['email'], 'trim'],
            [['email'], 'email'],
            [['sent', 'read'], 'boolean'],
            [['name', 'email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 100]
        ];
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
