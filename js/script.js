var speed_download_avg_start = 0;
var speed_download_avg_size_start = 0;

var speed_download_start = 0;
var speed_download_end = 0;
var speed_download_size = 0;
var speed_download_downloaded = 0;
var speed_download_downloaded2 = 0;
var speed_download_history = [];
var speed_download_temp = 0;
var speed_download_timer;
var speed_download_update = 0;
var speed_download_file = "files/22015-holiday-catalogue.pdf?c";

var speed_upload_avg_start = 0;
var speed_upload_avg_size_start = 0;

var speed_upload_start = 0;
var speed_upload_end = 0;
var speed_upload_already_uploaded = 0;
var speed_upload_already_uploaded2 = 0;
var speed_upload_temp_time = 0;
var speed_upload_history = [];
var speed_upload_timer;
var speed_upload_temp = 0;
var speed_upload_update = 0;

var speed_upload_file = getRandomString( 20 );


function updateDownloadProgress(evt) {
	if (evt.lengthComputable && evt.loaded > 0) {
		if (speed_download_downloaded == 0) {
			speed_download_start = speed_download_end = speed_download_avg_start = evt.timeStamp;
			speed_download_downloaded = speed_download_downloaded2 = speed_download_avg_size_start = evt.loaded;
			speed_download_size = evt.total;
		} else {
			speed_download_start = speed_download_end;
			speed_download_end = evt.timeStamp;
			speed_download_downloaded = speed_download_downloaded2;
			speed_download_downloaded2 = evt.loaded;
			
			speed_download_temp = Math.round(((speed_download_downloaded2-speed_download_downloaded) / 1024 / 1024 / ((speed_download_end - speed_download_start) / 1000))*8 * 100) / 100;
			speed_download_history.push(speed_download_temp);
			$('#downloadSpeedLive').text(speed_download_temp);
		}
   } 
}   
function updateUploadProgress(evt) {
	if (evt.lengthComputable && evt.loaded > 0) {
		if (speed_upload_already_uploaded == 0) {
			speed_upload_start = speed_upload_end = speed_upload_avg_start = evt.timeStamp;
			speed_upload_already_uploaded = speed_upload_already_uploaded2 = speed_upload_avg_size_start = evt.loaded;
		} else {
			speed_upload_start = speed_upload_end;
			speed_upload_end = evt.timeStamp;
			speed_upload_already_uploaded = speed_upload_already_uploaded2;
			speed_upload_already_uploaded2 = evt.loaded;
			
			speed_upload_temp = Math.round(((speed_upload_already_uploaded2-speed_upload_already_uploaded) / 1024 / ((speed_upload_end - speed_upload_start) / 1000))*8 * 100) / 100;
			speed_upload_history.push(speed_upload_temp);
			$('#uploadSpeedLive').text(speed_upload_temp);
			
			// speed_upload_update = 1;
		}
	}
}   
function sendreq(evt) {
    var req = new XMLHttpRequest(); 
    req.onprogress=updateDownloadProgress;
    req.open('GET', speed_download_file + Date.now(), true);  
	req.onreadystatechange = function () {
		if (req.readyState == 4) {
			
			$('#downloadSpeedLive').text(getMedian(speed_download_history));
			
			$('#downloadSpeedAverage').text(Math.round(((speed_download_downloaded2 - speed_download_avg_size_start) / 1024 / 1024 / ((speed_download_end - speed_download_avg_start) / 1000))*8 * 100) / 100);
			$('#downloadSpeedMedian').text(getMedian(speed_download_history));
			$('#downloadSpeedMax').text(Math.max.apply( Math, speed_download_history ));

			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'php/action/uploadTest.php', true);

			xhr.upload.onprogress = updateUploadProgress;
			
			xhr.onload = function() {
				if (this.status == 200) {
					
					$('#uploadSpeedLive').text(getMedian(speed_upload_history));
					
					$('#uploadSpeedAverage').text(Math.round(((speed_upload_already_uploaded2 - speed_upload_avg_size_start) / 1024 / ((speed_upload_end - speed_upload_avg_start) / 1000))*8 * 100) / 100);
					
					$('#uploadSpeedMedian').text(getMedian(speed_upload_history));
					$('#uploadSpeedMax').text(Math.max.apply( Math, speed_upload_history ));
					
					pingTest();
				};
			};
			xhr.timeout = 25000;
			xhr.ontimeout = function () {
				
				$('#uploadSpeedLive').text(getMedian(speed_upload_history));
				
				$('#uploadSpeedAverage').text(Math.round(getAverage(speed_upload_history) * 100) / 100);
				$('#uploadSpeedMedian').text(getMedian(speed_upload_history));
				$('#uploadSpeedMax').text(Math.max.apply( Math, speed_upload_history ));
				
				
				
				pingTest();
			}
			xhr.send(speed_upload_file);
			
			
		};
	};
	
    req.send(null); 
}
function check_internet_speed() {
	
	speed_download_avg_start = 0;
	speed_download_avg_size_start = 0;

	speed_download_start = 0;
	speed_download_end = 0;
	speed_download_size = 0;
	speed_download_downloaded = 0;
	speed_download_downloaded2 = 0;
	speed_download_history = [];
	speed_download_temp = 0;
	speed_download_timer;
	speed_download_update = 0;
	
	speed_upload_avg_start = 0;
	speed_upload_avg_size_start = 0;
	
	speed_upload_start = 0;
	speed_upload_end = 0;
	speed_upload_already_uploaded = 0;
	speed_upload_already_uploaded2 = 0;
	speed_upload_temp_time = 0;
	speed_upload_history = [];
	speed_upload_temp = 0;
	speed_upload_update = 0;
	
	$(".speedNum").text("0");
	
	sendreq();
}

