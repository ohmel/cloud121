<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/find.css" />
<?php
$this->pageTitle = Yii::app()->name;
$this->breadcrumbs = array(
    'Find',
);
?>
<table>
    <tr>
        <td rowspan="2" id="map">
            <?php
//
// ext is your protected.extensions folder
// gmaps means the subfolder name under your protected.extensions folder
//  
            Yii::import('ext.egmap.*');

            $gMap = new EGMap();
            $gMap->zoom = 3;
            $gMap->setWidth(300);
            $gMap->setHeight(200);
            $mapTypeControlOptions = array(
                'position' => EGMapControlPosition::LEFT_BOTTOM,
                'style' => EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
            );

            $gMap->mapTypeControlOptions = $mapTypeControlOptions;

            $gMap->setCenter($_GET['lat'], $_GET['long']);

// Create GMapInfoWindows
            $info_window_a = new EGMapInfoWindow('<div>I am a marker with custom image!</div>');
            $info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');

//            for ($i = 0; $i < count($news); $i++) {
//                $type = $news[$i]['news_type'];
//                switch ($type) {
//                    case '1':
//                        $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/blue.png");
//                        break;
//                    case '2':
//                        $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/orange.png");
//                        break;
//                    case '3':
//                        $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/green.png");
//                        break;
//                    case '4':
//                        $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/violet.png");
//                        break;
//                    default:
//                        $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/yellow.png");
//                        break;
//                }
//                if ($news[$i]['latlng2'] == "") {
//                    $arrLatlng = explode(",", $news[$i]['latlng']);
//                } else {
//                    $arrLatlng = explode(",", $news[$i]['latlng2']);
//                }
//
//
//                $icon->setSize(25, 26);
//                $icon->setAnchor(16, 16.5);
//                $icon->setOrigin(0, 0);
//
//                
//            }
            // Create marker
            $icon = new EGMapMarkerImage(Yii::app()->request->baseUrl . "/images/mappins/animblue.gif");
            $icon->setSize(27, 35);
            $icon->setAnchor(16, 16.5);
            $icon->setOrigin(0, 0);
            $marker = new EGMapMarker($_GET['lat'], $_GET['long'], array('icon' => $icon));
            $marker->addHtmlInfoWindow($info_window_a);
            $gMap->addMarker($marker);
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
            $gMap->renderMap();
            ?>
        </td>
    </tr>
    <tr>
        <td id="tbl-list">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'dataProvider' => $church->search(),
                'filter' => $church,
                'columns' => array(
                    'church_name:html',
                    'tel_num:html',
                    'email:html',
                    array(
                        'class' => 'EImageColumn',
                        // see below.
//            'imagePathExpression' => 'Yii::app()->request->baseUrl.\'/images/icons/facebook.png\';',
                        'imagePathExpression' => array(
                            '0' => 'Yii::app()->request->baseUrl.\'/images/icons/facebook.png\';',
                            '1' => 'Yii::app()->request->baseUrl.\'/images/icons/twitter.png\';',
                            '2' => 'Yii::app()->request->baseUrl.\'/images/icons/youtube.png\';',
                        ),
//            'imagePathExpression' => 'CHtml::link(\'Yii::app()->request->baseUrl.$data->imagePath\', \'#\', array(\'class\' => \'search-button\'));',
                        // Text used when cell is empty.
                        // Optional.
//            'emptyText' => 'No record Found',
                        // HTML options for image tag. Optional.
                        'imageOptions' => array(
                            'alt' => 'no',
                            'width' => 20,
                            'height' => 20,
                        ),
                    ),
                ),
            ));
            ?>
        </td>
    </tr>
</table>