<?php

class EventsController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->layout = '//layouts/column1';
        $model = new Events;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Events'])) {
//            $this->printa($_POST['Events']);
//            exit;
            $model->attributes = $_POST['Events'];
            $model->church_id = Yii::app()->user->getUser('churchId');
            $latlng = str_replace("(", "", $_POST['Events']['latlng']);
            $latlng = str_replace(")", "", $latlng);
            $model->latlng = $latlng;
            
            if ($model->save()) {
                //insert into News    
                $news = new News;
                $news->news_title = $_POST['Events']['event_name'];
                $news->news_content = $_POST['Events']['event_desc'];
                $news->news_date = date('Y-m-d');
                $news->church_id = Yii::app()->user->getUser('churchId');
                $news->news_type = 5;
                $news->need_id = 0;
                $news->supplies_id = 0;
                $news->save();
                $this->redirect(array('view', 'id' => $model->event_id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Events'])) {
            $model->attributes = $_POST['Events'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->event_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
//        $this->printa(Yii::app()->user->getUser('churchCountry'));
//         exit;
        $this->layout = '//layouts/column1';

//        $dataProvider = new CActiveDataProvider('Events');
//        $church = Church::model()->with('address')->findAll();
//        foreach($church as $value){
//            $this->printa($value->attributes);
//            $this->printa($value->address->attributes);
        $eventsInt = Events::model()->with(array(
                    'address' => array(
                        'select' => false,
                        'joinType' => 'INNER JOIN',
                        'condition' => 'address.country!=' . "'" . Yii::app()->user->getUser('churchCountry') . "'",
                    ),
                ))->findAll();
        foreach ($eventsInt as $value2) {
            $arrData[] = $value2->attributes;
        }

        $eventsLoc = Events::model()->with(array(
                    'address' => array(
                        'select' => false,
                        'joinType' => 'INNER JOIN',
                        'condition' => 'address.country=' . "'" . Yii::app()->user->getUser('churchCountry') . "'",
                    ),
                ))->findAll();
        foreach ($eventsLoc as $value3) {
            $arrData2[] = $value3->attributes;
        }
//        }
//        $this->printa($arrData2);
//         exit;
//        $church = $eventsInt->church;
//        $this->printa($church->attributes); exit;
        $this->render('index', array(
            'local' => $arrData2,
            'international' => $arrData,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Events('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Events']))
            $model->attributes = $_GET['Events'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Events::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'events-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
