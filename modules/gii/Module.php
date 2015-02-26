<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mii\modules\gii;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\ForbiddenHttpException;

/**
 * This is the main module class for the Gii module.
 *
 * To use Gii, include it as a module in the application configuration like the following:
 *
 * ~~~
 * return [
 *     'bootstrap' => ['gii'],
 *     'modules' => [
 *         'gii' => ['class' => 'mii\modules\gii\Module'],
 *     ],
 * ]
 * ~~~
 *
 * Because Gii generates new code files on the server, you should only use it on your own
 * development machine. To prevent other people from using this module, by default, Gii
 * can only be accessed by localhost. You may configure its [[allowedIPs]] property if
 * you want to make it accessible on other machines.
 *
 * With the above configuration, you will be able to access GiiModule in your browser using
 * the URL `http://localhost/path/to/index.php?r=gii`
 *
 * If your application enables [[\yii\web\UrlManager::enablePrettyUrl|pretty URLs]],
 * you can then access Gii via URL: `http://localhost/path/to/index.php/gii`
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'mii\modules\gii\controllers';
    /**
     * @var array the list of IPs that are allowed to access this module.
     * Each array element represents a single IP filter which can be either an IP address
     * or an address with wildcard (e.g. 192.168.0.*) to represent a network segment.
     * The default value is `['127.0.0.1', '::1']`, which means the module can only be accessed
     * by localhost.
     */
    public $allowedIPs = ['127.0.0.1', '::1'];
    /**
     * @var array|Generator[] a list of generator configurations or instances. The array keys
     * are the generator IDs (e.g. "crud"), and the array elements are the corresponding generator
     * configurations or the instances.
     *
     * After the module is initialized, this property will become an array of generator instances
     * which are created based on the configurations previously taken by this property.
     *
     * Newly assigned generators will be merged with the [[coreGenerators()|core ones]], and the former
     * takes precedence in case when they have the same generator ID.
     */
    public $generators = [];
    /**
     * @var integer the permission to be set for newly generated code files.
     * This value will be used by PHP chmod function.
     * Defaults to 0666, meaning the file is read-writable by all users.
     */
    public $newFileMode = 0666;
    /**
     * @var integer the permission to be set for newly generated directories.
     * This value will be used by PHP chmod function.
     * Defaults to 0777, meaning the directory can be read, written and executed by all users.
     */
    public $newDirMode = 0777;
    
    public $inputsGenerators = [
        
        'img'=> [
            'admin' => [],
            'view' => [],
            'input' => [],
            'modelComments' => [],
            'modelValidate' => [],
            'modelAfterSave' => [],
        ],        

        'text'=> [
            'admin' => [],
            'view' => [],
            'input' => [],
            'modelComments' => [],
            'modelValidate' => [],
            'modelAfterSave' => [],
        ],

    ];

    public function hideAttributes()
    {
        return [
            'created_at',
            'updated_at',
            'map_address_lat',
            'map_address_lng',
            'order_id',
            'users_user_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            $app->getUrlManager()->addRules([
                $this->id => $this->id . '/default/index',
                $this->id . '/<id:\w+>' => $this->id . '/default/view',
                $this->id . '/<controller:[\w\-]+>/<action:[\w\-]+>' => $this->id . '/<controller>/<action>',
            ], false);
        } elseif ($app instanceof \yii\console\Application) {
            $app->controllerMap[$this->id] = [
                'class' => 'mii\modules\gii\console\GenerateController',
                'generators' => array_merge($this->coreGenerators(), $this->generators),
                'module' => $this,
            ];
        }
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app instanceof \yii\web\Application && !$this->checkAccess()) {
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }

        foreach (array_merge($this->coreGenerators(), $this->generators) as $id => $config) {
            $this->generators[$id] = Yii::createObject($config);
        }

        $this->resetGlobalSettings();

        return true;
    }

    /**
     * Resets potentially incompatible global settings done in app config.
     */
    protected function resetGlobalSettings()
    {
        if (Yii::$app instanceof \yii\web\Application) {
            Yii::$app->assetManager->bundles = [];
        }
    }

    /**
     * @return boolean whether the module can be accessed by the current user
     */
    protected function checkAccess()
    {
        $ip = Yii::$app->getRequest()->getUserIP();
        foreach ($this->allowedIPs as $filter) {
            if ($filter === '*' || $filter === $ip || (($pos = strpos($filter, '*')) !== false && !strncmp($ip, $filter, $pos))) {
                return true;
            }
        }
        Yii::warning('Access to Gii is denied due to IP address restriction. The requested IP is ' . $ip, __METHOD__);

        return false;
    }

    /**
     * Returns the list of the core code generator configurations.
     * @return array the list of the core code generator configurations.
     */
    protected function coreGenerators()
    {
        return [
            'model' => ['class' => 'mii\modules\gii\generators\model\Generator'],
            'crud' => ['class' => 'mii\modules\gii\generators\crud\Generator'],
            'controller' => ['class' => 'mii\modules\gii\generators\controller\Generator'],
            'form' => ['class' => 'mii\modules\gii\generators\form\Generator'],
            'module' => ['class' => 'mii\modules\gii\generators\module\Generator'],
            'extension' => ['class' => 'mii\modules\gii\generators\extension\Generator'],
        ];
    }

    public function getParamsField($column)
    {
        $valuesConfig=array('width','height','ext','field','table','label','type','size','w','h','help','comment','unique');

        $width=null;
        $height=null;
        $size=$column->size;
        $comment=$column->comment;
        $label='';
        $type='field';
        $table=null;
        $ext=null;
        $field=null;
        $unique=null;
        

        if($column->type==='integer')
            $type='integer';
            
        if($column->type==='boolean' or strpos($column->dbType,'tinyint(1)')!==false)
            $type='boolean';

        if(strpos($column->dbType,'decimal')!==false)
            $type='decimal';

        if(strpos($column->dbType,'float')!==false)
            $type='float';

        if(strpos($column->dbType,'datetime')!==false)
            $type='datetime';

        if($column->dbType==='date')
            $type='date';

        if($column->dbType==='time')
            $type='hour';
        
        if(stripos($column->dbType,'text')!==false)
            $type='text';

        if(preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
            $type='password';
        
        if(!empty($column->comment))
        {
            $content=explode(";", $column->comment);
            foreach($content as $cont)
            {
                $trimCont=trim($cont);
                if(strpos($trimCont, ':')!==false)
                {
                    $pice=explode(":", $trimCont);
                    $param=strtolower(trim($pice[0]));
                    $value=trim($pice[1]);
                    
                    if(in_array($param, $valuesConfig))
                    {
                        if($param==='type')
                            $type=$value;
                        if($param==='comment' or $param==='help')
                            $comment=$value;
                        if($param==='label')
                            $label=$value;
                        if($param==='width' or $param==='w')
                            $width=$value;
                        if($param==='height' or $param==='h')
                            $height=$value;
                        if($param==='size')
                            $size=$value;
                        if($param==='table')
                            $table=$value;
                        if($param==='ext')
                            $ext=$value;
                        if($param==='field')
                            $field=$value;
                        if($param==='unique')
                            $unique=$value;
                    }
                }
            }
        }
        
        return compact('width','height','size','comment','type','table','ext','label','field','unique');
    }
}
