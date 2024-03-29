<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\db\Schema;
use mii\modules\users\migrations\Migration;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class m140403_174025_create_account_table extends Migration
{
    public function up()
    {
        $this->createTable('users_account', [
            'id'         => Schema::TYPE_PK,
            'user_id'    => Schema::TYPE_INTEGER,
            'provider'   => Schema::TYPE_STRING . ' NOT NULL',
            'client_id'  => Schema::TYPE_STRING . ' NOT NULL',
            'properties' => Schema::TYPE_TEXT
        ], $this->tableOptions);

        $this->createIndex('account_unique', 'users_account', ['provider', 'client_id'], true);
        $this->addForeignKey('fk_user_account', 'users_account', 'user_id', 'users_user', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('users_account');
    }
}