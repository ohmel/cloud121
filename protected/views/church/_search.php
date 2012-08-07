<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'church_id'); ?>
		<?php echo $form->textField($model,'church_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profile_id'); ?>
		<?php echo $form->textField($model,'profile_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'church_name'); ?>
		<?php echo $form->textField($model,'church_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address_id'); ?>
		<?php echo $form->textField($model,'address_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tel_num'); ?>
		<?php echo $form->textField($model,'tel_num',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fb_account'); ?>
		<?php echo $form->textField($model,'fb_account',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'twitter_account'); ?>
		<?php echo $form->textField($model,'twitter_account',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'youtube_account'); ?>
		<?php echo $form->textField($model,'youtube_account',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'latlng'); ?>
		<?php echo $form->textField($model,'latlng',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->