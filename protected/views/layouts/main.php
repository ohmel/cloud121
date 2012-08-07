<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/favicon.ico"/>
        <title><?php echo CHtml::encode($this->pageTitle); ?> <?php if($this->getNotifCount()>0){ echo "(".$this->getNotifCount().")";} ?></title>
        <script>
            //            $(document).ready(function(){
            //                $('#notifs-lnk').click(function(){
            //                    $("#notifications1").toggle();
            //                    $.ajax({url:"index.php?r=site/notifications&id="+<?php echo Yii::app()->user->getUser('churchId') ?>, success:function(result){
            //                            $("#notifs").html(result);   
            //                        }});
            //                    //                    if($("#sem").val() == ""){
            //                    //                        $("#notifs-lnk").css({'background-color': 'white'});
            //                    //                        $("#sem").val("1");
            //                    //                    }else{
            //                    //                        $("#notifs-lnk").css({'background-color': 'transparent'});
            //                    //                        $("#sem").val("");
            //                    //                    }
            //                });
            //            });
            
        </script>
        <?php
        $id = Yii::app()->user->getUser('churchId');
        Yii::app()->clientScript->registerScript('main', "
            $('#notifs-lnk').click(function(){
                    $('#notifications1').toggle();
                    $.ajax({url:'index.php?r=site/notifications&id=$id', success:function(result){
                            $('#notifs').html(result);   
                        }});
                });
        ");
        ?>
    </head>
    <body>
        <div id="header">
            <div id="banner">
                <div id="mainmenu">
                    <center>
                        <table>
                            <tr>
                                <td id="logo">
                                    <img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/headers/cloudlogo.png">
                                </td>
                                <td id="menu">
                                    <div id="search-div">
                                        <form action="index.php" method="get">
                                            <input type="hidden" name="r" value="site/search"/>
                                            <input type="text" name="search_txt" size="30" class="search-text"/>
                                            <input type="submit" value="Search Website" class="search-text" />
                                        </form>
                                    </div>
                                    <table>
                                        <tr>
                                            <td><?php echo CHtml::link('Home', array('site/index')); ?></td>
                                            <?php if (!Yii::app()->user->isGuest) { ?>
                                                <td><?php echo CHtml::link('Events', array('events/index')); ?></td>
                                            <?php } ?>
                                            <td><?php echo CHtml::link('About', array('site/page', 'view' => 'about')); ?></td>
                                            <td><?php echo CHtml::link('Contact', array('site/contact')); ?></td>
                                            <td><?php echo CHtml::link('Find', array('site/preFind')); ?></td>
                                            <?php if (Yii::app()->user->isGuest) { ?>
                                                <td><?php echo CHtml::link('Get connected', array('site/login')); ?></td>
                                            <?php } else { ?>
                                                <td><?php echo CHtml::link('Logout(' . Yii::app()->user->name . ')', array('site/logout')); ?></td>
                                                <td><?php echo CHtml::link("(" . $this->getNotifCount() . ")", "#", array('id' => 'notifs-lnk')); ?></td>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                    <div id="notifications1">
                                        <div id="pointer">
                                        </div>
                                        <div id="notifs">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </center>
                </div>
            </div>
            <!--            <div>
                            <img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/headers/cloudlogo.png">
                        </div>-->
        </div><!-- header -->
        <br/>
        <br/>
        <br/>
        <div class="container" id="page">
            <div id="cloud-banner">
                <div id="search-txt">
                    <?php echo CHtml::link(Yii::app()->user->getUser('churchName'), array('church/view', 'id' => Yii::app()->user->getUser('churchId'))); ?>
                    <? //php echo SearchAction::renderInputBox(); ?>


                </div>
            </div>
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!--breadcrumbs-->
            <?php endif ?>

            <?php echo $content; ?>
            <?php
//            $this->widget('application.extensions.WebsiteSearch.WebsiteSearch', array(
//                'model' => array(
//                    'Church' => array(
//                        'church_name, tel_num, email, website, fb_account, twitter_account, youtube_account',
//                        'church_name, website',
//                        'church_id'
//                    ),
//                    'ChurchNeeds' => array(
//                        'need_title, need_desc',
//                        'need_title, need_desc',
//                        'need_id'
//                    ),
//                    'ChurchSupplies' => array(
//                        'supplies_title, supplies_desc',
//                        'supplies_title, supplies_desc',
//                        'supplies_id'
//                    ),
//                    'News' => array(
//                        'news_title, news_content',
//                        'news_title, news_content',
//                        'news_id'
//                    ),
//                ),
//            ));
            ?>

            <div class="clear">   </div>

            <div id="footer">
                <!-- 
                 Copyright &copy; <? //php echo date('Y');     ?> by My Company.<br/>
                 All Rights Reserved.<br/>
                <? //php echo Yii::powered();  ?>-->
                <div class="footer-blocks" id="subscribe" style="display: none">
                    <b>Subscribe to our updates:</b><br/>
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'church-needs-form',
                        'enableAjaxValidation' => false,
                            ));
                    ?>
                    <div id="search-txt"><?php echo CHtml::textField('search', 'Enter Email Address ', array('size' => 27, 'class' => 'main-text')); ?></div>
                    <?php $this->endWidget(); ?>
                    <br/>
                    <br/>
                </div>
                <div class="footer-blocks" id="links">
                    <div>
                        <ul>
                            <li><img class="share-links" src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/buttons/facebook.jpg"/></li>
                            <li><img class="share-links" src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/buttons/twitter.jpg"/></li>
                            <li><img class="share-links" src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/buttons/email.jpg"/></li>
                        </ul>
                    </div>
                    <div class="links-list">
                        <table>
                            <tr>
                                <td><b>About Cloud121</b></td>
                            </tr>
                            <tr>
                                <td>> Programs</td>
                            </tr>
                            <tr>
                                <td>> Impact</td>
                            </tr>
                            <tr>
                                <td>> Financials</td>
                            </tr>
                            <tr>
                                <td>> Governance</td>
                            </tr>
                            <tr>
                                <td>> Partners</td>
                            </tr>
                        </table>
                    </div>
                    <div class="links-list">
                        <table>
                            <tr>
                                <td><b>Quick Links</b></td>
                            </tr>
                            <tr>
                                <td>> Scriptures</td>
                            </tr>
                            <tr>
                                <td>> Annual Reports</td>
                            </tr>
                            <tr>
                                <td>> Contact Info</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div><!-- footer -->
        </div><!-- page -->
    </body>
</html>
