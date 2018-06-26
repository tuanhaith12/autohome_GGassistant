<?php

class Application
{
	public function __construct()
	{
		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>";
		echo "	  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script> ";
		echo " 	  <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>";
		echo "    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' /> ";
		echo "    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script> ";
		echo "    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script> ";

		echo "	  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
		echo "    <link rel='stylesheet' href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'> ";

		echo "    <script src='https://code.jquery.com/jquery-1.12.4.js'></script> ";
		echo "    <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script> ";
		
		echo "	<nav class='navbar navbar-light bg-light navbar-fixed-top'> ";
		echo "	<div class='container-fluid'>";
		echo "	    <div class='navbar-header'>";
		echo "	      <a class='navbar-brand' href='#'>Home Automation Webpage</a>";
		echo "	      <ul class='nav navbar-nav'>";
		echo "        	 	<li><a href='#section1'>Appliances Control</a></li>";
		echo "         		<li><a href='#section2'>Sensors Monitor</a></li>";
		echo "         		<li><a href='#section3'>History</a></li>";
		echo "	      <ul>";
		echo "	    </div>";
		echo "	</div>";
		echo "	</nav>";

		echo "<form action='' method='post'>	";
		echo "<center><div style='margin-top:50px' class='panel panel-default'>";
		echo "		<div id='section1' class='panel-heading'><h1>Home Appliances Control</h1></div>";
		echo "		<div class='panel-body' style='background-color: #e8e9ed'>";
		echo "			<table style='text-align: center' border=0>	";
		echo "				<tr><td>";
		echo "						<div class='panel panel-default' style='height:250px'>";
		echo "							<div class='panel-heading'>.<div style='float:left'>Living Room</div></div>";
		echo "							<div class='panel-body'> ";
		echo "								<table style='text-align: center' border=0>	";
		echo "									<tr>";
		echo "										<td style='width:200px'><i class='fa fa-lightbulb-o' style='font-size:64px'></i></br><label>Light 1</label></td>";
		echo "										<td style='width:200px'><i class='material-icons' style='font-size:58px'>&#xe332;</i></br><label>Fan</label></td></tr>		";
		echo "									</tr>";
		echo "									<tr>";
		echo "										<td><div class='btn-group'> ";
		echo "											<button class='btn btn-default btn-sm' name='r1ON'><span id='icon_light_1_ON' class='glyphicon glyphicon-record'></span> ON</button> 	";
		echo "											<button class='btn btn-default btn-sm' name='r1OFF'><span id='icon_light_1_OFF' class='glyphicon glyphicon-record'></span> OFF</button> 	";
		echo "										</div></td>";
		echo "										<td><div class='btn-group'> ";
		echo "											<button class='btn btn-default btn-sm' name='r3ON'><span id='icon_light_3_ON' class='glyphicon glyphicon-record'></span> ON</button> 	";
		echo "											<button class='btn btn-default btn-sm' name='r3OFF'><span id='icon_light_3_OFF' class='glyphicon glyphicon-record'></span> OFF</button> 	";
		echo "										</div></td>";
		echo "									</tr>";
		echo "									<tr><td></td><td><div class='btn-group'>";
		echo "											<button class='btn btn-default btn-sm' name='r3_speed'> SPEED</button> 	";
		echo "											<button class='btn btn-default btn-sm' name='r3_swing'> SWING</button> 	";
		echo "											<button class='btn btn-default btn-sm' name='r3_timer'> TIMER</button> 	";
		echo "										</div></td>";
		echo "									</tr>	";
		echo "								</table>";
		echo "						</div>	</div>";
		echo "				</td>";
		echo "				<td>		<div class='panel panel-default' style='height:250px'> ";
		echo "							<div class='panel-heading'>.<div style='float:left'>Kitchen Room</div></div>";
		echo "							<div class='panel-body'> ";
		echo "								<table style='text-align: center' border=0>	";
		echo "									<tr>";
		echo "										<td style='width:200px'><i class='fa fa-lightbulb-o' style='font-size:64px'></i></br><label>Light 2</label></td>";
		echo "										<td style='width:200px'></td>";
		echo "									</tr>";
		echo "									<tr>";
		echo "										<td><div class='btn-group'> ";
		echo "											<button class='btn btn-default btn-sm' name='r2ON'><span id='icon_light_2_ON' class='glyphicon glyphicon-record'></span> ON</button> 	";
		echo "											<button class='btn btn-default btn-sm' name='r2OFF'><span id='icon_light_2_OFF' class='glyphicon glyphicon-record'></span> OFF</button> 	";
		echo "										</div></td>";
		echo "									</tr>";
		echo "								</table>";
		echo "						</div>	</div>";
		echo "				</td></tr></table>";
		echo "</div></div></center>";

		$db = new SQLite3('/home/pi/autohome_DB.db');
                $results = $db->query("SELECT device_state FROM device_remote WHERE device_id = 'r01'");

		while($row = $results->fetchArray(SQLITE3_ASSOC) ) {
				$device_state_r01 = $row['device_state'];
		}			
		$db = new SQLite3('/home/pi/autohome_DB.db');
		$results = $db->query("SELECT device_state FROM device_remote WHERE device_id = 'r02'");

		while($row = $results->fetchArray(SQLITE3_ASSOC) ) {
				$device_state_r02 = $row['device_state'];
		}	
		$db = new SQLite3('/home/pi/autohome_DB.db');
		$results = $db->query("SELECT device_state FROM device_remote WHERE device_id = 'r03'");

		while($row = $results->fetchArray(SQLITE3_ASSOC) ) {
				$device_state_r03 = $row['device_state'];
		}
		if ($device_state_r01 =='r1ON'){
		echo " <script>	$('#icon_light_1_ON').attr('style','color:green');</script>";
		}
		else if($device_state_r01 =='r1OFF'){
		echo " <script>	$('#icon_light_1_OFF').attr('style','color:red');</script>";
		}		
		if ($device_state_r02 =='r2ON'){
		echo " <script>	$('#icon_light_2_ON').attr('style','color:green');</script>";
		}
		else if($device_state_r02 =='r2OFF'){
		echo " <script>	$('#icon_light_2_OFF').attr('style','color:red');</script>";
		}			
		if ($device_state_r03 =='r3ON'){
		echo " <script>	$('#icon_light_3_ON').attr('style','color:green');</script>";
		}
		else if($device_state_r03 =='r3OFF'){
		echo " <script>	$('#icon_light_3_OFF').attr('style','color:red');</script>";
		}

		if(array_key_exists('r1ON',$_POST)){
   			$db_remote = new SQLite3('/home/pi/autohome_DB.db');
			$query = "UPDATE device_remote SET device_state = 'r1ON-web', lastdate = date('now','localtime'), lastime = time('now','localtime') WHERE device_id = 'r01'";
	                $db_remote->exec($query);
		echo " <script>	$('#icon_light_1_ON').attr('style','color:green');</script>";
		echo " <script>	$('#icon_light_1_OFF').attr('style','color:none');</script>";
		}
		else if(array_key_exists('r1OFF',$_POST)) {
			$db_remote = new SQLite3('/home/pi/autohome_DB.db');
			$query = "UPDATE device_remote SET device_state = 'r1OFF-web', lastdate = date('now','localtime'), lastime = time('now','localtime') WHERE device_id = 'r01'";
	                $db_remote->exec($query);
		echo " <script>	$('#icon_light_1_ON').attr('style','color:none');</script>";
		echo " <script>	$('#icon_light_1_OFF').attr('style','color:red');</script>";
		}
                if(array_key_exists('r2ON',$_POST)){
   			$db_remote = new SQLite3('/home/pi/autohome_DB.db');
			$query = "UPDATE device_remote SET device_state = 'r2ON-web', lastdate = date('now','localtime'), lastime = time('now','localtime') WHERE device_id = 'r02'";
	                $db_remote->exec($query);
		echo " <script>	$('#icon_light_2_ON').attr('style','color:green');</script>";
		echo " <script>	$('#icon_light_2_OFF').attr('style','color:none');</script>";
		}
		else if(array_key_exists('r2OFF',$_POST)) {
			$db_remote = new SQLite3('/home/pi/autohome_DB.db');
			$query = "UPDATE device_remote SET device_state = 'r2OFF-web', lastdate = date('now','localtime'), lastime = time('now','localtime') WHERE device_id = 'r02'";
	                $db_remote->exec($query);
		echo " <script>	$('#icon_light_2_ON').attr('style','color:none');</script>";
		echo " <script>	$('#icon_light_2_OFF').attr('style','color:red');</script>";
		}

		$db = new SQLite3('/home/pi/autohome_DB.db');
                $results = $db->query("SELECT * FROM SYS_REC WHERE temperature <> 0 AND temperature < 100 AND humidity < 200 AND humidity <> 0 AND brightness <> 0");

		while($row = $results->fetchArray(SQLITE3_ASSOC) ) {
				$current_datetime = $row['currentdate'] . " ". $row['currentime'];
				$temperature = $row['temperature'];
				$humidity = $row['humidity'];
				$brightness = $row['brightness'];
				$temp_rasp = $row['temp_rasp'];
		}	
		echo "<center><div id='section2' class='panel panel-default'>";
		echo "		<div class='panel-heading'><h1>Home Sensor Data</h1></div>";
		echo "		<div class='panel-body' style='background-color: #e8e9ed'> ";
		echo "			<div class='panel panel-default'> ";
		echo "				<div class='panel-heading'>.<div style='float:left'>Living Room</div>";
		echo "					<div style='float:right'>Last Update: ".$current_datetime."</div>";
		echo "				</div>";
		echo "				<div class='panel-body'> ";

		

		echo "				<table style='text-align: center'>";
		echo "					<tr>";
		echo "						<td>Temperature (DHT11 Sensor)</td>";
		echo "						<td>Humidity (DHT11 Sensor)</td>";
		echo "						<td>Brightness (LDR Sensor)</td>";
		echo "						<td>Temperature (Rasp Pi Sensor)</td>";
		echo "					</tr>";
		echo "					<tr>";
		echo "						<td style='width:200px'><i class='fa fa-thermometer-2' style='font-size:64px'></i></td>";
		echo "						<td style='width:200px'><i class='fa fa-tint' style='font-size:64px'></i></td>";
		echo "						<td style='width:200px'><i class='material-icons' style='font-size:64px'>wb_sunny</i></td>";
		echo "						<td style='width:200px'><i class='fa fa-thermometer-2' style='font-size:64px'></i></td></tr>";
		echo "					<tr>";
		echo "						<td>". $temperature ."</td>";
		echo "						<td>". $humidity ."</td>";
		echo "						<td>". $brightness ."</td>";
		echo "						<td>". $temp_rasp ."</td>";
		echo "					</tr>";
		echo "				</table>";
		echo "			</div>	</div>";
		echo "			<div class='panel panel-default'> ";
		echo "				<div class='panel-heading'>Kitchen Room</div>";
		echo "				<div class='panel-body'> Future Updating ";
		echo "			</div>	</div>";
		echo "</div></div></center>";


		echo "<center><div id='section3' class='panel panel-default'>";
		echo"		<div class='panel-heading'><h1>History Sensor Data</h1></div>";
		echo "		<div class='panel-body' style='background-color: #e8e9ed'> ";
		echo "Please enter the date which you want to monitor. Eg. 04/10/2018 (month/day/year) </br>";
 		echo "From: <input type='text' id='datepicker_from' name='datepicker_from'/> ";
 		echo " To: <input type='text' id='datepicker_to' name='datepicker_to'/> ";
		echo " Frequency: <select name='freq_value'> ";
		echo "  		<option value=''>Select...</option> ";
		echo "  		<option value='300'>5 minute</option> ";
		echo "  		<option value='600'>10 minute</option> ";
		echo "			<option value='1800'>30 minute</option> ";
		echo "		  </select>";
 		echo "<input type='submit' class='button' name='btnSubmitDateInput'/> ";
 		echo "</form> ";

		
		if (count($_POST)){
			if (array_key_exists('btnSubmitDateInput',$_POST)){
				$datepicker_from_split = explode("/", $_POST['datepicker_from']);
				$datepicker_to_split = explode("/", $_POST['datepicker_to']);
				$datepicker_from = $datepicker_from_split[2]. "-" .$datepicker_from_split[0]. "-" .$datepicker_from_split[1];
				$datepicker_to = $datepicker_to_split[2]. "-" .$datepicker_to_split[0]. "-" .$datepicker_to_split[1];

				$freq_value = $_POST['freq_value'];

				$db = new SQLite3('/home/pi/autohome_DB.db');
		                $results = $db->query("SELECT * FROM SYS_REC WHERE temperature <> 0 AND temperature < 100 AND humidity < 200 AND humidity <> 0 AND brightness <> 0 AND currentdate between '$datepicker_from' and '$datepicker_to'");

				echo "<table border cellpadding=3>";
 				echo "<th>ID</th><th>last_datetime</th><th>Temperature</th><th>Humidity</th><th>Brightness</th><th>Temp_rasp</th><th>device_id</th>";
            			while($row = $results->fetchArray(SQLITE3_ASSOC) ) {
                        		/*
					$temp_humi_datetime= $row['currentdate'] . " " . $row['currentime'];
					$entry .= "['".$temp_humi_datetime."',".$row['temperature'].",".$row['humidity']."],"; 
					*/
					$id = $row['id'];
					$current_datetime = $row['currentdate'] . " ". $row['currentime'];
					$temperature = $row['temperature'];
					$humidity = $row['humidity'];
					$brightness = $row['brightness'];
					$temp_rasp = $row['temp_rasp'];
					$device_id = $row['device_id'];
				}

                		echo "<tr>";
 				echo "<td>". $id . " </td> ";
 				echo "<td>". $current_datetime . " </td> ";
				echo "<td>". $temperature . " </td> ";
 				echo "<td>". $humidity . " </td> ";
				echo "<td>". $brightness . " </td> ";
				echo "<td>". $temp_rasp . " </td>  ";
				echo "<td>". $device_id . " </td></tr> ";
                		echo "</table></div></div></center></br>";

				echo "<html>";
				echo "<head>";
				
				echo "    <script type='text/javascript'> ";
				echo "      google.charts.load('current', {'packages':['corechart']}); ";
				echo "      google.charts.setOnLoadCallback(drawChart_dht11); ";
				echo "	    google.charts.setOnLoadCallback(drawChart_brightness); ";
				echo "	    google.charts.setOnLoadCallback(drawChart_temp_rasp); ";

				echo "      function drawChart_dht11() { ";
				echo "        var data = google.visualization.arrayToDataTable([ ";
                		echo "		['Time', 'Temperature', 'Humidity'], ";
				$lastime_sec = 0;
				$currentime_sec = 0;
				$lastdate = $datepicker_from;
				while($row = $results->fetchArray(SQLITE3_ASSOC) ) {
					$currentdate = $row['currentdate'];
					$currentime = $row['currentime'];

					$currentdatetime = $currentdate . " " . $currentime;

					$currentdate_split = explode("-", $currentdate);
					$lastdate_split = explode("-", $lastdate);

					if ($currentdate_split[0] - $lastdate_split[0] == 0){
						if ($currentdate_split[1] - $lastdate_split[1] == 0){
							$date_interval = $currentdate_split[2] - $lastdate_split[2];
							$currentime_split = explode(":", $currentime);
							$currentime_sec = intval($date_interval * 24 * 3600) + intval($currentime_split[0]) * 3600 + intval($currentime_split[1]) * 60 + intval($currentime_split[0]);
							$time_interval = $currentime_sec - $lastime_sec;
							if ($time_interval > $freq_value) {
								$entry = "['".$currentdatetime."',".$row['temperature'].",".$row['humidity']."], ";
	        						echo $entry;
								$lastime_sec = $currentime_sec;
								$lastdate = $currentdate;
								if ($date_interval == 1){
									$lastime_sec = $lastime_sec - 24 * 3600;
								}
							}
						}
						else {
						}
					}
					else {
					}
				}
				echo "	      ]); ";

				echo "        var options = { ";
				echo "          title: 'Temperature & Humidity (DHT11 SENSOR)', ";
				echo "          curveType: 'function', ";
				echo "		width: 500, ";
				echo "		height: 450, ";
				echo "		series:{0: {color: '#e2431e'}, 1: {color: '#1c91c0'}}, ";
				echo "		hAxes:{0: {title:'Date(From:  ". $datepicker_from ." To: ". $datepicker_to .") | Frequency: ". $freq_value/60 ." minutes'}}, ";
				echo "          legend: { position: 'bottom' } ";
				echo "        }; ";

				echo "        var chart = new google.visualization.LineChart(document.getElementById('dht11_chart')); ";

				echo "        chart.draw(data, options); ";
				echo "      } ";

				echo "      function drawChart_brightness() { ";
				echo "        var data = google.visualization.arrayToDataTable([ ";
                		echo "		['Time', 'Brightness'], ";
				$lastime_sec = 0;
				$currentime_sec = 0;
				$lastdate = $datepicker_from;
				while($row = $results->fetchArray(SQLITE3_ASSOC) ) {
					$currentdate = $row['currentdate'];
					$currentime = $row['currentime'];

					$currentdatetime = $currentdate . " " . $currentime;

					$currentdate_split = explode("-", $currentdate);
					$lastdate_split = explode("-", $lastdate);

					if ($currentdate_split[0] - $lastdate_split[0] == 0){
						if ($currentdate_split[1] - $lastdate_split[1] == 0){
							$date_interval = $currentdate_split[2] - $lastdate_split[2];
							$currentime_split = explode(":", $currentime);
							$currentime_sec = intval($date_interval * 24 * 3600) + intval($currentime_split[0]) * 3600 + intval($currentime_split[1]) * 60 + intval($currentime_split[0]);
							$time_interval = $currentime_sec - $lastime_sec;
							if ($time_interval > $freq_value) {
								$entry = "['".$currentdatetime."',".$row['brightness']."], ";
	        						echo $entry;
								$lastime_sec = $currentime_sec;
								$lastdate = $currentdate;
								if ($date_interval == 1){
									$lastime_sec = $lastime_sec - 24 * 3600;
								}
							}
						}
						else {
						}
					}
					else {
					}
				}
				echo "	      ]); ";
				echo "        var options = { ";
				echo "          title: 'Brightness (Themoresistor SENSOR)', ";
				echo "          curveType: 'function', ";
				echo "		width: 500, ";
				echo "		height: 450, ";
				echo "		series: {0: {color: '#f1ca3a'}}, ";
				echo "		hAxes:{0: {title:'Date(From:  ". $datepicker_from ." To: ". $datepicker_to.") | Frequency: ". $freq_value/60 ." minutes'}}, ";
				echo "          legend: { position: 'bottom' } ";
				echo "        }; ";

				echo "        var chart = new google.visualization.LineChart(document.getElementById('brightness_chart')); ";

				echo "        chart.draw(data, options); ";
				echo "      } ";

				echo "      function drawChart_temp_rasp() { ";
				echo "        var data = google.visualization.arrayToDataTable([ ";
                		echo "		['Time', 'Temperature (Raspberry Pi)'], ";
				$lastime_sec = 0;
				$currentime_sec = 0;
				$lastdate = $datepicker_from;
				while($row = $results->fetchArray(SQLITE3_ASSOC) ) {
					$currentdate = $row['currentdate'];
					$currentime = $row['currentime'];

					$currentdatetime = $currentdate . " " . $currentime;

					$currentdate_split = explode("-", $currentdate);
					$lastdate_split = explode("-", $lastdate);

					if ($currentdate_split[0] - $lastdate_split[0] == 0){
						if ($currentdate_split[1] - $lastdate_split[1] == 0){
							$date_interval = $currentdate_split[2] - $lastdate_split[2];
							$currentime_split = explode(":", $currentime);
							$currentime_sec = intval($date_interval * 24 * 3600) + intval($currentime_split[0]) * 3600 + intval($currentime_split[1]) * 60 + intval($currentime_split[0]);
							$time_interval = $currentime_sec - $lastime_sec;
							if ($time_interval > $freq_value) {
								$entry = "['".$currentdatetime."',".$row['temp_rasp']."], ";
	        						echo $entry;
								$lastime_sec = $currentime_sec;
								$lastdate = $currentdate;
								if ($date_interval == 1){
									$lastime_sec = $lastime_sec - 24 * 3600;
								}
							}
						}
						else {
						}
					}
					else {
					}
				}
				echo "	      ]); ";

				echo "        var options = { ";
				echo "          title: 'Temperature (Raspberry Pi SENSOR)', ";
				echo "          curveType: 'function', ";
				echo "		width: 500, ";
				echo "		height: 450, ";
				echo "		series: {0: {color: 'red'}}, ";
				echo "		hAxes:{0: {title:'Date(From:  ". $datepicker_from ." To: ". $datepicker_to.") | Frequency: ". $freq_value/60 ." minutes'}}, ";
				echo "          legend: { position: 'bottom' } ";
				echo "        }; ";

				echo "        var chart = new google.visualization.LineChart(document.getElementById('temp_rasp_chart')); ";

				echo "        chart.draw(data, options); 				";
				echo "      } 								";

				echo "	    $( function() { ";
				echo "    	$( '#datepicker_from' ).datepicker(); ";
				echo "		$( '#datepicker_to' ).datepicker(); ";
				echo "      } ); ";

				echo "    </script> ";
				echo "  </head> ";
				echo "  <body> ";
				echo " 		<center><table> ";
				echo "  		<tr> ";
				echo "				<td><div id='dht11_chart' style='width: 500px; height: 450px'></div></td> ";
				echo "				<td><div id='brightness_chart' style='width: 500px; height: 450px'></div></td>	";
				echo "			</tr> ";
				echo "			<tr><td><div id='temp_rasp_chart' style='width: 500px; height: 450px'></div></td>	";
				echo "			</tr> ";
				echo "		</table> </center>";
				
				echo "  </body> ";
				echo " </html> ";
			}
		}
	}
}

$application = new Application();
