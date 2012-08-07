<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'events-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true),
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'event_name'); ?>
        <?php echo $form->textField($model, 'event_name', array('width' => 40, 'maxlength' => 100, 'class' => 'main-text2')); ?>
        <?php echo $form->error($model, 'event_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'event_desc'); ?>
        <?php echo $form->textArea($model, 'event_desc', array('rows' => 6, 'cols' => 50, 'width' => 100, 'class' => 'main-textarea')); ?>
        <?php echo $form->error($model, 'event_desc'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_from'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Events[date_from]',
            'model' => $model,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
                'class' => 'main-text2',
                'id' => 'Events_date_from',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date_from'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_to'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Events[date_to]',
            'model' => $model,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
                'class' => 'main-text2',
                'id' => 'Events_date_to',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date_to'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'event_type'); ?>
        <?php echo $form->dropDownList($model, 'event_type', array('1' => 'Conventions', '2' => 'Seminars', '3' => 'Trainings', '4' => 'Celebration'), array('width' => 40, 'class' => 'main-text2')); ?>
        <?php echo $form->error($model, 'event_type'); ?>
    </div>

    <div class="row">
        <?php echo $form->hiddenField($model, 'latlng', array('size' => 60, 'maxlength' => 100, 'id'=>'latlng')); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->