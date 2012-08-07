<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/viewchurch.css" />
<?php
$this->breadcrumbs = array(
    'Churches' => array('index'),
    $arrData['church']['church_name'],
);
Yii::app()->clientScript->registerScript('view', "

");

//
//$this->menu=array(
//	array('label'=>'List Church', 'url'=>array('index')),
//	array('label'=>'Create Church', 'url'=>array('create')),
//	array('label'=>'Update Church', 'url'=>array('update', 'id'=>$model->church_id)),
//	array('label'=>'Delete Church', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->church_id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Church', 'url'=>array('admin')),
//);
?>
<script>
    $(document).ready(function(){
        //        alert("hello");
        $('#edit').click(function(){
            $('#ministriestable').hide();
            $('#churchinfo').hide();
            $('#editprofile').show();
        });
        $('#infobtn').click(function(){
            $('#editprofile').hide();
            $('#ministriestable').hide();
            $('#churchinfo').show();
         
           
           
        });
        $('#ministries').click(function(){
            $('#editprofile').hide();
            $('#churchinfo').hide();
            $('#ministriestable').show();
          
           
           
        });
        $('#contact').click(function(){
            $('#editprofile').hide();
            $('#churchinfo').show();
           
           
           
        });
    });
</script>
<style>
    .red{
        color: red;
    }
</style>
<div id="church-info">
    <div id="info-main">
        <div id="church-logo">
            <img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/headers/samplejpeg.jpg" height="100" width="100">
        </div>
        <div id="church-details">
            <span id="church_name"><?php echo $arrData['church']['church_name'] ?></span><br/>
            <span id="church_tagtitle"><?php echo $arrData['profile']['church_tagtitle'] ?></span><br/>
            <!--        <br/>-->
            <table>
                <tr>
                    <td>Joined Cloud121</td>
                    <td>Follow us on</td>
                </tr>
                <tr>
                    <td id="jdate"><?php echo date('Y-m-d') ?></td>
                    <td>
                        <img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/icons/facebook.png">
                        <img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/icons/twitter.png">
                        <img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/icons/youtube.png">
                    </td>
                </tr>
            </table>
        </div>  
    </div>

    <div id="ptabs">
        <span class="profile-tabs"><?php echo CHtml::link('Information', '#', array('class' => 'search-button', 'id' => 'infobtn')); ?></span>
        <span class="profile-tabs"><?php echo CHtml::link('Ministries', '#', array('class' => 'search-button', 'id' => 'ministries')); ?></span>

        <span class="profile-tabs"><?php echo CHtml::link('Edit', '#', array('class' => 'search-button', 'id' => 'edit')); ?></span>
    </div>
    <div id="tab-content">
        <table id="churchinfo">
            <tr>
                <td class="info-label">Address:</td>
                <td><?php echo $arrData['address']['address_det'] . " " . $arrData['address']['city'] . " " . $arrData['address']['country'] . " " . $arrData['address']['zip'] ?></td>
            </tr>
            <tr>
                <td class="info-label">Type:</td>
                <td>
                    <?php
                    switch ($arrData['church']['type']) {
                        case '1':
                            echo 'Church';
                            break;
                        case '2':
                            echo 'Mission';
                            break;
                        case '3':
                            echo 'Educational';
                            break;
                        case '4':
                            echo 'Medical';
                            break;
                        default:
                            echo '';
                            break;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="info-label">Contact Person:</td>
                <td><?php echo Yii::app()->user->getUser('fullname') ?></td>
            </tr>
            <tr>
                <td class="info-label">Email:</td>
                <td><?php echo $arrData['church']['email'] ?></td>
            </tr>
            <tr>
                <td class="info-label"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/icons/facebook.png"></td>
                <td><?php echo $arrData['church']['fb_account'] ?></td>
            </tr>
            <tr>
                <td class="info-label"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/icons/twitter.png"></td>
                <td><?php echo $arrData['church']['twitter_account'] ?></td>
            </tr>
            <tr>
                <td class="info-label"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/icons/youtube.png"></td>
                <td><?php echo $arrData['church']['youtube_account'] ?></td>
            </tr>
        </table>
        <div class="form" id="editprofile">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'editchurch',
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                ),
                    ));
            ?>
            <div id="error-summary">
                <b>
                    <?php echo $form->error($church, 'church_name'); ?>
                    <?php echo $form->error($church, 'tel_num'); ?>
                    <?php echo $form->error($church, 'email'); ?>
                    <?php echo $form->error($church, 'website'); ?>
                    <?php echo $form->error($church, 'fb_account'); ?>
                    <?php echo $form->error($church, 'twitter_account'); ?>
                    <?php echo $form->error($church, 'youtube_account'); ?>
                </b>
            </div>
            <div class="row">
                <?php echo $form->labelEx($church, 'church_name'); ?>
                <?php echo $form->textField($church, 'church_name', array('class' => 'main-text2')); ?>

            </div>
            <div class="row">
                <?php echo $form->labelEx($church, 'tel_num'); ?>
                <?php echo $form->textField($church, 'tel_num', array('class' => 'main-text2')); ?>

            </div>
            <div class="row">
                <?php echo $form->labelEx($church, 'email'); ?>
                <?php echo $form->textField($church, 'email', array('class' => 'main-text2')); ?>

            </div>
            <div class="row">
                <?php echo $form->labelEx($church, 'website'); ?>
                <?php echo $form->textField($church, 'website', array('class' => 'main-text2')); ?>

            </div>
            <div class="row">
                <?php echo $form->labelEx($church, 'fb_account'); ?>
                <?php echo $form->textField($church, 'fb_account', array('class' => 'main-text2')); ?>

            </div>
            <div class="row">
                <?php echo $form->labelEx($church, 'twitter_account'); ?>
                <?php echo $form->textField($church, 'twitter_account', array('class' => 'main-text2')); ?>

            </div>
            <div class="row">
                <?php echo $form->labelEx($church, 'youtube_account'); ?>
                <?php echo $form->textField($church, 'youtube_account', array('class' => 'main-text2')); ?>

            </div>
            <div class="row">
                <?php echo CHtml::submitButton('Update'); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>

        <table id="ministriestable">
            <?php for ($i = 0; $i < count($ministries); $i++) { ?>
                <tr>
                    <td><?php echo $ministries[$i]['ministry_title']; ?></td>

                </tr>
                <tr>
                    <td><?php echo $ministries[$i]['ministry_desc']; ?></td>

                </tr>
                <tr>
                    <td><hr/></td>
                </tr>
            <?php } ?>

        </table>
    </div>  
