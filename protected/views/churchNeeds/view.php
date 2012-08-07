<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/match-needs.css" />
<?php
$this->breadcrumbs = array(
    'Church Needs' => array('index'),
    $model->need_id,
);

$this->menu = array(
    array('label' => 'List ChurchNeeds', 'url' => array('index')),
    array('label' => 'Create ChurchNeeds', 'url' => array('create')),
    array('label' => 'Update ChurchNeeds', 'url' => array('update', 'id' => $model->need_id)),
    array('label' => 'Delete ChurchNeeds', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->need_id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage ChurchNeeds', 'url' => array('admin')),
);
?>


<table>
    <tr>
        <td class="posted-blessings">Your Posted Needs<img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mappins/orangepin.png"></td>
        <td id="other-blessings">Other Blessings<img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mappins/greenpin.png"</td>
    </tr>
    <tr>
        <td class="need-info">
            <table>
                <tr class="need-headers">
                    <td rowspan="2" id="church_logo"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/headers/banner.png" height="100" width="100"></td>
                    <td>Need Title</td>
                    <td>Status</td>
                </tr>
                <tr>
                    <td id="need-title-desc">
                        <span  class="blue-color"><?php echo $model->attributes['need_title'];?></span><br>
                        <span class="dark-blue"><?php echo $model->attributes['need_desc'];?></span>
                    </td>
                    <td id="need-status">
                       <select class="blue-color">
                           <option>Updated</option>
                       </select>
                    </td>
                </tr>
            </table>
        </td>
        <td rowspan="3" id="other-blessings-content">
            <table>
              <?php
                 foreach($supplies_other as $supplies_value)
                 {
              ?>  
                <tr>
                    <td style="width:60px"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/headers/samplesmaller.jpg" height="50" width="50"></td>
                    <td>
                        <span class="blue-color"><?php echo $supplies_value->attributes['supplies_title'];?></span><br/>
                        <span class="dark-blue"><?php echo $supplies_value->supplies_desc;?></span> 
                        
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2" style="text-align:right;"><span class="span-btn2"><b><?php echo CHtml::link('Respond',array('churchSupplies/respond', 'id' => $supplies_value->supplies_id)); ?></b></span></td>
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
      <td class="posted-blessings">Related Blessings<img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mappins/greenpin.png"></td>
      
    </tr>
    <tr>
        <td class="blessing-info">
            <table>
                
               <?php
                    for($i=0; $i<count($resource_rel); $i++)
                    {
                  ?>  
                <tr>
                    <td id="church_logo"><img class="middle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/headers/samplejpeg.jpg" height="100" width="100"></td>
                    <td style="max-width: 400px; padding: 10px">
                        <span  class="blue-color"><?php echo $resource_rel[$i]['supplies_title'];?></span><br/>
                        <span class="dark-blue"><?php echo $resource_rel[$i]['supplies_desc']."kjsdfkjsadfhkjsh fksdhfksj hfksjfhksf hkjshfks dhfksaj hfksjhkdjfh skddfkljs dklfjsd kfjsdk fjs  dklfjsdk lfjd sklfjk";?></span>
                    </td>
                    <td><span class="span-btn"><b><?php echo CHtml::link('Respond',array('churchSupplies/respond', 'id' => $resource_rel[$i]['supplies_id'])); ?></b></span></td>
                            
                </tr>
              <?php
                    }
              ?>
                </table>
        </td>
    </tr>
  
</table>
