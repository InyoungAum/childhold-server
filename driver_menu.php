<?php
    require_once("top.php");
    $GOOGLE_MAP_API_KEY = 'AIzaSyBlrnJQmoX5Kd9OelEgWrBoHYBfPYMfIW8';
    
    function getDriverList() {
        global $connect;
        $sql    = 'SELECT * FROM driver';
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
                        
                        <h2 class="sub-header">운전자 목록</h2>
                            
                        <div class="table-responsive">
                            <table id="driver" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>차량번호</th>
                                        <th>기사이름</th>
                                        <th>위도</th>
                                        <th>경도</th>
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

                        <h2 class="sub-header">운전자 등록</h2>
                        <input type="text" class="form-control" placeholder="이름">
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
                            var lat = rows.getElementsByTagName('td')[2].innerHTML;
                            var lng = rows.getElementsByTagName('td')[3].innerHTML;
                            post('/driver_menu.php', {"name": name, "lat":lat, "lng":lng});
                        };
                    };
                currentRows.onclick = createClickHandler(currentRows);
            }
        }
        window.onload = addRowHandlers();

        function post(path, params, method) {
            method = method || "post"; // Set method to post by default if not specified.

            // The rest of this code assumes you are not using a library.
            // It can be made less wordy if you use one.
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);

            for(var key in params) {
                if(params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);

                    form.appendChild(hiddenField);
                }
            }

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</html>
