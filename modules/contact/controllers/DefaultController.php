<?php

namespace mii\modules\contact\controllers;
use mii\modules\contact\models\Messages;
use yii\web\Controller;

class DefaultController extends Controller
{

    public function init()
    {
        //\Yii::$app->getModule('contact')->setViewPath('@app/views/contact');
        parent::init();
        // custom initialization code goes here
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCron()
    {
        $model = Messages::find()->where(['sent'=>'0'])->all();
        foreach($model as $data) {
            
            // Send messages
            y('.mailer')->compose(['email' => $data->email])
            ->setHtmlBody($this->renderPartial('email',['model'=>$data]))
            ->setFrom('info@retalapp.com')
            ->setTo('info@retalapp.com')
            ->setSubject('Cotizador Retalapp')
            ->send();
            $data->sent=1;
            $data->save(true,['sent']);
        }
    }

    /**
     * Creates a new Messages model.
     * If creation is successful, the response will be a 'success'=true.
     * @return mixed
     *   
     *  $(document).on('submit','#messages-form',function(e) {
     *    e.preventDefault();
     *    var $form = $(this);
     *    $.ajax({
     *        url: '<?php echo y('.urlManager')->createUrl("/contact/default/create-ajax");?>',
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
     *            // here submit 
     *            alert(data.message);
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
        $model = new Messages();
        $model->attributes=$_REQUEST;
        if ($model->save()) {
            return [
                'success'=>1,
                'data'=>$model,
                'message'=>y('app','Message sent, Thanks for contact us')
            ];
        } else {
            return [
                'success'=>0,
                'data'=>$model->getErrors()
            ];
        }
    }
}