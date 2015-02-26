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
class m140504_113157_update_tables extends Migration
{
    public function up()
    {
        // user table
        $this->dropIndex('user_confirmation', 'users_user');
        $this->dropIndex('user_recovery', 'users_user');
        $this->dropColumn('users_user', 'confirmation_token');
        $this->dropColumn('users_user', 'confirmation_sent_at');
        $this->dropColumn('users_user', 'recovery_token');
        $this->dropColumn('users_user', 'recovery_sent_at');
        $this->dropColumn('users_user', 'logged_in_from');
        $this->dropColumn('users_user', 'logged_in_at');
        $this->renameColumn('users_user', 'registered_from', 'registration_ip');
        $this->addColumn('users_user', 'flags', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0');

        // account table
        $this->renameColumn('users_account', 'properties', 'data');
    }

    public function down()
    {
        return false;
    }
}
