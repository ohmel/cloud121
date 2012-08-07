<!--<script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBEN-qwmprOhxioLPON8Ha1BLqthRwFHAY&sensor=true">
</script>-->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/find.css" />
<script>
    function initiate_geolocation() {  
        navigator.geolocation.getCurrentPosition(handle_geolocation_query,handle_errors);  
    }  
      
    function handle_errors(error)  
    {  
        switch(error.code)  
        {  
            case error.PERMISSION_DENIED: alert("user did not share geolocation data");  
                break;  
      
            case error.POSITION_UNAVAILABLE: alert("could not detect current position");  
                break;  
      
            case error.TIMEOUT: alert("retrieving position timed out");  
                break;  
      
            default: alert("unknown error");  
                break;  
        }  
    }
    function handle_geolocation_query(position){  
        //        alert('Lat: ' + position.coords.latitude +  
        //            ' Lon: ' + position.coords.longitude);  
        //        $("#lat").val(position.coords.latitude);
        //        $("#long").val(position.coords.longitude);
        window.location = "index.php?r=site/find&lat="+position.coords.latitude+"&long="+position.coords.longitude;
    }  
    initiate_geolocation();
    
</script>
<div id="redirect-info">
    <center>
        This page will redirect you to <b>Find Page</b> upon sharing your location...<br/>
        If it doesn't redirect you please <?php echo CHtml::link('Click here', array('site/find')); ?>
    </center>
</div>
