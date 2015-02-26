<?php

namespace app\modules\gii\models;

use app\modules\gii\models\base\BaseCrudGenerator;
use Yii;

/**
 * This is the model class for table "gii_crud_generator".
 *
 * @property integer $id
 * @property string $modelClass
 * @property string $controllerClass
 * @property string $viewPath
 * @property string $baseControllerClass
 * @property string $indexWidgetType
 * @property string $searchModelClass
 * @property string $templates
 * @property string $template
 * @property integer $enableI18N
 * @property string $messageCategory
 * @property integer $created_at
 */
class CrudGenerator extends BaseCrudGenerator
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
