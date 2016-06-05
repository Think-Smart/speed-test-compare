<?php

require_once 'php/config.php';

?>
<!DOCTYPE html>
<html DIR="LTR" LANG="en">
	<head>
<?php include('include/head.php'); ?>
	</head>
	<body>
		<div class="container">
<?php include('include/nav.php'); ?>
			
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Test your speed</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<button type="button" class="btn btn-primary btn-lg btn-block startSpeedTest" style="margin-bottom: 40px;">Start SpeedTest</button>
						</div>
						<div class="col-md-4 speedTestResults">
							<p>Download speed: <span id="downloadSpeedLive" class="speedNum">0</span> Mb/s</p>
							<p>Download speed average: <span id="downloadSpeedAverage" class="speedNum">0</span> Mb/s</p>
							<p>Download speed median: <span id="downloadSpeedMedian" class="speedNum">0</span> Mb/s</p>
							<p>Download speed max: <span id="downloadSpeedMax" class="speedNum">0</span> Mb/s</p>
						</div>
						<div class="col-md-4 speedTestResults">
							<p>Upload speed: <span id="uploadSpeedLive" class="speedNum">0</span> Kb/s</p>
							<p>Upload speed average: <span id="uploadSpeedAverage" class="speedNum">0</span> Kb/s</p>
							<p>Upload speed median: <span id="uploadSpeedMedian" class="speedNum">0</span> Kb/s</p>
							<p>Upload speed max: <span id="uploadSpeedMax" class="speedNum">0</span> Kb/s</p>
						</div>
						<div class="col-md-4 speedTestResults">
							<p>Ping speed: <span id="pingSpeedLive" class="speedNum">0</span> ms</p>
							<p>Ping speed average: <span id="pingSpeedAverage" class="speedNum">0</span> ms</p>
							<p>Ping speed median: <span id="pingSpeedMedian" class="speedNum">0</span> ms</p>
							<p>Ping speed min: <span id="pingSpeedMin" class="speedNum">0</span> ms</p>
						</div>
					</div>
				</div>
			</div>
			
<?php include('include/footer.php'); ?>
			
		</div>
	
<?php include('include/footer_script.php'); ?>

	</body>
</html>