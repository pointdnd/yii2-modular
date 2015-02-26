<?php

use yii\db\Schema;
use yii\db\Migration;

class m150203_155313_input_crud_optional extends Migration
{
    public function up()
    {
    	$this->alterColumn('gii_crud_generator','viewPath',Schema::TYPE_STRING.'(255) NULL');
    	$this->alterColumn('gii_crud_generator','searchModelClass',Schema::TYPE_STRING.'(255) NULL');
    }

    public function down()
    {
        return false;
    }
}
