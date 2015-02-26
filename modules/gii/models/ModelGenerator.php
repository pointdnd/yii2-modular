<?php

namespace mii\modules\gii\models;

use mii\modules\gii\models\base\BaseModelGenerator;
use Yii;

/**
 * This is the model class for table "gii_model_generator".
 *
 * @property integer $id
 * @property string $db
 * @property string $ns
 * @property string $tableName
 * @property string $modelClass
 * @property string $baseClass
 * @property integer $generateRelations
 * @property integer $generateLabelsFromComments
 * @property integer $useTablePrefix
 * @property string $templates
 * @property string $template
 * @property integer $enableI18N
 * @property string $messageCategory
 */
class ModelGenerator extends BaseModelGenerator
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
