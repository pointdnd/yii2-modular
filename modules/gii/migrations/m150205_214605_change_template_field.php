<?php

use yii\db\Schema;
use yii\db\Migration;

class m150205_214605_change_template_field extends Migration
{
    public function up()
    {
    	$this->alterColumn('gii_crud_generator','templates',Schema::TYPE_TEXT.' NOT NULL');
    }

    public function down()
    {
        return false;
    }
}
