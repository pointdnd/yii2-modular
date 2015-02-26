<?php

namespace app\modules\booking\commands;
use yii\console\Controller;
use yii\helpers\Console;

class DefaultController extends Controller
{
	/**
     * Confirms a user by setting confirmed_at field to current time.
     *
     * @param string $search Email or username
     */
    public function actionIndex($name = null)
    {
        if ($name !== null) {
            $this->stdout(\Yii::t('app', 'Hello ') . $name . " from booking module\n", Console::FG_RED);
        } else {
            $this->stdout(\Yii::t('app', 'Error occurred with bame params') . "\n", Console::FG_RED);
        }
    }
}
