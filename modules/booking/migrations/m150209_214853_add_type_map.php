<?php

use yii\db\Schema;
use yii\db\Migration;

class m150209_214853_add_type_map extends Migration
{
    public function up()
    {
    	$this->dropColumn('booking_items','map_address');
    	$this->addColumn('booking_items','map_address',Schema::TYPE_STRING.'(100) NOT NULL COMMENT "type:map"');
    }

    public function down()
    {
    }
}
