<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'church-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'profile_id'); ?>
		<?php echo $form->textField($model,'profile_id'); ?>
		<?php echo $form->error($model,'profile_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'church_name'); ?>
		<?php echo $form->textField($model,'church_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'church_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_id'); ?>
		<?php echo $form->textField($model,'address_id'); ?>
		<?php echo $form->error($model,'address_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tel_num'); ?>
		<?php echo $form->textField($model,'tel_num',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'tel_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fb_account'); ?>
		<?php echo $form->textField($model,'fb_account',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fb_account'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'twitter_account'); ?>
		<?php echo $form->textField($model,'twitter_account',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'twitter_account'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'youtube_account'); ?>
		<?php echo $form->textField($model,'youtube_account',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'youtube_account'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'latlng'); ?>
		<?php echo $form->textField($model,'latlng',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'latlng'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type'); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->