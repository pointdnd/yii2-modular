<?php

namespace mii\modules\outlet\models;

use mii\modules\outlet\models\base\BaseQuestions;
use Yii;

/**
 * This is the model class for table "outlet_questions".
 *
 * @property integer $id
 * @property string $question
 * @property string $response
 * @property string $icon
 * @property integer $order_id
 */
class Questions extends BaseQuestions
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
