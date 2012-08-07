<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'need_id'); ?>
		<?php echo $form->textField($model,'need_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'church_id'); ?>
		<?php echo $form->textField($model,'church_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'need_title'); ?>
		<?php echo $form->textField($model,'need_title',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'need_desc'); ?>
		<?php echo $form->textArea($model,'need_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category'); ?>
		<?php echo $form->textField($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'need_date'); ?>
		<?php echo $form->textField($model,'need_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'need_status'); ?>
		<?php echo $form->textField($model,'need_status'); ?>
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