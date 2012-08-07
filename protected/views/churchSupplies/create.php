<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/2aad5606/explode.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/2aad5606/implode.js"></script>
<?php
$this->breadcrumbs=array(
	'Church Supplies'=>array('index'),
	'Create',
);
?>
<style type="text/css">
    #cat-box{
        /*        float: right; */
        height: 100px;
        width: 410px;
        overflow: auto;
        padding: 10px;
        background: transparent;
        border: 1px solid #909AA3;
        display: none;
    }
    #need-map{
        float: right; 
        height: 300px;
        width: 430px;
    }
    #form-box{
        float: left; 
        padding-left: 20px;
        padding-top: 10px;
    }
    #form-header{
        background: #909AA3;
        padding: 10px;
        font-size: 14px;
        color: #FFFFFF;
    }
    #form-box input, textarea{
/*        border: 1px solid #909AA3;
        background: transparent;
        padding: 5px;
        resize: none;*/
    }
    #form-box input:hover{
/*        border: 1px solid #909AA3;*/
/*        background: #909AA3;*/
/*        padding: 5px;*/
    }
</style>
<div id="form-header">
    <b>Share a Blessing</b>
</div>
<div id="need-map">
    <?php
//
// ext is your protected.extensions folder
// gmaps means the subfolder name under your protected.extensions folder
//  
    Yii::import('ext.EGmap.*');

    $gMap = new EGMap();
    $gMap->zoom = 5;
    $gMap->setWidth(430);
    $gMap->setHeight(300);
    $mapTypeControlOptions = array(
        'position' => EGMapControlPosition::LEFT_BOTTOM,
        'style' => EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
    );

    $gMap->mapTypeControlOptions = $mapTypeControlOptions;

    $gMap->setCenter(13.368243250897299, 121.88232421875);

// Create GMapInfoWindows
    $info_window_a = new EGMapInfoWindow('<div>I am a marker with custom image!</div>');
    $info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');

    $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/greenpin.png");
    $icon->setSize(25, 26);
    $icon->setAnchor(16, 16.5);
    $icon->setOrigin(0, 0);
//
//    // Create marker
//    $marker = new EGMapMarker(13.368243250897299, 121.88232421875, array('icon' => $icon));
//    $marker->addHtmlInfoWindow($info_window_a);
//    $gMap->addMarker($marker);
    $dragevent = new EGMapEvent('dragend', "function (event) { $('#latlng').val(event.latLng);}", false, EGMapEvent::TYPE_EVENT_DEFAULT);
    $gMap->addEvent(new EGMapEvent('click',
            "function (event) {var marker = new google.maps.Marker({position: event.latLng, map: ".$gMap->getJsName().
            ", draggable: true, icon: ".$icon->toJs()."}); ".$gMap->getJsName().
            ".setCenter(event.latLng); var dragevent = ".$dragevent->toJs('marker').
            "; $('#latlng').val(event.latLng);
                }", false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));
    $gMap->renderMap();
    ?>

    <style type="text/css">
        .labels {
            color: red;
            background-color: white;
            font-family: "Lucida Grande", "Arial", sans-serif;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            width: 40px;     
            border: 2px solid black;
            white-space: nowrap;
        }
    </style>
    <i>Click on the Map to Pin the Location of your Need</i><span style="color: red">*</span>
</div>

<div id="form-box">
    <?php echo $this->renderPartial('_form', array('church' => $church, 'resource' => $dataProvider->data)); ?>
</div>
