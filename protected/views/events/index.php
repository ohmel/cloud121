<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/events.css" />

<?php
$this->breadcrumbs = array(
    'Events',
);
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
$info_window_a = new EGMapInfoWindow('<div>I am a marker with custom image!</div>');
$info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');
$eventsall = array_merge($local, $international);
for ($i = 0; $i < count($eventsall); $i++) {
    $type = $eventsall[$i]['event_type'];
    switch ($type) {
        case '1':
            $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/blue.png");
            break;
        case '2':
            $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/orange.png");
            break;
        case '3':
            $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/green.png");
            break;
        case '4':
            $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/violet.png");
            break;
        default:
            $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/yellow.png");
            break;
    }
    $arrLatlng = explode(",", $eventsall[$i]['latlng']);
//    $arrLatlng = explode(",", "0,0");


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
//$gMap->enableMarkerClusterer(new EGMapMarkerClusterer());
?>
<pre>
<?//php print_r($eventsall)?>
</pre>
<table id="event-tbl">
    <tr>
        <td id="main-content">
            
            <table>
                <tr>
                    <td>
                        <?php
                        $gMap->renderMap();
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="background: #BDC9D7;">
                        <div id="featured-header">FEATURED EVENTS</div>
                        <div id="post-event">
                            <span class="span-btn"><b><?php echo CHtml::link('+ Post Events', array('events/create')); ?></b></span>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td id="side-content">
            <div id="international-events">
                <b>International Events</b>
            </div>
            <div id="international">
<?php for ($i = 0; $i < count($international); $i++) { ?>
                    <div class="intevents-list">
                        <b><?php echo $international[$i]['event_name'] ?></b>
                    </div>
                    <hr/>
<?php } ?>
            </div>  
            <div id="local-events">
                <b>Local Events</b>
            </div>
            <div id="local">

<?php for ($i = 0; $i < count($local); $i++) { ?>
                    <div class="locevents-list">
                        <b><?php echo $local[$i]['event_name'] ?></b>
                    </div>
                    <hr/>
<?php } ?>
            </div>
        </td>
    </tr>
</table>
