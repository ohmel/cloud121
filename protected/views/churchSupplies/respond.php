<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/respond.css" />
<?php
$this->breadcrumbs = array(
    'Church Supplies' => array('index'),
    $church_supplies->supplies_title,
);
?>
<table>
    <tr>
        <td class="posted-response">Posted Blessings<img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mappins/orangepin.png"></td>
        <td id="other-response">Interact<img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mappins/greenpin.png"/></td>
    </tr>
    <tr>
        <td class="response-info">
            <table style="width: 100%;">
                <tr>
                    <td id="supplies-title-desc">
                        <span class="dark-blue malaki"><?php echo $church_supplies->church->church_name; ?></span><br/>
                        <span class="dark-blue ">&nbsp;<b>Contact no:</b> <?php echo $church_supplies->church->tel_num; ?></span><br/>
                        <span class="dark-blue ">&nbsp;<b>Email-ad:</b> <?php echo $church_supplies->church->email; ?></span><br/><br/>
                        <span  class="blue-color malaki"><?php echo $church_supplies->supplies_title; ?></span><br>
                        <span class="dark-blue"><?php echo $church_supplies->supplies_desc; ?></span>
                    </td>
                    <td id="supplies-status" style="vertical-align: top">
                        <select class="blue-color">
                            <option>Updated</option>
                        </select>
                    </td>
                </tr>
            </table>
        </td>
        <td id="interact" rowspan="5">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'suppliess-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true),
                    ));
            ?>
            <div class="row">
                <?php echo $form->textArea($comment, 'comment_content', array('rows' => 4, 'cols' => 100, 'class' => 'main-textarea  suppliestxt')); ?>
            </div>
            <div class="row buttons">
                <?php echo CHtml::submitButton('Post', array('id' => 'createbtn')); ?>
            </div>
            <?php $this->endWidget(); ?><br/>
            <span class="comment-span">Comments</span>
            <hr/>
            <div id="comments">
                <?php foreach ($comments as $value) { ?>
                    <?php echo $value->comment_content; ?><br/>
                    <div id="church_detail">
                        <?php echo $value->church->church_name; ?><br/>
                        <?php echo $value->church->tel_num; ?><br/>
                        <?php echo $value->church->website; ?><br/>
                    </div>
                <?php } ?> 
            </div>

        </td>
    </tr>
    <tr>
        <td class="posted-response">Related Supplies<img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mappins/greenpin.png"></td>
    </tr>
    <tr>
        <td rowspan="3" id="other-blessings-content">
            <table>
                <?php  foreach ($supplies_rel as $supplies_value) {?>  
                <tr>
                    <td style="width:60px"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/logo.png" height="50" width="50"></td>
                    <td>
                        <span class="blue-color"><?php echo $suppliess_value['supplies_title']; ?></span><br/>
                        <span class="dark-blue"><?php echo $suppliess_value['supplies_desc']; ?></span> 
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2" style="text-align:right;"><span class="span-btn2"><b> <?php echo CHtml::link('Respond', array('churchSupplies/respond','id'=>$supplies_value['supplies_id'])); ?></b></span></td>
                </tr>
                <tr>
                    <td colspan="2"><br/><hr/></td>
                </tr>
                <?php  }?>
            </table>

        </td>
    </tr>
</tr>
</table>