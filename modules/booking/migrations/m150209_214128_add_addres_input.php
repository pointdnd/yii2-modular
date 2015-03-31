<?php

use yii\db\Schema;
use yii\db\Migration;

class m150209_214128_add_addres_input extends Migration
{
    public function up()
    {
    	$this->addColumn('booking_items','map_address',Schema::TYPE_STRING.'(255) NOT NULL');
    	$this->addColumn('booking_items','map_address_lat',Schema::TYPE_FLOAT.' NOT NULL');
    	$this->addColumn('booking_items','map_address_lng',Schema::TYPE_FLOAT.' NOT NULL');
    }

    public function down()
    {
    }
}
