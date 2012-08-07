<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('church_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->church_id), array('view', 'id'=>$data->church_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profile_id')); ?>:</b>
	<?php echo CHtml::encode($data->profile_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('church_name')); ?>:</b>
	<?php echo CHtml::encode($data->church_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address_id')); ?>:</b>
	<?php echo CHtml::encode($data->address_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tel_num')); ?>:</b>
	<?php echo CHtml::encode($data->tel_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website')); ?>:</b>
	<?php echo CHtml::encode($data->website); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fb_account')); ?>:</b>
	<?php echo CHtml::encode($data->fb_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('twitter_account')); ?>:</b>
	<?php echo CHtml::encode($data->twitter_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('youtube_account')); ?>:</b>
	<?php echo CHtml::encode($data->youtube_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('latlng')); ?>:</b>
	<?php echo CHtml::encode($data->latlng); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	*/ ?>

</div>