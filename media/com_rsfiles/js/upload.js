var rsfilesUploadForm;
var rsfilesXHR = [];
var rsfilesNames = [];
var RSFilesHelper = {};

jQuery.noConflict();
jQuery(document).ready(function($){
	
	RSFilesHelper = {
		_formatFileSize: function (bytes) {
			if (typeof bytes !== 'number') {
				return '';
			}
			if (bytes >= 1000000000) {
				return (bytes / 1000000000).toFixed(2) + ' GB';
			}
			if (bytes >= 1000000) {
				return (bytes / 1000000).toFixed(2) + ' MB';
			}
			return (bytes / 1000).toFixed(2) + ' KB';
		},
		
		_formatBitrate: function (bits) {
			if (typeof bits !== 'number') {
				return '';
			}
			if (bits >= 1000000000) {
				return (bits / 1000000000).toFixed(2) + ' Gbit/s';
			}
			if (bits >= 1000000) {
				return (bits / 1000000).toFixed(2) + ' Mbit/s';
			}
			if (bits >= 1000) {
				return (bits / 1000).toFixed(2) + ' kbit/s';
			}
			return bits.toFixed(2) + ' bit/s';
		},
		
		_formatTime: function (seconds) {
			var date = new Date(seconds * 1000),
				days = Math.floor(seconds / 86400);
			days = days ? days + 'd ' : '';
			return days +
				('0' + date.getUTCHours()).slice(-2) + ':' +
				('0' + date.getUTCMinutes()).slice(-2) + ':' +
				('0' + date.getUTCSeconds()).slice(-2);
		},
		
		_formatPercentage: function (floatValue) {
			return (floatValue * 100).toFixed(2) + ' %';
		},
		
		renderExtendedProgress: function (data) {
			return this._formatBitrate(data.bitrate) + ' | ' +
				this._formatTime(
					(data.total - data.loaded) * 8 / data.bitrate
				) + ' | ' +
				this._formatPercentage(
					data.loaded / data.total
				) + ' | ' +
				this._formatFileSize(data.loaded) + ' / ' +
				this._formatFileSize(data.total);
		},
		
		updateCounter: function (number) {
			total = parseInt($('#com-rsfiles-no-files > span').text()) + number;
			
			if (total > 0) {
				$('#com-rsfiles-add-files').css('display','none');
				$('#com-rsfiles-no-files').css('display','');
				$('#com-rsfiles-no-files > span').text(total);
			} else {
				$('#com-rsfiles-no-files > span').text(0);
				$('#com-rsfiles-add-files').css('display','');
				$('#com-rsfiles-no-files').css('display','none');
			}
		},
		
		checkAdvancedUpload: function() {
			var div = document.createElement('div');
			return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
		},
		
		isAdmin: function() {
			return document.location.toString().indexOf('/administrator/index.php') != -1;
		}
	};
	
	if (RSFilesHelper.checkAdvancedUpload()) {
		$('#com-rsfiles-drag-add-files').css('display', '');
	} else {
		$('#com-rsfiles-simple-add-files').css('display', '');
	}
	
	var uploadURL = RSFilesHelper.isAdmin() ? $('#siteroot').text() + 'administrator/index.php?option=com_rsfiles&task=files.upload' : $('#siteroot').text() + 'index.php?option=com_rsfiles&task=rsfiles.upload&from=' +  $('input[name="from"]').val()  + '&Itemid=' + $('#itemid').text();
	
	// Create the upload form
	rsfilesUploadForm = $('#rsfl_upload_form').fileupload({
		url: uploadURL,
		autoUpload: false,
		sequentialUploads: true,
		dataType: 'json',
		maxChunkSize: parseInt($('#chunk').val()),
		add: function (e, data) {
			if (e.isDefaultPrevented()) {
				return false;
			}
			
			if (data.files.length) {
				overwrite = $('#overwrite').is(':checked') ? 1 : 0;
				
				if (rsfilesNames.indexOf(data.files[0].name + data.files[0].size + overwrite) != -1) {
					data.abort();
				} else {
					rsfilesNames.push(data.files[0].name + data.files[0].size + overwrite);
					RSFilesHelper.updateCounter(1);
				}
			}
			
			rsfilesXHR.push(data);
			
			var $this = $(this);
			data.process(function () {
				return $this.fileupload('process', data);
			}).done(function () {
				$('#com-rsfiles-upload-files').on('click',function (e) {
					if (data.files.length > 0) {
						
						upload_files = true;
						
						data.submit().success(function (result, textStatus, jqXHR) {
							if (result && typeof result == 'object') {
								$('#com-rsfiles-upload-results').prepend($('<li>', {'class': result.success ? 'rs_success' : 'rs_error'}).html('<span class="fa fa-times com-rsfiles-close-message"></span>' + result.data.message));

								$('.com-rsfiles-close-message').on('click',function() {
									$(this).parent('li').hide('fast');
								});
								
								RSFilesHelper.updateCounter(-1);
							}
							
							data.files.splice(0,1);
						}).error(function (jqXHR, textStatus, errorThrown) {
							if (errorThrown === 'abort') {
								$(data.files).each(function(index) {
									var cancelURL = RSFilesHelper.isAdmin() ? $('#siteroot').text() + 'administrator/index.php?option=com_rsfiles&task=files.cancelupload' : $('#siteroot').text() + 'index.php?option=com_rsfiles&task=rsfiles.cancelupload';
									
									$.ajax({
										url: cancelURL,
										method: 'POST',
										dataType: 'json',
										data: {
											'file'	: data.files[index].filename,
											'from'	: $('input[name="from"]').val(),
											'folder': $('input[name="folder"]').val(),
											'path'	: $('input[name="FilePath"]').val(),
											'Itemid': $('#itemid').text()
										}
									});
								});
							}
						});
					}
				});
			}).fail(function () {
				if (data.files.error) {
					$(data.files).each(function(index) {
						if (data.files[index].error) {
							$('#com-rsfiles-upload-results').prepend($('<li>', {'class': 'rs_error'}).html('<span class="fa fa-times com-rsfiles-close-message"></span>' + data.files[index].error));
							$('.com-rsfiles-close-message').on('click',function() {
								$(this).parent('li').hide('fast');
							});
							
							RSFilesHelper.updateCounter(-1);
						}
					})
				}
			});
		},
		progressall: function (e, data) {
			var current = parseInt($('#com-rsfiles-bar').text());
			var progress = Math.floor(data.loaded / data.total * 100);
			
			if (progress > current) {			
				$('#com-rsfiles-progress').css('display', 'block');
				$('#com-rsfiles-progress .com-rsfiles-bar').css(
					'width',
					progress + '%'
				).html(progress + '%');

				if (!RSFilesHelper.isAdmin()) {
					$('#com-rsfiles-progress-info').css('display', '');
					$('#com-rsfiles-progress-info').html(RSFilesHelper.renderExtendedProgress(data));
				}
			}
		},
		start: function(e) {
			$('#com-rsfiles-upload-results li').remove();
			$('#com-rsfiles-upload-files').prop('disabled', true);
		},
		stop: function (e) {
			$('#com-rsfiles-progress .com-rsfiles-bar').css('width','100%').html('100%');
			$('#com-rsfiles-upload-files').prop('disabled', false);
			$('#overwrite').prop('checked', false);
			upload_files = false;

			rsfilesXHR = [];
			rsfilesNames = [];
			
			setTimeout(function() {
				$('#com-rsfiles-progress .com-rsfiles-bar').css('width','0%').html('0%');
				$('#com-rsfiles-progress-info').text('');
				$('#com-rsfiles-progress').css('display', 'none');
				$('#com-rsfiles-progress-info').css('display', 'none');
			}, 3000);
			
			if (RSFilesHelper.isAdmin()) {
				setTimeout(function(){
					window.parent.document.location.reload();
				}, 2000);
			}
		}
	}).on('fileuploadprocessstart', function () {
        $('#com-rsfiles-upload-text').text(Joomla.JText._('COM_RSFILES_PROCESS_START'));
		$('#com-rsfiles-upload-files').prop('disabled', true);
    }).on('fileuploadprocessstop', function () {
        $('#com-rsfiles-upload-text').text(Joomla.JText._('COM_RSFILES_START_UPLOAD'));
		$('#com-rsfiles-upload-files').prop('disabled', false);
    }).on('fileuploadsubmit', function (e, data) {
        if (data.files.length) {		
			if (RSFilesHelper.isAdmin()) {
				var CanDelete 	= $('select[name="CanDelete[]"]').val() || [];
				var CanEdit 	= $('select[name="CanEdit[]"]').val() || [];
				var CanView		= $('select[name="CanView[]"]').val() || [];
				var CanDownload = $('select[name="CanDownload[]"]').val() || [];
				var tags 		= $('select[name="tags[]"]').val() || [];
				CanDelete		= CanDelete.join(',');
				CanEdit			= CanEdit.join(',');
				CanView			= CanView.join(',');
				CanDownload		= CanDownload.join(',');
				tags			= tags.join(',');
				
				data.formData = {
					'published': 				$('input[name="published"]:checked').val(),
					'DateAdded': 				$('input[name="DateAdded"]').val(),
					'FileStatistics': 			$('input[name="FileStatistics"]:checked').val(),
					'show_preview': 			$('input[name="show_preview"]:checked').val(),
					'FileVersion': 				$('input[name="FileVersion"]').val(),
					'IdLicense': 				$('select[name="IdLicense"]').val(),
					'DownloadMethod': 			$('select[name="DownloadMethod"]').val(),
					'DownloadLimit': 			$('input[name="DownloadLimit"]').val(),
					'overwrite': 				$('input[name="overwrite"]:checked').val(),
					'path': 					$('input[name="FilePath"]').val(),
					'filename':					data.files[0].filename,
					'CanEdit': 					CanEdit,
					'CanDelete': 				CanDelete,
					'CanView': 					CanView,
					'CanDownload': 				CanDownload,
					'jform[tags]':				tags
				};
			} else {
				data.formData = {
					'overwrite'	: $('#overwrite').is(':checked') ? 1 : 0,
					'exists'	: data.files[0].exists,
					'filename'	: data.files[0].filename,
					'folder'	: $('input[name="folder"]').val()
				};
			}
		}
    });
	
	$('#com-rsfiles-cancel-upload').on('click', function(e) {
		for (i=0;i<rsfilesXHR.length;i++) {
			rsfilesXHR[i].abort();
			rsfilesXHR[i].files = [];
		}
		
		rsfilesNames = [];
		
		document.getElementById('rsfl_upload_form').reset();
		$('#com-rsfiles-add-files').css('display','');
		$('#com-rsfiles-no-files').css('display','none');
		$('#com-rsfiles-progress').css('display', 'none');
		$('#com-rsfiles-progress-info').css('display', 'none');
		$('#com-rsfiles-upload-results li').remove();
	});
});