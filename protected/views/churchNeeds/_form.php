<script>
    $(document).ready(function(){
        $('#createbtn').attr('disabled', 'disabled');
        var refreshId = setInterval(function(){
            if($('#need_title').val() == "" || $('#need_desc').val() == "" || $('#cat').val() == ""){
                $('#createbtn').attr('disabled', 'disabled');
            }else{
                $('#createbtn').removeAttr('disabled');
            } 
        },1000);
        
        $('#categories').click(function(){
            $('#cat-box').toggle();
        });
        $('.chk').click(function(){
            var arrData2 = Array();
            if($(this).attr('checked')){
                if($('#cat').val() == ''){
                    $('#cat').val($(this).val());
                }else{
                    $('#cat').val($('#cat').val()+'-'+$(this).val());
                }
            }else{
                var arrData = explode('-',$('#cat').val());
                $('#cat').val('');
                var a = 0;
                for(i=0;i<arrData.length;i++){
                    if(arrData[i] != $(this).val()){
                        arrData2[a] = arrData[i];
                        a++;
                    }
                }
                var output = implode('-',arrData2);
                $('#cat').val(output);
            }
            
        });
    });
</script>
<div class="form">

    <?php $arrData = array('124', '765') ?>
    <div class="row">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'needs-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true),
                ));
        ?>
        <?php echo $form->labelEx($church, 'need_title'); ?>
        <?php echo $form->textField($church, 'need_title', array('size' => 40, 'class' => 'main-text2 needtxt')); ?>
        <?php echo $form->error($church, 'need_title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($church, 'need_desc'); ?>
        <?php echo $form->textArea($church, 'need_desc', array('rows' => 6, 'cols' => 100, 'class' => 'main-textarea  needtxt')); ?>
        <?php echo $form->error($church, 'need_desc'); ?>
    </div>

    <div class="row">
        <?php echo $form->hiddenField($church, 'category', array('id' => 'cat', 'class' => 'needtxt')); ?>
        <?php echo $form->error($church, 'category'); ?>
        <?php echo CHtml::link('Categories', 'javascript:void(0)', array('id' => 'categories')); ?><span style="color: red">*</span> <i>(Check boxes to pick your need category)</i>
        <?php echo $form->error($church, 'category'); ?>
    </div>
    <div id="cat-box">
        <?php for ($i = 0; $i < count($resource); $i++) { ?>     
            <input type="checkbox" class="chk" value="<?php echo $resource[$i]['attributes']['resource_id'] ?>" name="rsrc[]"> <?php echo $resource[$i]['attributes']['resource_name'] ?><br/>
        <?php } ?>     
    </div>
    <div class="row">
        <? //php echo $form->labelEx($church,'latlng');  ?>
        <?php echo $form->hiddenField($church, 'latlng', array('id' => 'latlng', 'class' => 'needtxt', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($church, 'latlng'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Create', array('id' => 'createbtn')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->