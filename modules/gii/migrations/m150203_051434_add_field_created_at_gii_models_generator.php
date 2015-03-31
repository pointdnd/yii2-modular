<?php

use yii\db\Schema;
use yii\db\Migration;

class m150203_051434_add_field_created_at_gii_models_generator extends Migration
{
    public function up()
    {
    	$this->addColumn('gii_model_generator','created_at',Schema::TYPE_INTEGER.' NOT NULL');
    }

    public function down()
    {
    	$this->dropColumn('gii_model_generator','created_at');
    }
}
