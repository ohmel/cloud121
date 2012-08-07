<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/match-supplies.css" />
<?php
$this->breadcrumbs=array(
	'Church Supplies'=>array('index'),
	$model->supplies_id,
);

$this->menu=array(
	array('label'=>'List ChurchSupplies', 'url'=>array('index')),
	array('label'=>'Create ChurchSupplies', 'url'=>array('create')),
	array('label'=>'Update ChurchSupplies', 'url'=>array('update', 'id'=>$model->supplies_id)),
	array('label'=>'Delete ChurchSupplies', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->supplies_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ChurchSupplies', 'url'=>array('admin')),
);
?>

<table>
    <tr>
        <td class="posted-needs">Your Posted Blessings<img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mappins/greenpin.png"></td>
        <td id="other-needs">Other Needs<img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mappins/orangepin.png"</td>
    </tr>
    <tr>
        <td class="supplies-info">
            <table>
                <tr class="supplies-headers">
                    <td rowspan="2" id="church_logo"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/headers/samplejpeg.jpg" height="100" width="100"></td>
                    <td>Blessing Title</td>
                    <td>Status</td>
                </tr>
                <tr>
                    <td id="supplies-title-desc">
                        <span  class="blue-color"><?php echo $model->attributes['supplies_title'];?></span><br>
                        <span class="dark-blue"><?php echo $model->attributes['supplies_desc'];?></span>
                    </td>
                    <td id="supplies-status">
                       <select class="blue-color">
                           <option>Updated</option>
                       </select>
                    </td>
                </tr>
            </table>
        </td>
        <td rowspan="3" id="other-needs-content">
            <table>
              <?php
                 foreach($needs_other as $needs_value)
                 {
              ?>  
                <tr>
                    <td style="width:60px"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/headers/samplejpeg.jpg" height="50" width="50"></td>
                    <td>
                        <span class="blue-color"><?php echo $needs_value->attributes['need_title'];?></span><br/>
                        <span class="dark-blue"><?php echo $needs_value->need_desc;?></span> 
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2" style="text-align:right;"><span class="span-btn2"><b><?php echo CHtml::link('Respond',array('churchNeeds/respond', 'id' => $needs_value->need_id)); ?></b></span></td>
                </tr>
                <tr>
                    <td colspan="2"><br/><hr/></td>
                </tr>
             <?php
               }
             ?>
            </table>
            
        </td>
    </tr>
    <tr>
      <td class="posted-needs">Related Needs<img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mappins/orangepin.png"></td>
      
    </tr>
    <tr>
        <td class="need-info">
            <table>
                
               <?php
                    for($i=0; $i<count($resource_rel); $i++)
                    {
                  ?>  
                <tr>
                    <td id="church_logo"><img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/headers/samplejpeg.jpg" height="100" width="100"></td>
                    <td style="max-width: 400px; padding: 10px">
                        <span  class="blue-color"><?php echo $resource_rel[$i]['need_title'];?></span><br/>
                        <span class="dark-blue"><?php echo $resource_rel[$i]['need_desc'];?></span>
                    </td>
                    <td><span class="span-btn"><b>Respond</b></span></td>
                            
                </tr>
              <?php
                    }
              ?>
                </table>
        </td>
    </tr>
  
</table>