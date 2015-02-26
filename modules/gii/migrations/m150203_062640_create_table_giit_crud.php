<?php

use yii\db\Schema;
use yii\db\Migration;

class m150203_062640_create_table_giit_crud extends Migration
{
    public function up()
    {
		$this->createTable('gii_crud_generator',[
			"id"=>'pk',
			"modelClass"=>Schema::TYPE_STRING.'(255) NOT NULL',
			"controllerClass"=>Schema::TYPE_STRING.'(255) NOT NULL',
			"viewPath"=>Schema::TYPE_STRING.'(255) NOT NULL',
			"baseControllerClass"=>Schema::TYPE_STRING.'(255) NOT NULL',
			"indexWidgetType"=>Schema::TYPE_STRING.'(255) NOT NULL',
			"searchModelClass"=>Schema::TYPE_STRING.'(255) NOT NULL',
			"templates"=>Schema::TYPE_STRING.'(255) NOT NULL',
			"template"=>Schema::TYPE_STRING.'(255) NOT NULL',
			"enableI18N"=>Schema::TYPE_SMALLINT.'(1) NULL',
			"messageCategory"=>Schema::TYPE_STRING.'(255) NULL',
			"created_at"=>Schema::TYPE_INTEGER.' NOT NULL',
		]);
    }

    public function down()
    {
        $this->dropTable('gii_crud_generator');
    }
}
