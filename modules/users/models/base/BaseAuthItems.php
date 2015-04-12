<?php

namespace mii\modules\users\models\base;

use Yii;

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=AuthItems::findOne($id);
 * // Or create a new record
 * // $model=new AuthItems;
 * $model->name='value';
 * $model->type='value';
 * $model->description='value';
 * $model->rule_name='value';
 * $model->data='value';
 * $model->created_at=date('Y-m-d H:i:s');
 * $model->updated_at=date('Y-m-d H:i:s');
 * $model->save();
 *
 *
 * Retrive Severals records
 * $users_auth_item=AuthItems::find()->orderBy('order_id')->all();
 * <?php foreach($users_auth_item as $data): ?>
 * <?=$data->name;?>
 * <?=$data->type;?>
 * <?= \Yii::$app->formatter->toBr($data->description);?>
 * <?=$data->rule_name;?>
 * <?= \Yii::$app->formatter->toBr($data->data);?>
 * <?=$data->created_at;?>
 * <?=$data->updated_at;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $users_auth_item=AuthItems::model()->find()->one();
 * <?=$users_auth_item->name;?>
 * <?=$users_auth_item->type;?>
 * <?= \Yii::$app->formatter->toBr($users_auth_item->description);?>
 * <?=$users_auth_item->rule_name;?>
 * <?= \Yii::$app->formatter->toBr($users_auth_item->data);?>
 * <?=$users_auth_item->created_at;?>
 * <?=$users_auth_item->updated_at;?>
 * 
 * This is the model class for table "users_auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property UsersAuthAssignment[] $usersAuthAssignments
 * @property UsersAuthRule $ruleName
 * @property UsersAuthItemChild[] $usersAuthItemChildren
 */
class BaseAuthItems extends \yii\db\ActiveRecord
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
        return 'users_auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64]
        ];
    }

    // explicitly list every field, best used when you want to make sure the changes
    // in your DB table or model attributes do not cause your field changes (to keep API backward compatibility).
    public function fields()
    {
        return [
            // field name is the same as the attribute name
			'name',
			'type',
			'description',
			'rule_name',
			'data',
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
			'created_at',
			'updated_at',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'rule_name' => 'Rule Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersAuthAssignments()
    {
        return $this->hasMany(UsersAuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(UsersAuthRule::className(), ['name' => 'rule_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersAuthItemChildren()
    {
        return $this->hasMany(UsersAuthItemChild::className(), ['child' => 'name']);
    }

    /** @inheritdoc */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->setAttribute('created_at', time());
        }
        $this->setAttribute('updated_at', time());
        return parent::beforeSave($insert);
    }
}
