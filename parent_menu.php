<?php
    require_once("top.php");
    $GOOGLE_MAP_API_KEY = 'AIzaSyBlrnJQmoX5Kd9OelEgWrBoHYBfPYMfIW8';
    
    function getDriverList() {
        global $connect;
        $sql    = 'SELECT * FROM `parent` as p, `child` as c WHERE c.parent_idx = p.idx';
        $result = mysql_query($sql, $connect);

        if (!$result) {
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }

        while ($row = mysql_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>'.$row['idx'].'</td>';
            echo '<td id="name">'.$row['name'].'</td>';
            echo '<td id="lat">'.$row['lat'].'</td>';
            echo '<td id="lng">'.$row['lng'].'</td>';
            echo '<td id="device_id">'.$row['device_id'].'</td>';
            echo '<td id="beacon_id">'.$row['beacon_id'].'</td>';
        }
    }

    function showSelectedLocation($name, $lat, $lng) {
        global $GOOGLE_MAP_API_KEY;
        $name = iconv("euc-kr", "utf8", $name);
        $url = "https://maps.googleapis.com/maps/api/staticmap?zoom=13&size=600x300&maptype=roadmap&markers=color:blue%7Clabel:".$name."%7C".$lat.",".$lng."&key=".$GOOGLE_MAP_API_KEY;
        echo "<img src='".$url."' />";
    }
?>
        
            <!-- 본문 -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                        
                        <h2 class="sub-header">아이 목록</h2>
                            
                        <div class="table-responsive">
                            <table id="driver" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>번호</th>
                                        <th>아이이름</th>
                                        <th>위도</th>
                                        <th>경도</th>
                                        <th>기기</th>
                                        <th>비콘</th>
                                    </tr>
                                </thead>
                                <?php getDriverList(); ?>
                            </table> 
                        </div>

                        <?php
                            if ($_POST["name"] != NULL) {
                                showSelectedLocation($_POST["name"], $_POST["lat"], $_POST["lng"]);
                            }
                        ?>

                        <h2 class="sub-header">부모 등록</h2>
                        <input type="text" class="form-control" placeholder="이름">

                        <div id="map"></div>
                </div>
            </div>
            <!-- /본문 -->
        </div>
    </body>

    <script type="text/javascript">
        function addRowHandlers() {
            var table = document.getElementById("driver");
            var rows = table.getElementsByTagName("tr");
            for (i = 0; i < rows.length; i++) {
                var currentRows = table.rows[i];
                var createClickHandler = 
                    function(rows) {
                        return function() { 
                            var name = rows.getElementsByTagName('td')[1].innerHTML;
                            var lat = parseFloat(rows.getElementsByTagName('td')[2].innerHTML);
                            var lng = parseFloat(rows.getElementsByTagName('td')[3].innerHTML);
                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 16,
                                center: {lat: lat, lng: lng}
                            });

                            var geocoder = new google.maps.Geocoder;
                            var infowindow = new google.maps.InfoWindow;
                            var input = lat + "," +lng
                            geocodeLatLng(geocoder, map, infowindow, input);
                        };
                    };
                currentRows.onclick = createClickHandler(currentRows);
            }
        }
        window.onload = addRowHandlers();

        function initMap() {
        }

        function geocodeLatLng(geocoder, map, infowindow, input) {
            var latlngStr = input.split(',', 2);
            var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                    map.setZoom(16);
                    var marker = new google.maps.Marker({
                        position: latlng,
                        map: map
                    });
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                    } else {
                    window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlrnJQmoX5Kd9OelEgWrBoHYBfPYMfIW8&callback=initMap">
    </script>
</html>
