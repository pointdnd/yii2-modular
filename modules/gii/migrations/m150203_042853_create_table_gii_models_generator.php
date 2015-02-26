<?php

use yii\db\Schema;
use yii\db\Migration;

class m150203_042853_create_table_gii_models_generator extends Migration
{
    public function up()
    {
    	$tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('gii_model_generator',[
        	'id'=>'pk',
        	'db'=> Schema::TYPE_STRING.'(255) NOT NULL',
        	'ns'=> Schema::TYPE_STRING.'(255) NOT NULL',
        	'tableName'=> Schema::TYPE_STRING.'(255) NOT NULL',
        	'modelClass'=> Schema::TYPE_STRING.'(255) NOT NULL',
        	'baseClass'=> Schema::TYPE_STRING.'(255) NOT NULL',
        	'generateRelations'=> Schema::TYPE_SMALLINT.'(1) NULL',
			'generateLabelsFromComments'=> Schema::TYPE_SMALLINT.'(1) NULL', 
			'useTablePrefix'=> Schema::TYPE_SMALLINT.'(1) NULL', 
        	'templates'=> Schema::TYPE_TEXT.' NOT NULL',
        	'template'=> Schema::TYPE_STRING.'(100) NOT NULL',
			'enableI18N'=> Schema::TYPE_SMALLINT.'(1) NULL', 
        	'messageCategory'=> Schema::TYPE_STRING.'(100) NOT NULL',
		],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('gii_model_generator');
    }
}
