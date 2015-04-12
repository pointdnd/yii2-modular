<?php

namespace mii\modules\products\controllers;

use Yii;

use mii\modules\products\models\Lists;
use mii\modules\products\models\ListsSearch;
use mii\modules\products\models\Packages;
use mii\modules\products\models\PackagesSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PackagesController implements the CRUD actions for Packages model.
 */
class PackagesController extends \mii\web\AdminController
{
    public function init()
    {
        $this->icon = 'fa-folder-open';
        $this->title = 'Packages';
        $this->subTitle = 'Packages';

        parent::init();
        // custom initialization code goes here
    }

    /**
     * Lists all Packages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PackagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Packages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->title = $model->name;

        $searchModel = new ListsSearch();
        $dataProvider = $searchModel->search(array_merge(['products_packages_id'=>'1'],Yii::$app->request->queryParams));

        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Packages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Packages();
        
        if(isset($_GET['name'])) {
            $model->name=$_GET['name'];
        }
        
        if(isset($_GET['owner'])) {
            $model->owner=$_GET['owner'];
        }
        
        if(isset($_GET['email'])) {
            $model->email=$_GET['email'];
        }
        
        if(isset($_GET['phone'])) {
            $model->phone=$_GET['phone'];
        }
        
        if(isset($_GET['money'])) {
            $model->money=$_GET['money'];
        }

        if(isset($_GET['message'])) {
            $model->info=$_GET['message'];
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Packages model.
     * If creation is successful, the response will be a 'success'=true.
     * @return mixed
     *   
     *  $(document).on('submit','#packages-form',function(e) {
     *    e.preventDefault();
     *    var $form = $(this);
     *    $.ajax({
     *        url: '<?php echo y('.urlManager')->createUrl("/module/controller/create-ajax");?>',
     *        dataType: 'json', 
     *        type: 'post',
     *        data: $form.serialize(),
     *        success: function (data){
     *
     *          console.log(data);
     *
     *          $.each($form.serializeArray(), function(index, name) {
     *            $('[name='+name.name+']')
     *              .parent()
     *              .find('#validate-'+name.name)
     *              .remove();
     *          });
     *
     *          if(data.success) {
     *            $form[0].reset();
     *            bootbox.alert(data.message);
     *
     *          } else {
     *
     *            $.each(data.data, function(name, errors) {
     *              $('[name='+name+']')
     *              .parent()
     *              .append($('<p id="validate-'+name+'" class="help-block text-danger">'+errors.join(',<br>')+'</p>'));
     *            });
     *          }
     *        }
     *    });
     *  });
     *
    */
    public function actionCreateAjax()
    {
        y('.response')->format = 'json';
        $model = new Packages();
        $model->attributes=$_REQUEST;
        if ($model->save()) { 
            return [
                'success'=>1,
                'data'=>$model,
                'message'=>y('app','Record created!')
            ];
        } else {
            return [
                'success'=>0,
                'data'=>$model->getErrors()
            ];
        }
    }

    /**
     * Updates an existing Packages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Packages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Packages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Packages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Packages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
