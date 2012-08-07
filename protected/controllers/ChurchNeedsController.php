<?php

class ChurchNeedsController extends Controller {

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
                'actions' => array('index', 'view', 'haha'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'respond'),
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
       
        $this->layout = '//layouts/column1';
        $resource_trans  = ResourceTransaction::model()->findAll('type=:type AND ns_id=:nSid', array(':type'=> '1', ':nSid'=>$id));
        $criteria    = new CDbCriteria;
        $criteria->limit = 5;
        
        foreach($resource_trans as $resource_value){
           $arr_data[] = $resource_value->attributes['resource_id'];
        }
        $resource_list = '('.implode(',', $arr_data).')';
       // $this->printa($resource_list);exit;
        
        $resource_trans2 = ResourceTransaction::model()->findAll('type=:type AND resource_id IN '.$resource_list, array(':type'=> '2'));
        $i=0;
        foreach($resource_trans2 as $resource_trans2_val)
        {
            if($i < 5)
            {
              $supplies = ChurchSupplies::model()->findByPk($resource_trans2_val->attributes['ns_id']);
              $supplies_rel[] = $supplies->attributes;
              $i++;
            }
            else
            {
                break;
            }
            

        }
        $supplies_other = ChurchSupplies::model()->findAll($criteria);
//        $this->printa($supplies_other);exit;
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'resource_rel' => $supplies_rel,
            'supplies_other' => $supplies_other,
 
            
        ));
        
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionRespond($id) {
        $this->layout = '//layouts/column1';
        $comment = new Comments;
        $criteria = new CDbCriteria;
        $criteria->order = 'comment_id desc';
        $comments = Comments::model()->with(array(
                'church_needs'=>array(
                    'select'=>false,
                    'joinType'=>'INNER JOIN',
                    'condition'=>'church_needs.need_id='.$id,
                ),
            ))->findAll($criteria);
        $church_need = ChurchNeeds::model()->with(array(
                'church'=>array(
                    'select'=>false,
                    'joinType'=>'INNER JOIN',
                ),
            ))->findByPk($id);
        
        if($_POST['Comments'])
        {
            $comment->comment_content = $_POST['Comments']['comment_content'];
            $comment->need_id = $id;
            $comment->church_id = Yii::app()->user->getUser('churchId');
            $comment->date_posted = date('Y-m-d');
            $comment->supplies_id = 0;
            
            if($comment->save())
            {
                $notification = new Notifications;
                $notification->church_id = $church_need->church_id;
                $notification->notification_title = Yii::app()->user->getUser('churchName');
                $notification->notification_content = "responded on one of your Posted Needs";
                $notification->notification_date = date('Y-m-d');
                $notification->type = 2;
                $notification->status = 1;
                $notification->affid = 0;
                $notification->save();
                $this->redirect(array('churchNeeds/respond', 'id'=>$id));
            }
            
        }
        $resource_trans  = ResourceTransaction::model()->findAll('type=:type AND ns_id=:nSid', array(':type'=> '1', ':nSid'=>$id));
        $criteria->limit = 5;
        
        foreach($resource_trans as $resource_value){
           $arr_data[] = $resource_value->attributes['resource_id'];
        }
        $resource_list = '('.implode(',', $arr_data).')';
       // $this->printa($resource_list);exit;
        
        $resource_trans2 = ResourceTransaction::model()->findAll('type=:type AND resource_id IN '.$resource_list, array(':type'=> '1'));
        $i=0;
        foreach($resource_trans2 as $resource_trans2_val)
        {
            if($i < 5)
            {
              $needs = ChurchNeeds::model()->findByPk($resource_trans2_val->attributes['ns_id']);
              $needs_rel[] = $needs->attributes;
              $i++;
            }
            else
            {
                break;
            }
            

        }
            
//        $church
//            echo "function is working"; exit;
        $this->render('respond', array('church_need' => $church_need, 'comments'=>$comments, 'comment'=>$comment, 'needs_rel'=>$needs_rel));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function insertResourceTransaction($id = "", $cid = "") {
        $resourcetrans = new ResourceTransaction;

        $resourcetrans->ns_id = $cid;
        $resourcetrans->resource_id = $id;
        $resourcetrans->trans_date = date('Y-m-d');
        $resourcetrans->type = 1;
        $resourcetrans->orsc_id = 0;
        $resourcetrans->save();
    }

    public function actionCreate() {
        $this->layout = '//layouts/column1';
        $churchneeds = new ChurchNeeds;
//        if (isset($_POST['ajax']) && $_POST['ajax'] === 'church-needs-form') {
//            echo CActiveForm::validate($churchneeds);
//            Yii::app()->end();
//        }

//		$resource=new ResourceType;
//                $this->printa($resource);exit;
        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($churchneeds);

        if (isset($_POST['ChurchNeeds'])) {
//                    $this->printa($_POST);exit;
            $churchneeds->attributes = $_POST['ChurchNeeds'];
            $latlng = str_replace("(", "", $_POST['ChurchNeeds']['latlng']);
            $latlng = str_replace(")", "", $latlng);
            $churchneeds->church_id = Yii::app()->user->getUser('churchId');
            $churchneeds->need_status = 1;
            $churchneeds->need_date = date('Y-m-d');
            $churchneeds->latlng = $latlng;
            $arrData = explode("-", $_POST['ChurchNeeds']['category']);

//                        $this->printa($arrData);exit;
            if ($churchneeds->save())
                for ($i = 0; $i < count($arrData); $i++) {
                    $this->insertResourceTransaction($arrData[$i], $churchneeds->need_id);
                }
            //insert into News    
            $news = new News;
            $news->news_title = $_POST['ChurchNeeds']['need_title'];
            $news->news_content = $_POST['ChurchNeeds']['need_desc'];
            $news->news_date = date('Y-m-d');
            $news->church_id = Yii::app()->user->getUser('churchId');
            $news->news_type = 2;
            $news->need_id = $churchneeds->need_id;
            $news->supplies_id = 0;
            $news->save();
            
            $this->redirect(array('view', 'id' => $churchneeds->need_id));
//				$this->redirect(array('haha'));
        }
//                $resource=ResourceType::model()->find();
//                $this->printa($resource->attributes);exit;
        $dataProvider = new CActiveDataProvider('ResourceType', array(
                    'pagination' => array(
                        'pageSize' => 10000,
                    ),
                ));
        $this->render('create', array(
            'church' => $churchneeds,
            'dataProvider' => $dataProvider,
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

        if (isset($_POST['ChurchNeeds'])) {
            $model->attributes = $_POST['ChurchNeeds'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->need_id));
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
        $dataProvider = new CActiveDataProvider('ChurchNeeds');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->layout = '//layouts/column1';
        $model = new ChurchNeeds('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ChurchNeeds']))
            $model->attributes = $_GET['ChurchNeeds'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
    
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = ChurchNeeds::model()->findByPk($id);
//                $this->printa($model2);exit;
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'needs-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
