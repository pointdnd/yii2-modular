<?php

use yii\db\Schema;
use yii\db\Migration;

class m150204_030357_table_users_acces_token extends Migration
{
    public function up()
    {
    	$this->createTable('users_access_tokens',[
    		'id'=>'pk',
    		'access_token'=>Schema::TYPE_STRING.'(255) NOT NULL',
    		'access_token_refresh'=>Schema::TYPE_STRING.'(255) NOT NULL',
    		'os'=>Schema::TYPE_STRING.'(255) NULL',
    		'ip'=>Schema::TYPE_STRING.'(255) NULL',
    		'created_at'=>Schema::TYPE_INTEGER.' NULL',
    		'users_user_id'=>Schema::TYPE_INTEGER.' NOT NULL',
		]);
		$this->createIndex('access-token-unique','users_access_tokens',['access_token'],true);
		$this->addForeignKey('fk_users_access_tokens', 'users_access_tokens', 'users_user_id', 'users_user', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('users_access_tokens');
    }
}
