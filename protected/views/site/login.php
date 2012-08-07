<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" />
<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>
<script>
    
    $(document).ready(function(){
        $('#connectbtn').attr('disabled', 'disabled');
        $('#pwd2').blur(function(){
            if(($('#pwd').val() != $('#pwd2').val())||($('#pwd').val() == "" || $('#pwd2').val() == "")){
                $('#pwd').css('border', '1px solid red');
                $('#pwd2').css('border', '1px solid red');
                $('#connectbtn').attr('disabled', 'disabled');
            }else{
                $('#pwd').css('border', '1px solid #E0E1E3');
                $('#pwd2').css('border', '1px solid #E0E1E3');
                $('#connectbtn').removeAttr('disabled');
            } 
        });
        $('#pwd').blur(function(){
            if($('#pwd').val() == "" || $('#pwd2').val() == ""){
                $('#pwd').css('border', '1px solid red');
                $('#pwd2').css('border', '1px solid red');
                $('#connectbtn').attr('disabled', 'disabled');
            }else{
                $('#pwd').css('border', '1px solid #E0E1E3');
                $('#pwd2').css('border', '1px solid #E0E1E3');
                $('#connectbtn').removeAttr('disabled');
            }
        });
    });
</script>
<div id="get-connected">
    <div id="form-box">

        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'getconnected-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true),
                    ));
            ?>
            <fieldset>
                <legend>Get Connected - Register your Church/Organization</legend>
                <div id="error-summary">
                    <?php echo $form->error($user, 'user_name'); ?>
                    <?php echo $form->error($church, 'church_name'); ?>
                </div>
                <div class="form-elements">
                    User Name <span style="color: red;">*</span><br/>
                    <?php echo $form->textField($user, 'user_name', array('size' => 40, 'class' => 'main-text2')); ?>

                </div>
                <div class="form-elements" style="display: inline-block">
                    Password <span style="color: red;">*</span><br/>
                    <?php echo $form->passwordField($user, 'user_password', array('size' => 40, 'class' => 'main-text2', 'id' => 'pwd')); ?>
                </div>
                <div class="form-elements" style="display: inline-block">
                    Re-type Password <span style="color: red;">*</span><br/>
                    <?php echo CHtml::passwordField('user_retype', '', array('size' => 40, 'class' => 'main-text2', 'id' => 'pwd2')); ?>
                </div>
                <div class="form-elements" style="display: inline-block">
                    Church Name <span style="color: red;">*</span><br/>
                    <?php echo $form->textField($church, 'church_name', array('size' => 40, 'class' => 'main-text2')); ?>

                </div>
                <div class="form-elements" style="display: inline-block">
                    Type <span style="color: red;">*</span><br/>
                    <?php echo $form->dropDownList($church, 'type', array('1' => Church, '2' => 'Mission', '3' => 'Educational', '4' => 'Medical'), array('width' => 40, 'class' => 'main-text2')); ?>
    <!--                <select name="type" class="main-text2">
                        <option value="1">Church</option>
                        <option value="2">Mission</option>
                        <option value="3">Educational</option>
                        <option value="4">Medical</option>
                    </select>-->
                </div>
            </fieldset>

            <fieldset>
                <legend>Address Details</legend>
                <div id="error-summary">
                    <?php echo $form->error($address, 'address_det'); ?>
                    <?php echo $form->error($address, 'city'); ?>
                    <?php echo $form->error($address, 'province'); ?>
                    <?php echo $form->error($address, 'country'); ?>
                    <?php echo $form->error($address, 'zip'); ?>
                </div>
                <div class="form-elements" style="display: inline-block">
                    Bldg/Unit, Street, Brangay <span style="color: red;">*</span><br/>
                    <?php echo $form->textField($address, 'address_det', array('size' => 40, 'class' => 'main-text2')); ?>
                    
                </div>
                <div class="form-elements" style="display: inline-block">
                    City <span style="color: red;">*</span><br/>
                    <?php echo $form->textField($address, 'city', array('size' => 40, 'class' => 'main-text2')); ?>
                    
                </div>
                <div class="form-elements" style="display: inline-block">
                    Province <span style="color: red;">*</span><br/>
                    <?php echo $form->textField($address, 'province', array('size' => 40, 'class' => 'main-text2')); ?>
                    
                </div>
                <div class="form-elements" style="display: inline-block">
                    Country <span style="color: red;">*</span><br/>
                    <?php echo $form->textField($address, 'country', array('size' => 40, 'class' => 'main-text2')); ?>
                    
                </div>
                <div class="form-elements" style="display: inline-block">
                    Zip <span style="color: red;">*</span><br/>
                    <?php echo $form->textField($address, 'zip', array('size' => 40, 'class' => 'main-text2')); ?>
                    
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Contact Details</legend>
                <div id="error-summary">
                    <?php echo $form->error($user, 'user_fullname'); ?>
                    <?php echo $form->error($church, 'tel_num'); ?>
                    <?php echo $form->error($church, 'email'); ?>  
                    <?php echo $form->error($address, 'zip'); ?>
                </div>
                <div class="form-elements" style="display: inline-block">
                    Contact Person: <span style="color: red;">*</span><br/>
                    <?php echo $form->textField($user, 'user_fullname', array('size' => 40, 'class' => 'main-text2')); ?>
                </div>
                <div class="form-elements" style="display: inline-block">
                    Telephone / Mobile No. <span style="color: red;">*</span><br/>
                    <?php echo $form->textField($church, 'tel_num', array('size' => 40, 'class' => 'main-text2')); ?>
                </div>
                <div class="form-elements" style="display: inline-block">
                    Email <span style="color: red;">*</span><br/>
                    <?php echo $form->textField($church, 'email', array('size' => 40, 'class' => 'main-text2')); ?>
                </div>
                <div class="form-elements" style="display: inline-block">
                    Website<br/>
                    <?php echo $form->textField($church, 'website', array('size' => 40, 'class' => 'main-text2')); ?>
                </div>
            </fieldset>

            <fieldset>
                <legend>Social Networks</legend>
                <div class="form-elements">
                    Facebook<br/>
                    <?php echo $form->textField($church, 'fb_account', array('size' => 40, 'class' => 'main-text2')); ?>
                </div>
                <div class="form-elements">
                    Twitter<br/>
                    <?php echo $form->textField($church, 'twitter_account', array('size' => 40, 'class' => 'main-text2')); ?>
                </div>
                <div class="form-elements">
                    Youtube<br/>
                    <?php echo $form->textField($church, 'youtube_account', array('size' => 40, 'class' => 'main-text2')); ?>
                </div>
            </fieldset>
            <div class="form-elements">
                <?php echo CHtml::submitButton('Connect Now', array('id' => 'connectbtn')); ?>
            </div>




            <?php $this->endWidget(); ?>
        </div>
    </div>

</div>

<div class="form">
    <br/>
    <br/>
    <div id="login-header">
        <center>Already Connected?</center>
    </div>
    <?php
    $form2 = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
            ));
    ?>

    <div class="row">
        <?php echo $form2->labelEx($model, 'username'); ?>
        <?php echo $form2->textField($model, 'username', array('class' => 'main-text2')); ?>
        <?php echo $form2->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form2->labelEx($model, 'password'); ?>
        <?php echo $form2->passwordField($model, 'password', array('class' => 'main-text2')); ?>
        <?php echo $form2->error($model, 'password'); ?>
    </div>

    <div class="row rememberMe">
        <?php echo $form2->checkBox($model, 'rememberMe'); ?>
        <?php echo $form2->label($model, 'rememberMe'); ?>
        <?php echo $form2->error($model, 'rememberMe'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>

    <?php $this->endWidget(); ?>
    <hr/>
    <div id="under-login">
        <center>
            <span id="indiv-head">Are you an Individual?</span><br/>
            <span id="indiv-desc">
                Cloud121 wants you to know about <br/>Him and his Kingdom
            </span>
            <br/>
            <br/>
            <span class="span-btn">
                <b>Click here!</b>
            </span>
        </center>
    </div>
</div><!-- form -->
