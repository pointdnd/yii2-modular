<?php

namespace tests\codeception\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = 'app\modules\users\models\User';
}
