<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use yii\db\Schema;
use mii\modules\users\migrations\Migration;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class m140504_130429_create_token_table extends Migration
{
    public function up()
    {
        $this->createTable('users_token', [
            'user_id'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'code'       => Schema::TYPE_STRING . '(32) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'type'       => Schema::TYPE_SMALLINT . ' NOT NULL'
        ], $this->tableOptions);

        $this->createIndex('token_unique', 'users_token', ['user_id', 'code', 'type'], true);
        $this->addForeignKey('fk_user_token', 'users_token', 'user_id', 'users_user', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('users_token');
    }
}
