<?php

class ChurchSuppliesController extends Controller {

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
        $resource_trans  = ResourceTransaction::model()->findAll('type=:type AND ns_id=:nSid', array(':type'=> '2', ':nSid'=>$id));
        $criteria    = new CDbCriteria;
        $criteria->limit = 5;
        foreach($resource_trans as $resource_value){
           $arr_data[] = $resource_value->attributes['resource_id'];
        }
        $resource_list = '('.implode(',', $arr_data).')';
       // $this->printa($resource_list);exit;
        
        $resource_trans2 = ResourceTransaction::model()->findAll('type=:type AND resource_id IN '.$resource_list.'LIMIT 0, 5', array(':type'=> '1'));

        foreach($resource_trans2 as $resource_trans2_val)
        {
            $needs = ChurchNeeds::model()->findByPk($resource_trans2_val->attributes['ns_id'], $criteria);
            $needs_rel[] = $needs->attributes;

        }
        
        
        $needs_other = ChurchNeeds::model()->findAll($criteria);
//        $this->printa($supplies_other);exit;
        
       // $needs_other = Yii::app()->db->createCommand()
       //         ->select('need_title', 'need_desc')
       //         ->from('church_needs')
       //         ->queryRow();
      
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'resource_rel' => $needs_rel,
            'needs_other' => $needs_other,
 
            
        ));
    }
    
    public function actionRespond($id) {
        $this->layout = '//layouts/column1';
        $comment = new Comments;
        $criteria = new CDbCriteria;
        $criteria->order = 'comment_id desc';
        $comments = Comments::model()->with(array(
                'church_supplies'=>array(
                    'select'=>false,
                    'joinType'=>'INNER JOIN',
                    'condition'=>'church_supplies.supplies_id='.$id,
                ),
            ))->findAll($criteria);
        $church_supplies = ChurchSupplies::model()->with(array(
                'church'=>array(
                    'select'=>false,
                    'joinType'=>'INNER JOIN',
                ),
            ))->findByPk($id);
        
        if($_POST['Comments'])
        {
            $comment->comment_content = $_POST['Comments']['comment_content'];
            $comment->supplies_id = $id;
            $comment->church_id = Yii::app()->user->getUser('churchId');
            $comment->date_posted = date('Y-m-d');
            $comment->need_id = 0;
            
            if($comment->save())
            {
                $notification = new Notifications;
                $notification->church_id = $church_supplies->church_id;
                $notification->notification_title = Yii::app()->user->getUser('churchName');
                $notification->notification_content = "responded on one of your Posted Blessing";
                $notification->notification_date = date('Y-m-d');
                $notification->type = 3;
                $notification->status = 1;
                $notification->affid = 0;
                $notification->save();
                $this->redirect(array('churchSupplies/respond', 'id'=>$id));
            }
            
        }
        $resource_trans  = ResourceTransaction::model()->findAll('type=:type AND ns_id=:nSid', array(':type'=> '2', ':nSid'=>$id));
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
              $supplies_rel[] = $needs->attributes;
              $i++;
            }
            else
            {
                break;
            }
            

        }
            
//        $church
//            echo "function is working"; exit;
        $this->render('respond', array('church_supplies' => $church_supplies, 'comments'=>$comments, 'comment'=>$comment, 'supplies_rel'=>$supplies_rel));
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function insertResourceTransaction($id = "", $cid="") {
        $resourcetrans = new ResourceTransaction;
        
        $resourcetrans->ns_id = $cid;
        $resourcetrans->resource_id = $id;
        $resourcetrans->trans_date = date('Y-m-d');
        $resourcetrans->type = 2;
        $resourcetrans->orsc_id = 0;
        $resourcetrans->save();
    }
    public function actionCreate() {
        $this->layout = '//layouts/column1';
        $churchsupplies = new ChurchSupplies;

        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($churchsupplies);

        if (isset($_POST['ChurchSupplies'])) {
//            $this->printa($_POST['ChurchSupplies']);exit;
            $churchsupplies->attributes = $_POST['ChurchSupplies'];
            $latlng = str_replace("(", "", $_POST['ChurchSupplies']['latlng']);
            $latlng = str_replace(")", "", $latlng);
            $churchsupplies->church_id = Yii::app()->user->getUser('churchId');
            $churchsupplies->supplies_status = 1;
            $churchsupplies->supplies_date = date('Y-m-d');
            $churchsupplies->latlng = $latlng;
            $arrData = explode("-", $_POST['ChurchSupplies']['category']);
            
            
//            $model->attributes = $_POST['ChurchSupplies'];
            if ($churchsupplies->save())
                for ($i = 0; $i < count($arrData); $i++) {
                    $this->insertResourceTransaction($arrData[$i], $churchsupplies->supplies_id);
                }
                
            //insert into News    
            $news = new News;
            $news->news_title = $_POST['ChurchSupplies']['supplies_title'];
            $news->news_content = $_POST['ChurchSupplies']['supplies_desc'];
            $news->news_date = date('Y-m-d');
            $news->church_id = Yii::app()->user->getUser('churchId');
            $news->news_type = 3;
            $news->need_id = 0;
            $news->supplies_id = $churchsupplies->supplies_id;
            $news->save();
            
            $this->redirect(array('view', 'id' => $churchsupplies->supplies_id));
        }

        $dataProvider = new CActiveDataProvider('ResourceType', array(
                    'pagination' => array(
                        'pageSize' => 10000,
                    ),
                ));
        $this->render('create', array(
            'church' => $churchsupplies,
//			'resource'=>$resource,
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

        if (isset($_POST['ChurchSupplies'])) {
            $model->attributes = $_POST['ChurchSupplies'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->supplies_id));
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
        $dataProvider = new CActiveDataProvider('ChurchSupplies');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
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
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ChurchSupplies('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ChurchSupplies']))
            $model->attributes = $_GET['ChurchSupplies'];

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
        $model = ChurchSupplies::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'supplies-forms') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
