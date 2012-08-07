<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/findaffiliates.css" />
<?php
$this->breadcrumbs=array(
	'Find Affiliates',
);
?>

<?php foreach($church as $value){?>
    <div class="church_details">
        <div><img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/headers/samplesmaller.jpg"/></div>
        <div><a href=""><b><?php echo CHtml::link($value->church_name, array('church/view', 'id'=>$value->church_id)); ?></b></a></div>
        <div><?php echo $value->address->address_det." ".$value->address->province." ".$value->address->city." ".$value->address->country." ".$value->address->zip?></div>
        <div><b>Contact Person:</b> <?php echo $value->user->user_fullname?></div>
        <div><b>Contact Numbers:</b> <?php echo $value->tel_num?></div>
        <div><b>Email:</b> <?php echo $value->email?></div>
        <br/>
        <div><b>For more info visit us at</b></div>
        <a href="<?php echo $value->fb_account?>"><img class="middle social" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/facebook.png"/></a>
        <a href="<?php echo $value->twitter_account?>"><img class="middle social" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/twitter.png"/></a>
        <a href="<?php echo $value->youtube_account?>"><img class="middle social" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/youtube.png"/></a>
        <div><a href="<?php echo $value->website?>"><?php echo $value->website?></a></div>
        <br/>
        <?php// echo $value->aff->attributes['affig']?>
        <?php if($value->aff->church_id != Yii::app()->user->getUser('churchId')){?>
        <div class="span-btn" style="width: 125px"><b><?php echo CHtml::link('Affiliate this Church', array('church/affiliate', 'id'=>$value->church_id)); ?></b></div>
        <?php }?>
    </div>
<?php }?>
