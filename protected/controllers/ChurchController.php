<?php

class ChurchController extends Controller {

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
                'actions' => array('create', 'update','affiliate'),
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
        $church = new Church;
        $shoutout = new ChurchShoutout;
        
        
        $church = $this->loadModel($id);
        $this->performAjaxValidation($church);
        $ministries = ChurchMinistry::model()->findAll('church_id=:churchId', array(':churchId' => $id));
//        $this->printa($ministries);exit;
        if (isset($_POST['Church'])) {
            $church->attributes = $_POST['Church'];
            if ($church->save())
                $this->redirect(array('view', 'id' => $church->church_id));
        }
        if (isset($_POST['ChurchShoutout'])) {
            $shoutout->attributes = $_POST['ChurchShoutout'];
            $shoutout->church_id = Yii::app()->user->getUser('churchId');
            $shoutout->shoutout_date = date('Y-m-d');
            $shoutout->shoutout_type = 1;
            if ($shoutout->save())
                $this->redirect(array('view', 'id' => $church->church_id));
        }
        foreach ($ministries as $min_val) {
            $min_array[] = $min_val->attributes;
        }

        $this->render('view', array(
            'arrData' => $this->loadChurch($id),
            'church' => $church,
            'shoutout' => $shoutout,
            'ministries' => $min_array,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Church;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Church'])) {
            $model->attributes = $_POST['Church'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->church_id));
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

        if (isset($_POST['Church'])) {
            $model->attributes = $_POST['Church'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->church_id));
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
        $this->layout = '//layouts/column1';
        $criteria = new CDbCriteria;
        $affiliation = Affiliation::model()->findAll('affid = :churchId', array(':churchId'=>Yii::app()->user->getUser('churchId')));
        foreach($affiliation as $value){
            $affcid[] = $value->church_id;
        }
        if($affcid != ""){
            $affcidstring = "( ".implode(',',$affcid)." )";
            $criteria->condition = "t.church_id not in $affcidstring and t.church_id != :churchId";
            $criteria->params = array(':churchId'=>Yii::app()->user->getUser('churchId'));
        }else{
            $criteria->condition = "";
        }
//        echo $affcidstring;exit;
        $church = Church::model()->with('address','user')->findAll($criteria);
        $this->render('index', array(
            'church' => $church,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Church('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Church']))
            $model->attributes = $_GET['Church'];

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
        $church = Church::model()->findByPk($id);
        if ($church === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $arrData['church'] = $church->attributes;

        return $church;
    }
    
    public function actionAffiliate($id){
        $church = Church::model()->findByPk($id);
        $affiliation = new Affiliation;
        $affiliation->church_id = Yii::app()->user->getUser('churchId');
        $affiliation->affid = $id;
        $affiliation->affiliation_date = date('Y-m-d');
        $affiliation->status = 1;
        
        $affiliation->save();
        
        $affiliation2 = new Affiliation;
        $affiliation2->affid = Yii::app()->user->getUser('churchId');
        $affiliation2->church_id = $id;
        $affiliation2->affiliation_date = date('Y-m-d');
        $affiliation2->status = 1;
        
        $affiliation2->save();
        
        $notification = new Notifications;
        $notification->church_id = Yii::app()->user->getUser('churchId');
        $notification->notification_title = "You";
        $notification->notification_content = "sent an Affiliate request to ".$church->church_name;
        $notification->notification_date = date('Y-m-d');
        $notification->type = 5;
        $notification->status = 1;
        $notification2->archived = 0;
        $notification->affid = $id;
        $notification->save();
        
        $notification2 = new Notifications;
        $notification2->church_id = $id;
        $notification2->notification_title = Yii::app()->user->getUser('churchName');
        $notification2->notification_content = 'wants to affiliate with you';
        $notification2->notification_date = date('Y-m-d');
        $notification2->type = 1;
        $notification2->status = 1;
        $notification2->archived = 0;
        $notification2->affid = Yii::app()->user->getUser('churchId');
        $notification2->save();
        
        
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('church/index'));
        
    }

    public function loadChurch($id) {
        $church = Church::model()->findByPk($id);
        $address = ChurchAddress::model()->find('church_id=:churchId', array(':churchId' => $id));
        $profile = ChurchProfile::model()->find('church_id=:churchId', array(':churchId' => $id));
        $need = ChurchNeeds::model()->findAll('church_id=:churchId order by need_id desc LIMIT 0, 5', array(':churchId' => $id));
        $blessing = ChurchSupplies::model()->findAll('church_id=:churchId order by supplies_id desc LIMIT 0, 5', array(':churchId' => $id));
        if ($church === null && $address === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
//        $this->printa($church->attributes);
//        $this->printa($address->attributes);exit;
        $arrData['church'] = $church->attributes;
        $arrData['address'] = $address->attributes;
        $arrData['profile'] = $profile->attributes;
        foreach ($need as $attributes) {
            $arrData['need'][] = $attributes->attributes;
        }
        foreach ($blessing as $attributes2) {
            $arrData['blessing'][] = $attributes2->attributes;
        }
//        $this->printa($arrData);exit;
        return $arrData;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'editchurch') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
