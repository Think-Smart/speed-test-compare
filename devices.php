<?php

require_once 'php/config.php';

$speedtest = new speedtest();

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
					<h3 class="panel-title">Add device</h3>
				</div>
				<div class="panel-body">
					<form id="addDevice">
						<div class="form-group">
							<label for="addDeviceDeviceName">Device name</label>
							<input type="text" class="form-control" id="addDeviceDeviceName" placeholder="Device name">
						</div>
						<div class="form-group">
							<label for="addDeviceDeviceType">Device type</label>
							<select class="form-control" id="addDeviceDeviceType">
								<?php
								echoSelectOption($speedtest->device_type);
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="addDeviceSystem">Device system</label>
							<select class="form-control" id="addDeviceSystem">
								<?php
								echoSelectOption($speedtest->system);
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="addDeviceInternetType">Internet type</label>
							<select class="form-control" id="addDeviceInternetType">
								<?php
								echoSelectOption($speedtest->internet_type);
								?>
							</select>
						</div>
						
						<button type="submit" class="btn btn-info">Add <i class="fa fa-angle-double-right"></i></button>
					</form>
				</div>
			</div>
			
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">All devices</h3>
				</div>
				<div class="panel-body">
					<?php
					$devices = $speedtest->get_device();
					if (is_array($devices) && !empty($devices)) {
						?>
						<ul class="positionsList">
							<?php
							foreach($devices as $k => $device)
								echo '<li><a href="#" data-toggle="modal" data-target="#editDevice' . $device['id'] . '"><i class="fa fa-pencil-square-o"></i></a><a href="php/action/deleteDevice.php?id=' . $device['id'] . '" class="delete-confirm"><i class="fa fa-trash-o"></i></a>' . $device['device_name'] . ' - ' . $speedtest->internet_type[$device['internet_type']] . '</li>';
							?>
						</ul>
						<?php
						foreach($devices as $k => $device) {
							?>
<div class="modal fade" id="editDevice<?php echo $device['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit device</h4>
			</div>
			<form class="editDeviceForm">
				<input type="hidden" class="form-control deviceId" id="editPositionFormId1" placeholder="id" value="<?php echo $device['id']; ?>">
				<div class="modal-body">
					<div class="form-group">
						<label>Device name</label>
						<input type="text" class="form-control editDeviceDeviceName" placeholder="Device name" value="<?php echo $device['device_name']; ?>">
					</div>
					<div class="form-group">
						<label>Device type</label>
						<select class="form-control editDeviceDeviceType">
							<?php
							echoSelectOption($speedtest->device_type,$device['device_type']);
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Device system</label>
						<select class="form-control editDeviceSystem">
							<?php
							echoSelectOption($speedtest->system,$device['system']);
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Internet type</label>
						<select class="form-control editDeviceInternetType">
							<?php
							echoSelectOption($speedtest->internet_type,$device['internet_type']);
							?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-info">Save changes <i class="fa fa-angle-double-right"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>
							<?php
							
						}
					} else echo 'empty...';
					?>
					
					
				</div>
			</div>
			
<?php include('include/footer.php'); ?>
			
		</div>
	
<?php include('include/footer_script.php'); ?>

	</body>
</html>