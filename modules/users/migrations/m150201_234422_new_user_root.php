<?php

use yii\db\Schema;
use yii\db\Migration;
use mii\modules\users\models\User;
use mii\modules\users\helpers\Password;

class m150201_234422_new_user_root extends Migration
{
    public function up()
    {
    	$root = \Yii::createObject([
			'class'=>User::className(),
			'scenario'=>'create',
			'email'=>'root@email.com',
			'username'=>'root',
			'password'=>'rootroot',
		]);
    	$root->create();
    	$root->confirm();
    	
    	$admin = \Yii::createObject([
			'class'=>User::className(),
			'scenario'=>'create',
			'email'=>'admin@email.com',
			'username'=>'admin',
			'password'=>'adminadmin',
		]);
    	$admin->create();
    	$admin->confirm();

    	$user = \Yii::createObject([
			'class'=>User::className(),
			'scenario'=>'create',
			'email'=>'user@email.com',
			'username'=>'user',
			'password'=>'useruser',
		]);
    	$user->create();
    	$user->confirm();
    }

    public function down()
    {
        $root = User::find()->where(['email'=>'root@email.com'])->one();
        $root->delete();
        $admin = User::find()->where(['email'=>'admin@email.com'])->one();
        $admin->delete();
        $user = User::find()->where(['email'=>'user@email.com'])->one();
        $user->delete();
    }
}
