			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php">SpeedTest</a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
						<ul class="nav navbar-nav navbar-right">
							<li<?php if (basename($_SERVER['PHP_SELF']) == "index.php") echo " class=\"active\""; ?>><a href="index.php">Home</a></li>
							<li<?php if (basename($_SERVER['PHP_SELF']) == "positions.php") echo " class=\"active\""; ?>><a href="positions.php">Tests position</a></li>
							<li<?php if (basename($_SERVER['PHP_SELF']) == "devices.php") echo " class=\"active\""; ?>><a href="devices.php">Tests device</a></li>
							<li<?php if (basename($_SERVER['PHP_SELF']) == "speedtest.php") echo " class=\"active\""; ?>><a href="speedtest.php">Make SpeedTest</a></li>
							<li<?php if (basename($_SERVER['PHP_SELF']) == "all_speedtest.php") echo " class=\"active\""; ?>><a href="all_speedtest.php">All SpeedTest</a></li>
							<li<?php if (basename($_SERVER['PHP_SELF']) == "statistics.php") echo " class=\"active\""; ?>><a href="statistics.php">SpeedTest statistics</a></li>
						</ul>
					</div>
				</div>
			</nav>
