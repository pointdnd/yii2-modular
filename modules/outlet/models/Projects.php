<?php

namespace mii\modules\outlet\models;

use mii\modules\outlet\models\base\BaseProjects;
use Yii;

/**
 * This is the model class for table "outlet_projects".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $order_id
 */
class Projects extends BaseProjects
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
