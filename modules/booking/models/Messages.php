<?php

namespace app\modules\booking\models;

use app\modules\booking\models\base\BaseMessages;
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
class Messages extends BaseMessages
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
