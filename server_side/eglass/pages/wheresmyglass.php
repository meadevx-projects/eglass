<?php
// Access Rights - Start
$_SESSION['pageaccesstype']="superadmin#admin#agent";
// Access Rights - End

$errorMsg=""; // Clear Error Msg

$gmap_lat=get_glass_location_lat();
$gmap_long=get_glass_location_long();

$api_key="AIzaSyAp20GRBHJ2kV7UjhGxfdPSPzNoQN-npR0";

?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=<?php echo $api_key; ?>"></script>
<script>
var map;
var TILE_SIZE = 256;
var myloc = new google.maps.LatLng(<?php echo $gmap_lat; ?>,<?php echo $gmap_long; ?>);

function bound(value, opt_min, opt_max) {
  if (opt_min != null) value = Math.max(value, opt_min);
  if (opt_max != null) value = Math.min(value, opt_max);
  return value;
}

function degreesToRadians(deg) {
  return deg * (Math.PI / 180);
}

function radiansToDegrees(rad) {
  return rad / (Math.PI / 180);
}

/** @constructor */
function MercatorProjection() {
  this.pixelOrigin_ = new google.maps.Point(TILE_SIZE / 2,
      TILE_SIZE / 2);
  this.pixelsPerLonDegree_ = TILE_SIZE / 360;
  this.pixelsPerLonRadian_ = TILE_SIZE / (2 * Math.PI);
}

MercatorProjection.prototype.fromLatLngToPoint = function(latLng,
    opt_point) {
  var me = this;
  var point = opt_point || new google.maps.Point(0, 0);
  var origin = me.pixelOrigin_;

  point.x = origin.x + latLng.lng() * me.pixelsPerLonDegree_;

  // Truncating to 0.9999 effectively limits latitude to 89.189. This is
  // about a third of a tile past the edge of the world tile.
  var siny = bound(Math.sin(degreesToRadians(latLng.lat())), -0.9999,
      0.9999);
  point.y = origin.y + 0.5 * Math.log((1 + siny) / (1 - siny)) *
      -me.pixelsPerLonRadian_;
  return point;
};

MercatorProjection.prototype.fromPointToLatLng = function(point) {
  var me = this;
  var origin = me.pixelOrigin_;
  var lng = (point.x - origin.x) / me.pixelsPerLonDegree_;
  var latRadians = (point.y - origin.y) / -me.pixelsPerLonRadian_;
  var lat = radiansToDegrees(2 * Math.atan(Math.exp(latRadians)) -
      Math.PI / 2);
  return new google.maps.LatLng(lat, lng);
};

function createInfoWindowContent() {
  var numTiles = 1 << map.getZoom();
  var projection = new MercatorProjection();
  var worldCoordinate = projection.fromLatLngToPoint(myloc);
  var pixelCoordinate = new google.maps.Point(
      worldCoordinate.x * numTiles,
      worldCoordinate.y * numTiles);
  var tileCoordinate = new google.maps.Point(
      Math.floor(pixelCoordinate.x / TILE_SIZE),
      Math.floor(pixelCoordinate.y / TILE_SIZE));

  return [
    'Glass Location:',
    'LatLng: ' + myloc.lat() + ' , ' + myloc.lng()
  ].join('<br>');
}

function initialize() {
  var mapOptions = {
    zoom: 17,
    center: myloc
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var coordInfoWindow = new google.maps.InfoWindow();
  coordInfoWindow.setContent(createInfoWindowContent());
  coordInfoWindow.setPosition(myloc);
  coordInfoWindow.open(map);

  google.maps.event.addListener(map, 'zoom_changed', function() {
    coordInfoWindow.setContent(createInfoWindowContent());
    coordInfoWindow.open(map);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
<style>
  #map-canvas {
	height: 400px;
	margin: 0px;
	padding: 0px
  }
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Where's My Glass</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        	<div class="panel-heading">
                
            </div>
            <div class="panel-body">
                <div class="row">
                	<div id="msgdiv">
                    <p>
                    <?php if(isset($errorMsg) && strlen($errorMsg)>0 ) { ?>
                    <div align="center" class="errorMsg"><strong><?php echo $errorMsg; ?></strong></div>
                    <?php } else if(isset($_SESSION['successMsg']) && strlen($_SESSION['successMsg'])>0 ) { ?>
                    <div align="center" class="successMsg"><strong><?php echo $_SESSION['successMsg']; ?></strong></div>
                    <?php } ?>
                    </p>
                    </div>
                    <div class="col-lg-12">
                    
                    




    <div id="map-canvas"></div>
    <br/><br/>             
                       
                    
                    
                    </div>
                    <!-- /.col-lg-12 (nested) -->
                    
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php
// Clear Success Msg
$_SESSION['successMsg']="";
?>
