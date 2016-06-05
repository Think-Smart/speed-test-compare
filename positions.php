<?php

require_once 'php/config.php';

$speedtest = new speedtest();

function get_asn() {
    $details = json_decode(file_get_contents("http://ipinfo.io/{$_SERVER['REMOTE_ADDR']}"));
    return $details->org;
}

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
					<h3 class="panel-title">Add position</h3>
				</div>
				<div class="panel-body">
					<form id="addPosition">
						<div class="form-group">
							<label for="addPositionName">Position name</label>
							<input type="text" class="form-control" id="addPositionName" placeholder="Position name">
						</div>
						<div class="form-group">
							<label for="addPositionProvider">Internet provider</label>
							<input type="text" class="form-control" id="addPositionProvider" placeholder="Internet provider" value="<?php echo get_asn(); ?>">
						</div>
						
						<button type="submit" class="btn btn-info">Add <i class="fa fa-angle-double-right"></i></button>
					</form>
				</div>
			</div>
			
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">All positions</h3>
				</div>
				<div class="panel-body">
					<?php
					$positions = $speedtest->get_position();
					if (is_array($positions) && !empty($positions)) {
						?>
						<ul class="positionsList">
							<?php
							foreach($positions as $k => $position)
								echo '<li><a href="#" data-toggle="modal" data-target="#editPosition' . $position['id'] . '"><i class="fa fa-pencil-square-o"></i></a><a href="php/action/deletePosition.php?id=' . $position['id'] . '" class="delete-confirm"><i class="fa fa-trash-o"></i></a>' . $position['name'] . '</li>';
							?>
						</ul>
						<?php
						foreach($positions as $k => $position) {
							?>
<div class="modal fade" id="editPosition<?php echo $position['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit position</h4>
			</div>
			<form class="editPositionForm">
				<input type="hidden" class="form-control positionId" id="editPositionFormId1" placeholder="id" value="<?php echo $position['id']; ?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="editPositionFormName1">Position name</label>
						<input type="text" class="form-control positionName" id="editPositionFormName1" placeholder="Position name" value="<?php echo $position['name']; ?>">
					</div>
					<div class="form-group">
						<label for="editPositionFormProvider1">Internet provider</label>
						<input type="text" class="form-control internetProvider" id="editPositionFormProvider1" placeholder="Internet provider" value="<?php echo $position['provider']; ?>">
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