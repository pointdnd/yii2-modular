<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mii\modules\gii\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use mii\modules\gii\models\ModelGenerator;
use mii\modules\gii\models\CrudGenerator;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DefaultController extends Controller
{
    public $layout = 'generator';
    /**
     * @var \mii\modules\gii\Module
     */
    public $module;
    /**
     * @var \mii\modules\gii\Generator
     */
    public $generator;


    public function actionIndex()
    {
        $this->layout = 'main';

        return $this->render('index');
    }

    public function actionView($id)
    {
        $generator = $this->loadGenerator($id);
        $params = ['generator' => $generator, 'id' => $id];
        
        $storageGenerator = null;
        // In order to implement save history of generates
        if(method_exists($generator, 'beforeRequest'))
            $generator->beforeRequest($this,$id);

        // In order to implement save history of generates
        if(method_exists($generator, 'retriveGenarator'))
            $storageGenerator=$generator->retriveGenarator();

        if(!\Yii::$app->request->isPost and $storageGenerator!==null) {
            $generator->attributes=$storageGenerator->attributes;
            $generator->templates=\yii\helpers\Json::decode($storageGenerator->templates);
        }
        
        if(!\Yii::$app->request->isPost and isset($_GET['module']) and method_exists($generator, 'hasModuleSelected')) {
            $generator->attributes=$generator->hasModuleSelected($_GET['module']);
        }
        

        if (isset($_POST['preview']) || isset($_POST['generate'])) {
            if ($generator->validate()) {
                $generator->saveStickyAttributes();
                $files = $generator->generate();
                if (isset($_POST['generate']) && !empty($_POST['answers'])) {
                    if(!$generator->save($files, (array) $_POST['answers'], $results)) {
                        $params['hasError'] = true;
                    } else {
                        $params['hasError'] = false;
                        
                        if(method_exists($generator, 'afterSuccessSave'))
                            $generator->afterSuccessSave($this,$id);
                    }

                    $params['results'] = $results;
                } else {
                    $params['files'] = $files;
                    $params['answers'] = isset($_POST['answers']) ? $_POST['answers'] : null;
                }
            }
        }
        return $this->render('view', $params);
    }

    public function actionPreview($id, $file)
    {
        $generator = $this->loadGenerator($id);
        if ($generator->validate()) {
            foreach ($generator->generate() as $f) {
                if ($f->id === $file) {
                    $content = $f->preview();
                    if ($content !== false) {
                        return  '<div class="content">' . $content . '</content>';
                    } else {
                        return '<div class="error">Preview is not available for this file type.</div>';
                    }
                }
            }
        }
        throw new NotFoundHttpException("Code file not found: $file");
    }

    public function actionDiff($id, $file)
    {
        $generator = $this->loadGenerator($id);
        if ($generator->validate()) {
            foreach ($generator->generate() as $f) {
                if ($f->id === $file) {
                    return $this->renderPartial('diff', [
                        'diff' => $f->diff(),
                    ]);
                }
            }
        }
        throw new NotFoundHttpException("Code file not found: $file");
    }

    /**
     * Runs an action defined in the generator.
     * Given an action named "xyz", the method "actionXyz()" in the generator will be called.
     * If the method does not exist, a 400 HTTP exception will be thrown.
     * @param string $id the ID of the generator
     * @param string $name the action name
     * @return mixed the result of the action.
     * @throws NotFoundHttpException if the action method does not exist.
     */
    public function actionAction($id, $name)
    {
        $generator = $this->loadGenerator($id);
        $method = 'action' . $name;
        if (method_exists($generator, $method)) {
            return $generator->$method();
        } else {
            throw new NotFoundHttpException("Unknown generator action: $name");
        }
    }

    /**
     * Loads the generator with the specified ID.
     * @param string $id the ID of the generator to be loaded.
     * @return \mii\modules\gii\Generator the loaded generator
     * @throws NotFoundHttpException
     */
    protected function loadGenerator($id)
    {
        if (isset($this->module->generators[$id])) {
            $this->generator = $this->module->generators[$id];
            $this->generator->loadStickyAttributes();
            $this->generator->load($_POST);

            return $this->generator;
        } else {
            throw new NotFoundHttpException("Code generator not found: $id");
        }
    }
}