$('.startSpeedTest').click(function(){
	$('.startSpeedTest').attr("disabled", "disabled");
	$('.startSpeedTest').html("<i class=\"fa fa-refresh fa-spin\" style=\"margin-right: 10px;\"></i> Testing speed");
	check_internet_speed();
});

function pingTest () {
	var pingAverage = 0;
	var pingCounter = 0;
	var pingHistory = [];
	var pingTestTimer = setInterval(function() {
		pingCounter++;
		var ping = Date.now();
		$.ajax({ type: "POST",
			url: "php/action/pingTest.php",
			data: {},
			cache:false,
			success: function(output){ 
				ping = Date.now() - ping;
				
				$('#pingSpeedLive').text(ping);
				
				pingHistory.push(ping);
				
				if (pingCounter >= 10){
					clearInterval(pingTestTimer);
					
					$('#pingSpeedLive').text(getMedian(pingHistory));
					$('#pingSpeedAverage').text(getAverage(pingHistory));
					$('#pingSpeedMedian').text(getMedian(pingHistory));
					$('#pingSpeedMin').text(Math.min.apply( Math, pingHistory ));
					
					$('.startSpeedTest').attr("disabled", false);
					$('.startSpeedTest').html("Run again SpeedTest");
					
				}
			}
		});
	}, 600);
}



function getMedian(values) {
	
    values.sort( function(a,b) {return a - b;} );

    var half = Math.floor(values.length/2);

    if(values.length % 2)
        return Math.round(values[half] * 100) / 100;
    else
        return Math.round(((values[half-1] + values[half]) / 2) * 100) / 100;
}
function getAverage(values) {
	var Sum = 0;
	for(var x = 0; x < values.length; x++) {
	  Sum = Sum + values[x];
	}

	return Sum / values.length;
}

function getRandomString( sizeInMb ) {
	var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789~!@#$%^&*()_+`-=[]\{}|;':,./<>?", //random data prevents gzip effect
		iterations = sizeInMb * 1024 * 1024, //get byte count
		result = '';
	for( var index = 0; index < iterations; index++ ) {
		result += chars.charAt( Math.floor( Math.random() * chars.length ) );
	};     
	return result;
};


