<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'event_id'); ?>
		<?php echo $form->textField($model,'event_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_name'); ?>
		<?php echo $form->textField($model,'event_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_desc'); ?>
		<?php echo $form->textArea($model,'event_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'church_id'); ?>
		<?php echo $form->textField($model,'church_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_from'); ?>
		<?php echo $form->textField($model,'date_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_to'); ?>
		<?php echo $form->textField($model,'date_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_type'); ?>
		<?php echo $form->textField($model,'event_type'); ?>
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