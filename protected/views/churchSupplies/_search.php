<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'supplies_id'); ?>
		<?php echo $form->textField($model,'supplies_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'church_id'); ?>
		<?php echo $form->textField($model,'church_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'supplies_title'); ?>
		<?php echo $form->textField($model,'supplies_title',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'supplies_desc'); ?>
		<?php echo $form->textArea($model,'supplies_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'supplies_date'); ?>
		<?php echo $form->textField($model,'supplies_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'supplies_status'); ?>
		<?php echo $form->textField($model,'supplies_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'latlng'); ?>
		<?php echo $form->textField($model,'latlng',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->