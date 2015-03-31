<?php

namespace mii\modules\booking\models;

use mii\modules\booking\models\base\BaseItems;
use Yii;

/**
 * This is the model class for table "booking_items".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $created_at
 *
 * @property BookingMessages[] $bookingMessages
 */
class Items extends BaseItems
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
