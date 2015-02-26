<?php

use yii\db\Schema;
use yii\db\Migration;
use app\modules\users\models\User;

class m150202_020325_assign_started_roles extends Migration
{
    public function up()
    {
		$auth = \Yii::$app->authManager;

        // add "root" role and give this role the "createPost" permission
        $root = $auth->createRole('root');
        $auth->add($root);
        
        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $rootUser = User::find()->where(['email'=>'root@email.com'])->one();
        $adminUser = User::find()->where(['email'=>'admin@email.com'])->one();
        
        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($root, $rootUser->id);
        $auth->assign($admin, $adminUser->id);
    }

    public function down()
    {
		$auth = \Yii::$app->authManager;

        $rootUser = User::find()->where(['email'=>'root@email.com'])->one();
        $adminUser = User::find()->where(['email'=>'admin@email.com'])->one();
        
	    $root = $auth->getItems('root');
	    $admin = $auth->getItems('admin');
    
        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->revoke($root, $rootUser->id);
        $auth->revoke($admin, $adminUser->id);
        
        $auth->removeItem($root);
        $auth->removeItem($admin);
	}
}