</div>

<div id="broadcast-section">
    <div id="broadcas-main">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'broadcast-form',
            'enableAjaxValidation' => false,
                ));
        ?>
        <?php echo $form->textArea($shoutout,'shoutout_content', array('cols'=>'48', 'rows'=>'5')); ?>
        <? //php echo $form->textArea($shoutout, 'need_desc', array('rows' => 5, 'cols' => 48));  ?>
        <br/>
        <br/>
        <div class="submit">
            <?php echo CHtml::submitButton('Broadcast'); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <div id="need-section">
        <div class="this-header">Your Latest Needs</div>
        <div class="this-button"><span class="span-btn"><b><?php echo CHtml::link('Post a Need', array('churchNeeds/create')); ?></b></span></div>
    </div>
    <?php for ($i = 0; $i < count($arrData['need']); $i++) { ?>
        <div class="need-list">
            <?php echo $arrData['need'][$i]['need_title'] ?>
        </div>
    <?php } ?>
    <br/>
    <div id="blessing-section">
        <div class="this-header">Your Latest Needs</div>
        <div class="this-button"><span class="span-btn"><b><?php echo CHtml::link('Post a Blessing', array('churchSupplies/create')); ?></b></span></div>
    </div>
    <?php for ($i = 0; $i < count($arrData['blessing']); $i++) { ?>
        <div class="blessing-list">
            <?php echo $arrData['blessing'][$i]['supplies_title'] ?>
        </div>
    <?php } ?>
</div>

    <!--<pre>
<? //php print_r($arrData)  ?>
    </pre>-->
