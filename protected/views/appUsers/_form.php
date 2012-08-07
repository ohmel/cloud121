<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'app-users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ud_id'); ?>
		<?php echo $form->textField($model,'ud_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ud_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'church_id'); ?>
		<?php echo $form->textField($model,'church_id'); ?>
		<?php echo $form->error($model,'church_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_fullname'); ?>
		<?php echo $form->textField($model,'user_fullname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_fullname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_password'); ?>
		<?php echo $form->textField($model,'user_password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'user_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_type'); ?>
		<?php echo $form->textField($model,'user_type',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'user_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_status'); ?>
		<?php echo $form->textField($model,'user_status'); ?>
		<?php echo $form->error($model,'user_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->