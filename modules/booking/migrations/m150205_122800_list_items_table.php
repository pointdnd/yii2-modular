<?php

use yii\db\Schema;
use yii\db\Migration;

class m150205_122800_list_items_table extends Migration
{
    public function up()
    {
    	$this->createTable('booking_items',[
    		'id'=>'pk',
    		'name'=>Schema::TYPE_STRING.'(255) NOT NULL',
    		'description'=>Schema::TYPE_TEXT.' NOT NULL',
    		'image'=>Schema::TYPE_STRING.'(100) NOT NULL COMMENT "type:img"',
    		'created_at'=>Schema::TYPE_INTEGER.' NULL',
		]);
    	$this->createTable('booking_messages',[
    		'id'=>'pk',
    		'message'=>Schema::TYPE_TEXT.' NOT NULL',
    		'users_sender_id'=>Schema::TYPE_INTEGER.' NOT NULL',
    		'users_owner_id'=>Schema::TYPE_INTEGER.' NULL',
    		'created_at'=>Schema::TYPE_INTEGER.' NULL',
    		'booking_items_id'=>Schema::TYPE_INTEGER.' NOT NULL',
		]);
		$this->addForeignKey('fk_booking_items_id','booking_messages','booking_items_id','booking_items','id','CASCADE','CASCADE');
    	$this->addForeignKey('fk_users_sender_id','booking_messages','users_sender_id','users_user','id','CASCADE','CASCADE');
   		$this->addForeignKey('fk_users_owner_id','booking_messages','users_owner_id','users_user','id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_booking_items_id','booking_messages');
        $this->dropForeignKey('fk_users_sender_id','booking_messages');
        $this->dropForeignKey('fk_users_owner_id','booking_messages');
        $this->dropTable('booking_items');
        $this->dropTable('booking_messages');
    }
}
