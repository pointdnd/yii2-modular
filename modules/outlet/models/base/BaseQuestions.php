<?php

namespace mii\modules\outlet\models\base;

use Yii;

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=Questions::findOne($id);
 * // Or create a new record
 * // $model=new Questions;
 * $model->question='value';
 * $model->response='value';
 * $model->icon='value';
 * $last=Questions::find()->count();
 * $model->order_id=count($last)+1;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $outlet_questions=Questions::find()->orderBy('order_id')->all();
 * <?php foreach($outlet_questions as $data): ?>
 * <?=$data->id;?>
 * <?=$data->question;?>
 * <?=$data->response;?>
 * <?=$data->icon;?>
 * <?=$data->order_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $outlet_questions=Questions::model()->find()->one();
 * <?=$outlet_questions->id;?>
 * <?=$outlet_questions->question;?>
 * <?=$outlet_questions->response;?>
 * <?=$outlet_questions->icon;?>
 * <?=$outlet_questions->order_id;?>
 * 
 * This is the model class for table "outlet_questions".
 *
 * @property integer $id
 * @property string $question
 * @property string $response
 * @property string $icon
 * @property integer $order_id
 */
class BaseQuestions extends \yii\db\ActiveRecord
{

    public function afterFind()
    {
        parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outlet_questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'response', 'icon', 'order_id'], 'required'],
            [['response'], 'string'],
            [['order_id'], 'integer'],
            [['question'], 'string', 'max' => 255],
            [['icon'], 'string', 'max' => 100]
        ];
    }

    // explicitly list every field, best used when you want to make sure the changes
    // in your DB table or model attributes do not cause your field changes (to keep API backward compatibility).
    public function fields()
    {
        return [
            // field name is the same as the attribute name
			'id',
			'question',
			'response',
			'icon',
            // field name is "email", the corresponding attribute name is "email_address"
            // 'email' => 'email_address',
            // field name is "name", its value is defined by a PHP callback
            // 'name' => function ($model) {
            //    return $model->first_name . ' ' . $model->last_name;
            // },
        ];
    }

    public function extraFields()
    {
        return [
			'order_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'response' => 'Response',
            'icon' => 'Icon',
            'order_id' => 'Order ID',
        ];
    }

}
