<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
            'search' => array(
                'class' => 'ext.esearch.SearchAction',
                'model' => 'Church',
                'with' => 'address',
                'attributes' => array('church_name', 'email', 'address.address_det', 'tel_num'),
            ),
        );
    }
    public function actionSearch()
    {
        $this->layout = '//layouts/column1';
        // extenstion widget for search website....
       $results = $this->widget('application.extensions.websiteSearch.WebsiteSearch', array(
                'model' => array(
                    'Church' => array(
                        'church_name, tel_num, email, website, fb_account, twitter_account, youtube_account',
                        'church_name, website',
                        'church_id'
                    ),
                    'ChurchNeeds' => array(
                        'need_title, need_desc',
                        'need_title, need_desc',
                        'need_id'
                    ),
                    'ChurchSupplies' => array(
                        'supplies_title, supplies_desc',
                        'supplies_title, supplies_desc',
                        'supplies_id'
                    ),
                    'News' => array(
                        'news_title, news_content',
                        'news_title, news_content',
                        'news_id'
                    ),
                    'Notifications' => array(
                        'notification_title, notification_content',
                        'notification_title, notification_content',
                        'notification_id'
                    ),
                ),
            ));    
       $results = $results->init();
       $this->render('ext.websiteSearch.resultspage', array('results'=>$results));
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->layout = '//layouts/column1';
        $church = Church::model()->findAll(); // $params is not needed
        $i = 0;
        $criteria = new CDbCriteria;
        foreach ($church as $value) {
            if ($_GET['type'] && $_GET['type2']) {
                $criteria->condition = 'church.church_id=:churchId and (news_type=:type or news_type=:type2)';
                $criteria->params = array(':type' => $_GET['type'], ':churchId' => $value->church_id, ':type2' => $_GET['type2']);
            } else if ($_GET['type']) {
                $criteria->condition = 'church.church_id=:churchId and news_type=:type';
                $criteria->params = array(':type' => $_GET['type'], ':churchId' => $value->church_id);
            } else {
                $criteria->condition = "church.church_id=:churchId";
                $criteria->params = array(':churchId' => $value->church_id);
            }
            $news = News::model()->with(array(
                        'church' => array(
                            'select' => false,
                            'joinType' => 'INNER JOIN',
                        ),
                    ))->findAll($criteria);

            foreach ($news as $value2) {
                $arrData[$i] = $value2->attributes;
                $arrData[$i]['church'] = $value2->church->attributes;

                if ($value2->news_type == 2) {
                    $needs = ChurchNeeds::model()->findByPk($value2->need_id);
                    $arrData[$i]['latlng2'] = $needs->latlng;
                }
                if ($value2->news_type == 3) {
                    $supplies = ChurchSupplies::model()->findByPk($value2->supplies_id);
                    $arrData[$i]['latlng2'] = $supplies->latlng;
                }
                $arrData[$i]['latlng'] = $value->latlng;
//                $this->printa($arrData[$i]);
                $i++;
            }
        }
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index', array(
            'news' => $arrData,
        ));
    }

    public function actionNotifications($id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "church_id = :churchId and archived != 1 LIMIT 0, 20";
        $criteria->params = array(':churchId'=>$id);
        $notifs = Notifications::model()->findAll($criteria);
//    printa($notifs);
        $html = "<table style='padding: 10px; width: 100%'>";

        foreach ($notifs as $value) {
            $html .= "<tr>";
            $html .= "<td>";
            $html .= "<b>" . $value->notification_title . "</b> " . $value->notification_content;
            $html .= "</td>";
            $html .= "</tr>";
            if ($value->type == 1) {
                $html .= "<tr>";
                $html .= "<td >";
                $html .= "<a style='padding: 5px 8px; margin: 5px; background: #0D3C80' >Decline</a> <a style='padding: 5px 8px; margin: 5px; background: #0D3C80' href='index.php?r=site/acceptAff&id={$value->church_id}&affid={$value->affid}'>Accept</a>";
                $html .= "</td>";
                $html .= "</tr>";
            } else {
                $html .= "<tr>";
                $html .= "<td>";
                $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "</tr>";
            }
        }
        $html .= "</table>";
        $flds = array();
        $flds['status'] = 2;
        Notifications::model()->updateAll($flds, "church_id = :churchId", array(':churchId'=>$id));
        echo $html;
        
        exit;
    }
    
    public function actionAcceptAff($id, $affid){
        $flds = array();
        $flds['status'] = 2;
        Affiliation::model()->updateAll($flds, "(church_id = :churchId and affid = :affId) or (church_id = :affId and affid = :churchId)", array(':churchId'=>$id, ':affId'=>$affid));
        $flds = array();
        $flds['archived'] = 1;
        Notifications::model()->updateAll($flds, "church_id = :churchId", array(':churchId'=>$id));
        $this->render('affiliatesuccess');
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

    public function actionFind() {
        $church = new Church('search');
        $church->unsetAttributes();
        
        if (isset($_GET['Church']))
            $church->attributes = $_GET['Church'];
        $this->render('find', array('church' => $church));
    }

    public function actionPreFind() {

        $this->render('preFind');
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;
        $church = new Church;
        $user = new AppUsers;
        $address = new ChurchAddress();
        $this->performAjaxValidation(array($address, $church, $user));

        if ($_POST['AppUsers'] && $_POST['Church'] && $_POST['ChurchAddress']) {
            $church->attributes = $_POST['Church'];
            $church->profile_id = 0;
            $church->address_id = 0;
            $church->latlng = 0;
            $church->status = 1;
            $church->save();

            $user->attributes = $_POST['AppUsers'];
            $user->ud_id = 0;
            $user->user_password = md5($_POST['AppUsers']['user_password']);
            $user->user_status = 1;
            $user->user_type = 'Member';
            $user->church_id = $church->church_id;
            $user->ud_id = 0;

            $address->attributes = $_POST['ChurchAddress'];
            $address->church_id = $church->church_id;
            $address->municipality = "none";
            if ($address->save() && $user->save()) {
                $this->redirect(array('church/view', 'id' => $church->church_id));
            }
        }
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model, 'church' => $church, 'user' => $user, 'address' => $address));
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'getconnected-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}