$(document).ready(function() {
	
	if ($("body").hasClass("runSpeedTest")) {
		$('.startSpeedTest').attr("disabled", "disabled");
		$('.startSpeedTest').html("<i class=\"fa fa-refresh fa-spin\" style=\"margin-right: 10px;\"></i> Testing speed");
		check_internet_speed();
	}
	
	var ajaxRun = false;
	$('#addPosition').submit(function() {
		if (ajaxRun == false) {
			ajaxRun = true;
			$('#addPosition button[type=submit]').html('wait <i class="fa fa-refresh fa-spin"></i>');
			$.ajax({
				url: 'php/action/addPosition.php',
				type: 'POST',
				data: {
					name: $('#addPositionName').val(),
					provider: $('#addPositionProvider').val()
				},
				success: function(data){
					$('#addPosition button[type=submit]').html('Add <i class="fa fa-angle-double-right"></i>');
					if(data.status == 'success') {
						$('#addPosition').html("Success");
						location.reload();
					} else if(data.status == 'error') {
						alert(data.msg.join());
					} else {
						alert('Error.');
					}
					ajaxRun = false;
				},
				error: function() {
					$('#addPosition button[type=submit]').html('Add <i class="fa fa-angle-double-right"></i>');
					alert('Error.');
					ajaxRun = false;
				}
			});
			
		}
		return false;
	});
	
	$('.editPositionForm').submit(function() {
		if (ajaxRun == false) {
			ajaxRun = true;
			var thisForm = $(this);
			$("button[type=submit]", this).html('wait <i class="fa fa-refresh fa-spin"></i>');
			
			$.ajax({
				url: 'php/action/edit_position.php',
				type: 'POST',
				data: {
					id: $(".positionId", thisForm).val(),
					name: $(".positionName", thisForm).val(),
					provider: $(".internetProvider", thisForm).val()
				},
				success: function(data){
					console.log(data);
					$("button[type=submit]", thisForm).html('Save changes <i class="fa fa-angle-double-right"></i>');
					if(data.status == 'success') {
						thisForm.html("<div class=\"modal-body\">Success</div>");
						location.reload();
					} else if(data.status == 'error') {
						alert(data.msg.join());
						
					} else {
						alert('Error.');
					}
					ajaxRun = false;
				},
				error: function() {
					$("button[type=submit]", thisForm).html('Save changes <i class="fa fa-angle-double-right"></i>');
					alert('Error.');
					ajaxRun = false;
				}
			});
			
		}
		return false;
	});
	
	$('#addDevice').submit(function() {
		if (ajaxRun == false) {
			ajaxRun = true;
			$('#addDevice button[type=submit]').html('wait <i class="fa fa-refresh fa-spin"></i>');
			$.ajax({
				url: 'php/action/addDevice.php',
				type: 'POST',
				data: {
					device_name: $('#addDeviceDeviceName').val(),
					device_type: $('#addDeviceDeviceType').val(),
					system: $('#addDeviceSystem').val(),
					internet_type: $('#addDeviceInternetType').val(),
				},
				success: function(data){
					$('#addDevice button[type=submit]').html('Add <i class="fa fa-angle-double-right"></i>');
					if(data.status == 'success') {
						$('#addDevice').html("Success");
						location.reload();
					} else if(data.status == 'error') {
						alert(data.msg.join());
					} else {
						alert('Error.');
					}
					ajaxRun = false;
				},
				error: function() {
					$('#addDevice button[type=submit]').html('Add <i class="fa fa-angle-double-right"></i>');
					alert('Error.');
					ajaxRun = false;
				}
			});
			
		}
		return false;
	});
	
	$('.editDeviceForm').submit(function() {
		if (ajaxRun == false) {
			ajaxRun = true;
			var thisForm = $(this);
			$("button[type=submit]", this).html('wait <i class="fa fa-refresh fa-spin"></i>');
			
			$.ajax({
				url: 'php/action/edit_device.php',
				type: 'POST',
				data: {
					id: $(".deviceId", thisForm).val(),
					device_name: $(".editDeviceDeviceName", thisForm).val(),
					device_type: $(".editDeviceDeviceType", thisForm).val(),
					system: $(".editDeviceSystem", thisForm).val(),
					internet_type: $(".editDeviceInternetType", thisForm).val(),
				},
				success: function(data){
					console.log(data);
					$("button[type=submit]", thisForm).html('Save changes <i class="fa fa-angle-double-right"></i>');
					if(data.status == 'success') {
						thisForm.html("<div class=\"modal-body\">Success</div>");
						location.reload();
					} else if(data.status == 'error') {
						alert(data.msg.join());
						
					} else {
						alert('Error.');
					}
					ajaxRun = false;
				},
				error: function() {
					$("button[type=submit]", thisForm).html('Save changes <i class="fa fa-angle-double-right"></i>');
					alert('Error.');
					ajaxRun = false;
				}
			});
			
		}
		return false;
	});
	
	$('#makeSpeedTest').submit(function() {
		if ($('.startSpeedTest').attr("disabled") == "disabled")
			alert("Please wait until finish checking speed");
		else if (ajaxRun == false) {
			ajaxRun = true;
			$('#makeSpeedTest button[type=submit]').html('wait <i class="fa fa-refresh fa-spin"></i>');
			
			$.ajax({
				url: 'php/action/addSpeedTest.php',
				type: 'POST',
				data: {
					device_id: $('#makeSpeedTesDevice').val(),
					position_id: $('#makeSpeedTestPosition').val(),
					internet_distance: $('#makeSpeedTestInternetDistance').val(),
					downloadSpeedAverage: $('#downloadSpeedAverage').text(),
					downloadSpeedMedian: $('#downloadSpeedMedian').text(),
					downloadSpeedMax: $('#downloadSpeedMax').text(),
					uploadSpeedAverage: $('#uploadSpeedAverage').text(),
					uploadSpeedMedian: $('#uploadSpeedMedian').text(),
					uploadSpeedMax: $('#uploadSpeedMax').text(),
					pingSpeedAverage: $('#pingSpeedAverage').text(),
					pingSpeedMedian: $('#pingSpeedMedian').text(),
					pingSpeedMin: $('#pingSpeedMin').text()
				},
				success: function(data){
					$('#makeSpeedTest button[type=submit]').html('Save <i class="fa fa-angle-double-right"></i>');
					if(data.status == 'success') {
						$('#makeSpeedTest').html("<div class=\"col-md-12 text-center\">Success</div>");
						location.replace("all_speedtest.php");
					} else if(data.status == 'error') {
						alert(data.msg.join());
					} else {
						alert('Error.');
					}
					ajaxRun = false;
				},
				error: function() {
					$('#makeSpeedTest button[type=submit]').html('Save <i class="fa fa-angle-double-right"></i>');
					alert('Error.');
					ajaxRun = false;
				}
			});
			
		}
		return false;
	});
	
	$('.testRow').click(function(){
		$(this).addClass('active');
	});
	
	$('#editSpeedTest').on('show.bs.modal', function (event) {
		var testId = $('.testRow.active').data('id');
		$('.testRow.active').removeClass('active');
		$('#editSpeedTestLoading').show();
		$('#editSpeedTestForm').hide();
		$('#editSpeedTestFormId').val(testId);
		
		$.ajax({
			url: 'php/action/getTest.php',
			type: 'POST',
			data: {id: testId},
			success: function(data){
				// console.log(data);
				$('#editSpeedTestFormDevice').val(data.device_id);
				$('#editSpeedTestFormPosition').val(data.position_id);
				$('#editSpeedTestFormInternetDistance').val(data.internet_distance);
				
				$('#downloadSpeedLive').text(data.downloadSpeedMedian);
				$('#downloadSpeedAverage').text(data.downloadSpeedAverage);
				$('#downloadSpeedMedian').text(data.downloadSpeedMedian);
				$('#downloadSpeedMax').text(data.downloadSpeedMax);
				
				$('#uploadSpeedLive').text(data.uploadSpeedMedian);
				$('#uploadSpeedAverage').text(data.uploadSpeedAverage);
				$('#uploadSpeedMedian').text(data.uploadSpeedMedian);
				$('#uploadSpeedMax').text(data.uploadSpeedMax);
				
				$('#pingSpeedLive').text(data.pingSpeedMedian);
				$('#pingSpeedAverage').text(data.pingSpeedAverage);
				$('#pingSpeedMedian').text(data.pingSpeedMedian);
				$('#pingSpeedMin').text(data.pingSpeedMin);
				
				$('#editSpeedTestForm .delete-confirm').attr("href", "php/action/deleteTest.php?id="+testId);
				
				$('#editSpeedTestLoading').hide();
				$('#editSpeedTestForm').show();
			},
			error: function() {
				alert('Error.');
			}
		});
	});
	
	$('#editSpeedTestForm').submit(function() {
		if ($('.startSpeedTest').attr("disabled") == "disabled")
			alert("Please wait until finish checking speed");
		else if (ajaxRun == false) {
			ajaxRun = true;
			$('#editSpeedTestForm button[type=submit]').html('wait <i class="fa fa-refresh fa-spin"></i>');
			
			$.ajax({
				url: 'php/action/editSpeedTest.php',
				type: 'POST',
				data: {
					id: $('#editSpeedTestFormId').val(),
					device_id: $('#editSpeedTestFormDevice').val(),
					position_id: $('#editSpeedTestFormPosition').val(),
					internet_distance: $('#editSpeedTestFormInternetDistance').val(),
					downloadSpeedAverage: $('#downloadSpeedAverage').text(),
					downloadSpeedMedian: $('#downloadSpeedMedian').text(),
					downloadSpeedMax: $('#downloadSpeedMax').text(),
					uploadSpeedAverage: $('#uploadSpeedAverage').text(),
					uploadSpeedMedian: $('#uploadSpeedMedian').text(),
					uploadSpeedMax: $('#uploadSpeedMax').text(),
					pingSpeedAverage: $('#pingSpeedAverage').text(),
					pingSpeedMedian: $('#pingSpeedMedian').text(),
					pingSpeedMin: $('#pingSpeedMin').text()
				},
				success: function(data){
					$('#editSpeedTestForm button[type=submit]').html('Save <i class="fa fa-angle-double-right"></i>');
					if(data.status == 'success') {
						$('#editSpeedTestForm').html("<div class=\"modal-body text-center\">Success</div>");
						location.reload();
					} else if(data.status == 'error') {
						alert(data.msg.join());
					} else {
						alert('Error.');
					}
					ajaxRun = false;
				},
				error: function() {
					$('#editSpeedTestForm button[type=submit]').html('Save <i class="fa fa-angle-double-right"></i>');
					alert('Error.');
					ajaxRun = false;
				}
			});
			
		}
		return false;
	});
	
	$(".delete-confirm").click(function() {
		if (confirm("Are you sure you want to delete it?"))
			return true;
		else return false;
	});
	
});
