<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/home.css" />
<?php
Yii::app()->clientScript->registerScript('index', "");

//
// ext is your protected.extensions folder
// gmaps means the subfolder name under your protected.extensions folder
//  
Yii::import('ext.EGmap.*');

$gMap = new EGMap();
$gMap->zoom = 5;
$gMap->setWidth(636);
$gMap->setHeight(343);
$mapTypeControlOptions = array(
    'position' => EGMapControlPosition::LEFT_BOTTOM,
    'style' => EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
);

$gMap->mapTypeControlOptions = $mapTypeControlOptions;

$gMap->setCenter(13.368243250897299, 121.88232421875);

// Create GMapInfoWindows

$info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');

for ($i = 0; $i < count($news); $i++) {
    $type = $news[$i]['news_type'];
    switch ($type) {
        case '1':
            $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/blue.png");
            $info_window_a = new EGMapInfoWindow("
                <div>
                    <center>
                        <a href='index.php?r=church/view&id=".$news[$i]['church_id']."'>".$news[$i]['church']['church_name']."</a>
                        <br/>
                        ".$news[$i]['church']['website']."
                        <br/>
                        ".$news[$i]['church']['tel_num']."
                        <br/>
                        ".$news[$i]['church']['fb_account']."
                        <br/>
                        ".$news[$i]['church']['twitter_account']."
                        <br/>
                        ".$news[$i]['church']['youtube_account']."
                    </center>
                </div>
                ");
            break;
        case '2':
            $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/orange.png");
            $info_window_a = new EGMapInfoWindow("
                <div>
                    <center>
                        <a href='index.php?r=church/view&id=".$news[$i]['church_id']."'>".$news[$i]['church']['church_name']."</a>
                        <br/>
                        ".$news[$i]['news_title']."
                        <br/>
                        ".$news[$i]['news_content']."
                    </center>
                </div>
                ");
            break;
        case '3':
            $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/green.png");
            $info_window_a = new EGMapInfoWindow("
                <div>
                    <center>
                        <a href='index.php?r=church/view&id=".$news[$i]['church_id']."'>".$news[$i]['church']['church_name']."</a>
                        <br/>
                        ".$news[$i]['news_title']."
                        <br/>
                        ".$news[$i]['news_content']."
                    </center>
                </div>
                ");
            break;
        case '4':
            $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/violet.png");
            $info_window_a = new EGMapInfoWindow("
                <div>
                    <center>
                        <a href='index.php?r=church/view&id=".$news[$i]['church_id']."'>".$news[$i]['church']['church_name']."</a>
                        <br/>
                        ".$news[$i]['news_title']."
                        <br/>
                        ".$news[$i]['news_content']."
                    </center>
                </div>
            ");
            break;
        default:
            $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/yellow.png");
            $info_window_a = new EGMapInfoWindow("<div>
                <a href='index.php?r=church/view&id=".$news[$i]['church_id']."'>View Church</a>
                </div>");
            break;
    }
    if ($news[$i]['latlng2'] == "") {
        $arrLatlng = explode(",", $news[$i]['latlng']);
    } else {
        $arrLatlng = explode(",", $news[$i]['latlng2']);
    }


    $icon->setSize(25, 26);
    $icon->setAnchor(16, 16.5);
    $icon->setOrigin(0, 0);

    // Create marker
    $marker = new EGMapMarker($arrLatlng[0], $arrLatlng[1], array('icon' => $icon));
    $marker->addHtmlInfoWindow($info_window_a);
    $gMap->addMarker($marker);
}
// SECOND WAY:Ohmel Comment
//$marker->labelContent= '$425K';
//$marker->labelStyle=$label_options;
//$marker->draggable=true;
//$marker->labelClass='labels';
//$marker->raiseOnDrag= true;
// 
//$marker->setLabelAnchor(new EGMapPoint(22,0));
// 
//$marker->addHtmlInfoWindow($info_window_b);
// 
//$gMap->addMarker($marker);
// enabling marker clusterer just for fun
// to view it zoom-out the map
if($_GET['switch'] == 'on' && $_GET['switch'] != NULL)
{
   $gMap->enableMarkerClusterer(new EGMapMarkerClusterer());
}
?>
<script>
    $(document).ready(function(){
        $('#unify-hover').hover(function(){
            $('#tbl-edify').hide(); 
            $('#tbl-glorify').hide();
            $('#tbl-unify').show(); 
        });
        $('#edify-hover').hover(function(){
            $('#tbl-unify').hide(); 
            $('#tbl-glorify').hide();
            $('#tbl-edify').show(); 
        });
        $('#glorify-hover').hover(function(){
            $('#tbl-unify').hide(); 
            $('#tbl-edify').hide(); 
            $('#tbl-glorify').show(); 
        });
        var i = 1;
        var refreshId = setInterval(function(){
            if(i == 1){
                $('#tbl-edify').hide(); 
                $('#tbl-glorify').hide();
                $('#tbl-unify').fadeIn(); 
            }
            if(i == 2){
                $('#tbl-unify').hide(); 
                $('#tbl-glorify').hide();
                $('#tbl-edify').fadeIn(); 
            }
            if(i == 3){
                $('#tbl-unify').hide(); 
                $('#tbl-edify').hide(); 
                $('#tbl-glorify').fadeIn();
            }
            i++;
            if(i > 3){
                i = 1;
            }
        }, 5000);
    });
</script>
<?php if (!Yii::app()->user->isGuest) { ?>
    <div id="main-div" class="div-horizontal">
        <?php
        $gMap->renderMap();
        ?>
        <?php if($_GET['switch']){?>
            <?php echo CHtml::link('Turn off map pin clustering', array('site/index')); ?>
        <?php }else{?>
            <?php echo CHtml::link('Turn on map pin clustering', array('site/index', 'switch'=> 'on')); ?>
        <?php }?>
        
    </div>
    
    <div id="side-div" class="div-horizontal">
        <div style="text-align: left; height: auto">
            <div class="span-btn tab-btn"><b>&nbsp;&nbsp;<?php echo CHtml::link('Unify', array('site/index', 'type' => 1)); ?>&nbsp;&nbsp;</b></div>
            <div class="span-btn tab-btn"><b>&nbsp;&nbsp;<?php echo CHtml::link('Edify', array('site/index', 'type' => 2, 'type2' => 3)); ?>&nbsp;&nbsp;</b></div>
            <div class="span-btn tab-btn"><b>&nbsp;<?php echo CHtml::link('Glorify', array('site/index', 'type' => 4)); ?>&nbsp;</b></div>
            <br/>
            <br/>
            <div id="recent-updates">
                <?php for ($i = 0; $i < count($news); $i++) { ?>
                    <?php
                    $type = $news[$i]['news_type'];
                    switch ($type) {
                        case '1':
                            $image = "connection";
                            break;
                        case '2':
                            $image = "needicon";
                            break;
                        case '3':
                            $image = "blessicon";
                            break;
                        case '4':
                            $image = "matchicon";
                            break;
                        case '5':
                            $image = "eventicon";
                            break;
                        default:
                            $image = "affilicon";
                            break;
                    }
                    ?>
                    <div class="updates">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/<?php echo $image ?>.png">
                    </div>
                    <div class="updates">
                        <?php echo $news[$i]['news_title'] ?><br/>
                        <?php echo substr($news[$i]['news_content'], 0, 34) ?><a href="">...</a>
                    </div>
                    <hr/>
                <?php } ?>
            </div>
        </div>

        <div id="see-more-updates">
            <a href="">see more updates</a>
        </div>
    </div>
    <div id="legends">
        <table>
            <tr>
                <td><b>LEGEND:</b></td>
                <td><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/mappins/bluepin.png"/></td>
                <td>Connections </td>
                <td><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/mappins/orangepin.png"/></td>
                <td>Posted Needs </td>
                <td><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/mappins/greenpin.png"/></td>
                <td>Posted Blessings </td>
                <td><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/mappins/violetpin.png"/></td>
                <td>Matches </td>
                <td><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/mappins/yellowpin.png"/></td>
                <td>Good News </td>
            </tr>
        </table>
    </div>
<?php } else { ?>
    <div id="main-div" class="div-horizontal splash-1">
        <table id="tbl-unify">
            <tr>
                <td class="splash-content-label"><?php echo CHtml::link('Get Connected', array('site/login')); ?></td>
            </tr>
            <tr>
                <td class="splash-content">At Cloud121, you can find more ways to spread the word and bring light to others.</td>
            </tr>
            <tr>
                <td class="splash-content" style="text-align: center"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/splash/getconad.png"></td>
            </tr>
            <tr>
                <td class="splash-content">
                    <div class="hiw-unify">
                        Register your Church/Organization
                    </div>
                    <div class="hiw-unify">
                        Be Validated by Our Team
                    </div>
                    <div class="hiw-unify">
                        Join Our Growing Community!
                    </div>
                </td>
            </tr>
            <tr>
                <td class="splash-content-link"><span class="span-btn"><b><?php echo CHtml::link('SIGN UP NOW', array('site/login')); ?></b></span></td>
            </tr>
        </table>
        <table id="tbl-edify">
            
            <tr>
                <td class="splash-content-label"><?php echo CHtml::link('Build, Equip, and Restore', array('site/login')); ?></td>
            </tr>
            <tr>
                <td class="splash-content">Help with other organizations and help each other on Edifying the Bride. </td>
            </tr>
            <tr>
                <td class="splash-content" style="text-align: center"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/splash/edifyad.png"></td>
            </tr>
            <tr>
                <td class="splash-content">
                    <div class="hiw-edify">
                        Post your Needs or Blessings.
                    </div>
                    <div class="hiw-edify">
                        Use Matchmaking to find what you need.
                    </div>
                    <div class="hiw-edify">
                        Collaborate with Others.
                    </div>
                </td>
            </tr>
<!--            <tr>
                <td class="splash-content-link"><b><?php// echo CHtml::link('Let your Needs be known', array('site/needHiw')); ?></b>  <b><?php echo CHtml::link('Share your Blessings to others', array('site/needHiw')); ?></b></td>
            </tr>-->
        </table>
        <table id="tbl-glorify">
            
            <tr>
                <td class="splash-content-label"><?php echo CHtml::link('Share your Story', array('site/login')); ?></td>
            </tr>
            <tr>
                <td class="splash-content">Spread the word, speak and share to the world what God has done to your life.  </td>
            </tr>
            <tr>
                <td class="splash-content" style="text-align: center"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/splash/glorifyad.png"></td>
            </tr>
            <tr>
                <td class="splash-content">
                    <div class="hiw-glorify">
                        Let the World know what's in your heart
                    </div>
                    <div class="hiw-glorify">
                        Share your God's experience
                    </div>
                    <div class="hiw-glorify">
                        Let us hear you <br/>Story
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="side-div" class="div-horizontal splash-2">
        <br/>
        <br/>
        <div id="unify-hover" class="splash-hover">
            <span class="middle">UNIFY</span>
        </div>
        <div id="edify-hover" class="splash-hover">
            <span class="middle">EDIFY</span>
        </div>
        <div id="glorify-hover" class="splash-hover">
            <span class="middle">GLORIFY</span>
        </div>
    </div>
    <div>
        <div class="why-join-us-label">Why Join Us?</div>
        <br/>
<!--        <div>
            <img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/splash/welcome.png" height="264" width="940"/>
        </div>-->
    </div>
    <div>
        <table id="why-join-us-tbl">
            <tr>
                <td>
                    <span class="hiw"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/splash/interactivemap.png"/><br/>
                    <?php echo CHtml::link('Interactive Map', array('site/preFind')); ?></span><br/><br/>
                    Allow you to experience <br/>Interactive mapping feature<br/><br/>
                </td>
                <td>
                    <span class="hiw"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/splash/findaffiliates.png"/><br/>
                    <?php echo CHtml::link('Find Affiliates', array('site/login')); ?></span><br/><br/>
                    Get Connected with Churches <br/>and Organizations that is affiliated <br/>to you
                </td>
                <td>
                    <span class="hiw"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/splash/speak.png"/><br/>
                    <?php echo CHtml::link('Speak', array('site/login')); ?></span><br/><br/>
                    Encourage everyone and <br/>interact with Churches and <br/>Organizations
                </td>
            </tr>
            <tr>
                <td>
                    <span class="hiw"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/splash/postneed.png"/><br/>
                    <?php echo CHtml::link('Post you Needs', array('site/login')); ?></span><br/><br/>
                    Cloud121 allows you to <br/>post the Need of your <br/>Church or Organization. <br/>This will help on Edifying <br/>God's Kingdom
                </td>
                <td>
                    <span class="hiw"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/splash/postbless.png"/><br/>
                    <?php echo CHtml::link('Post your Blessings', array('site/login')); ?></span><br/><br/>
                    Share Your Blessings! <br/>Help other Churches <br/>and Organizations. <br/>Join our Mission!<br/><br/>
                </td>
                <td>
                    <span class="hiw"><img src="<?php echo CHtml::encode(Yii::app()->request->baseUrl); ?>/images/splash/postevent.png"/><br/>
                    <?php echo CHtml::link('Post an Event', array('site/login')); ?></span><br/><br/>
                    Invite Everyone! <br/>Cloud121 allows you <br/>to post your Events <br/>and share it to other <br/>Churches and Organizations
                </td>
            </tr>
        </table>
    </div>
<?php } ?>

<!--
Above is the dynamic Template for Registered Users
-->
<div id="ueg"<?php if (Yii::app()->user->isGuest) {echo "style='display: none;'";} ?>>
    <div id="unify">
        <h1>UNIFY</h1>
        <div>
            Get Connected and find more ways to spread the word and bring light to others.
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <?php if (!Yii::app()->user->isGuest) { ?>
                <div class="span-btn tab-btn ueg-btn" style="background: #0D3C80"><b><?php echo CHtml::link('Find Affiliates', array('church/index')); ?></b></div>
            <?php } else { ?>
                <div class="span-btn tab-btn ueg-btn" style="background: #0D3C80"><b><?php echo CHtml::link('Get Connected', array('site/login')); ?></b></div>
            <?php } ?>
        </div>
    </div>
    <div id="edify">
        <h1>EDIFY</h1>
        <div>
            Help with other organizations and help each other on edifying the bride.
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="span-btn tab-btn ueg-btn" style="background: #0D3C80"><b><?php echo CHtml::link('Post a Need', array('churchNeeds/create')); ?></b></div>
            <div class="span-btn tab-btn ueg-btn" style="background: #0D3C80"><b><?php echo CHtml::link('Post a Blessing', array('churchSupplies/create')); ?></b></div>
        </div>
    </div>
    <div id="glorify">
        <h1>GLORIFY</h1>
        <div>
            Spread the word, speak and share to the world what God has done to your life.
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <?php if (Yii::app()->user->isGuest) { ?>
                <div class="span-btn tab-btn ueg-btn" style="background: #0D3C80"><b><?php echo CHtml::link('Share you Story', array('site/login')); ?></b></div>
            <?php } else { ?>
                <div class="span-btn tab-btn ueg-btn" style="background: #0D3C80"><b><?php echo CHtml::link('Share you Story', array('church/view', 'id' => Yii::app()->user->getUser('churchId'))); ?></b></div>
            <?php } ?>
        </div>
    </div>
</div>
