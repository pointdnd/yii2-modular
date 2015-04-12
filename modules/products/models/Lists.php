<?php

namespace mii\modules\products\models;

use mii\modules\products\models\base\BaseLists;
use Yii;

/**
 * This is the model class for table "products_list".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property integer $price
 * @property integer $products_packages_id
 * @property integer $orden_id
 */
class Lists extends BaseLists
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
