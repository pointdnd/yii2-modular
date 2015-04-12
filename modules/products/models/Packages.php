<?php

namespace mii\modules\products\models;

use mii\modules\products\models\base\BasePackages;
use Yii;

/**
 * This is the model class for table "products_packages".
 *
 * @property integer $id
 * @property string $name
 * @property string $owner
 * @property string $email
 * @property string $phone
 * @property integer $money
 * @property string $info
 * @property string $files
 */
class Packages extends BasePackages
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
