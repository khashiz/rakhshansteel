<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access'); ?>

<script type="text/javascript">
	google.load('visualization', '1', {packages: ['corechart', 'bar']});
	
	<?php if (!empty($this->stats)) { ?>
	google.setOnLoadCallback(drawDownloadsChart);
	function drawDownloadsChart() {
		var data = google.visualization.arrayToDataTable(
			<?php echo json_encode($this->stats)."\n"; ?>
		);

		var options = { vAxis: {'format' : '0'}, legend: { position: 'none' } };
		var chart = new google.visualization.ColumnChart(document.getElementById('rsfiles-downloads-chart'));
		chart.draw(data, options);
	}
	<?php } ?>
	
	<?php if (!empty($this->hits)) { ?>
	google.setOnLoadCallback(drawHitsChart);
	function drawHitsChart() {
		var data = google.visualization.arrayToDataTable(
			<?php echo json_encode($this->hits)."\n"; ?>
		);

		var view = new google.visualization.DataView(data);
		view.setColumns([0,1, { calc: "stringify", sourceColumn: 1, type: 'string', role: 'annotation' } ]);
		
		var options = { vAxis: {'format' : '0'}, bar: {groupWidth: "95%"}, legend: { position: 'none' } };
		var chart = new google.visualization.BarChart(document.getElementById('rsfiles-hits-chart'));
		chart.draw(view, options);
	}
	<?php } ?>
	
	function rsfiles_downloads_chart() {
		jQuery('#rsfiles-downloads-loading').css('display','');
		jQuery.ajax({
			url: 'index.php?option=com_rsfiles',
			type: 'post',
			dataType : 'html',
			data: 'task=stats&from=' + jQuery('#from').val() + '&to=' + jQuery('#to').val(),
			success: function(response) {
				jQuery('#rsfiles-downloads-loading').css('display','none');
				
				if (jQuery.parseJSON(response).length == 0) {
					jQuery('#rsfiles-downloads-alert').css('display','');
					jQuery('#rsfiles-downloads-chart').css('display','none');
				} else {
					jQuery('#rsfiles-downloads-alert').css('display','none');
					jQuery('#rsfiles-downloads-chart').css('display','');
					var data = google.visualization.arrayToDataTable(jQuery.parseJSON(response));
					var options = { vAxis: {'format' : '0'}, legend: { position: 'none' } };
					var chart = new google.visualization.ColumnChart(document.getElementById('rsfiles-downloads-chart'));
					chart.draw(data, options);
				}
			}
		});
	}
	
	function rsfiles_hits_chart() {
		jQuery('#rsfiles-hits-loading').css('display','');
		jQuery.ajax({
			url: 'index.php?option=com_rsfiles',
			type: 'post',
			dataType : 'html',
			data: 'task=hits&limit=' + jQuery('#top').val(),
			success: function(response) {
				jQuery('#rsfiles-hits-loading').css('display','none');
				
				if (jQuery.parseJSON(response).length == 0) {
					jQuery('#rsfiles-hits-alert').css('display','');
					jQuery('#rsfiles-hits-chart').css('display','none');
				} else {
					jQuery('#rsfiles-hits-alert').css('display','none');
					jQuery('#rsfiles-hits-chart').css('display','');
					var data = google.visualization.arrayToDataTable(jQuery.parseJSON(response));
					var view = new google.visualization.DataView(data);
					view.setColumns([0,1, { calc: "stringify", sourceColumn: 1, type: 'string', role: 'annotation' } ]);
					
					var options = { vAxis: {'format' : '0'}, bar: {groupWidth: "95%"}, legend: { position: 'none' } };
					var chart = new google.visualization.BarChart(document.getElementById('rsfiles-hits-chart'));
					chart.draw(view, options);
				}
			}
		});
	}
</script>

<div class="row-fluid">
	<div class="span8">
		<div class="dashboard-container">
			<div class="row-fluid">
				<div class="span4">
					<div class="dashboard-wraper">
						<div class="dashboard-content"> 
						<a href="index.php?option=com_rsfiles&amp;view=files">
							<i class="far fa-folder-open fa-4x"></i>
							<span class="dashboard-title"><?php echo JText::_('COM_RSFILES_SUBMENU_FILES'); ?></span>
						</a>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="dashboard-wraper">
						<div class="dashboard-content"> 
						<a href="index.php?option=com_rsfiles&amp;view=tags">
							<i class="fa fa-tags fa-4x"></i>
							<span class="dashboard-title"><?php echo JText::_('COM_RSFILES_SUBMENU_TAGS'); ?></span>
						</a>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="dashboard-wraper">
						<div class="dashboard-content"> 
							<div class="dashboard-content">
								<a href="index.php?option=com_rsfiles&amp;view=licenses">
									<i class="far fa-list-alt fa-4x"></i>
									<span class="dashboard-title"><?php echo JText::_('COM_RSFILES_SUBMENU_LICENSES'); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<div class="dashboard-wraper">
						<div class="dashboard-content"> 
							<div class="dashboard-content">
								<a href="index.php?option=com_rsfiles&amp;view=groups">
									<i class="far fa-user fa-4x"></i>
									<span class="dashboard-title"><?php echo JText::_('COM_RSFILES_SUBMENU_GROUPS'); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="dashboard-wraper">
						<div class="dashboard-content"> 
							<div class="dashboard-content">
								<a href="index.php?option=com_rsfiles&amp;view=statistics">
									<i class="far fa-chart-bar fa-4x"></i>
									<span class="dashboard-title"><?php echo JText::_('COM_RSFILES_SUBMENU_STATISTICS'); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="dashboard-wraper">
						<div class="dashboard-content"> 
							<div class="dashboard-content">
								<a href="index.php?option=com_rsfiles&amp;view=rules">
									<i class="far fa-registered fa-4x"></i>
									<span class="dashboard-title"><?php echo JText::_('COM_RSFILES_SUBMENU_CRON_RULES'); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<div class="dashboard-wraper">
						<div class="dashboard-content"> 
							<div class="dashboard-content">
								<a href="index.php?option=com_rsfiles&amp;view=settings">
									<i class="fa fa-bars fa-4x"></i>
									<span class="dashboard-title"><?php echo JText::_('COM_RSFILES_SUBMENU_SETTINGS'); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="span4">
		<div class="dashboard-container">
			<div class="dashboard-info">
				<span>
					<?php echo JHtml::image('com_rsfiles/rsfiles_logo.png', 'RSFiles!', array('align' => 'middle'), true); ?>
				</span>
				<table class="dashboard-table">
					<tr>
						<td nowrap="nowrap" align="right"><strong><?php echo JText::_('COM_RSFILES_INSTALLED_VERSION') ?> </strong></td>
						<td colspan="2"><b>RSFiles! <?php echo $this->version; ?></b></td>
					</tr>
					<tr>
						<td nowrap="nowrap" align="right"><strong><?php echo JText::_('COM_RSFILES_COPYRIGHT') ?> </strong></td>
						<td nowrap="nowrap">&copy; 2010 - <?php echo gmdate('Y'); ?> <a href="http://www.rsjoomla.com" target="_blank">RSJoomla.com</a></td>
					</tr>
					<tr>
						<td nowrap="nowrap" align="right"><strong><?php echo JText::_('COM_RSFILES_LICENSE') ?> </strong></td>
						<td nowrap="nowrap">GPL Commercial License</td>
					</tr>
					<tr>
						<td nowrap="nowrap" align="right"><strong><?php echo JText::_('COM_RSFILES_UPDATE_CODE') ?> </strong></td>
						<?php if (strlen($this->code) == 20) { ?>
						<td class="correct-code"><?php echo $this->escape($this->code); ?></td>
						<?php } elseif ($this->code) { ?>
						<td class="incorrect-code"><strong><?php echo $this->escape($this->code);?></strong>
							<br />
							<strong><a href="http://www.rsjoomla.com/support/documentation/view-article/767-where-do-i-find-my-license-code-.html" target="_blank"><?php echo JText::_('COM_RSFILES_WHERE_DO_I_FIND_THIS'); ?></a></strong>
						</td>
						<?php } else { ?>
						<td class="missing-code">
							<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&view=settings'); ?>"><?php echo JText::_('COM_RSFILES_PLEASE_ENTER_YOUR_CODE_IN_THE_CONFIGURATION'); ?></a>
							<br />
							<strong><a href="http://www.rsjoomla.com/support/documentation/view-article/767-where-do-i-find-my-license-code-.html" target="_blank"><?php echo JText::_('COM_RSFILES_WHERE_DO_I_FIND_THIS'); ?></a></strong>
						</td>
						<?php } ?>
					</tr>
				</table>
			</div>
		</div>
		
		<br />
		
		<div class="dashboard-container">
			<div class="dashboard-info">
				<table class="dashboard-table">
					<tr>
						<td align="left"><strong><?php echo !empty($this->download) ? realpath($this->download) : JText::_('COM_RSFILES_SELECT_DOWNLOAD_FOLDER'); ?></strong></td>
						<td colspan="2">
							<?php if (!empty($this->download)) { ?>
							<?php $dld_writable = is_writable(realpath($this->download)); ?>
							<span class="badge badge-<?php echo $dld_writable ? 'success' : 'important';?>">
								<?php echo $dld_writable ? JText::_('COM_RSFILES_WRITABLE') : JText::_('COM_RSFILES_NOT_WRITABLE'); ?>
							</span>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td align="left"><strong><?php echo !empty($this->briefcase) ? realpath($this->briefcase) : JText::_('COM_RSFILES_SELECT_BRIEFCASE_FOLDER'); ?></strong></td>
						<td colspan="2">
							<?php if (!empty($this->briefcase)) { ?>
							<?php $dld_writable = is_writable(realpath($this->briefcase)); ?>
							<span class="badge badge-<?php echo $dld_writable ? 'success' : 'important';?>">
								<?php echo $dld_writable ? JText::_('COM_RSFILES_WRITABLE') : JText::_('COM_RSFILES_NOT_WRITABLE'); ?>
							</span>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td align="left"><strong><?php echo realpath(JPATH_SITE.'/components/com_rsfiles/images'); ?></strong></td>
						<td colspan="2">
							<?php $image_writable = is_writable(realpath(JPATH_SITE.'/components/com_rsfiles/images')); ?>
							<span class="badge badge-<?php echo $image_writable ? 'success' : 'important';?>">
								<?php echo $image_writable ? JText::_('COM_RSFILES_WRITABLE') : JText::_('COM_RSFILES_NOT_WRITABLE'); ?>
							</span>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span6">
		<div class="dashboard-container">
			<div class="dashboard-info">
				<h3><?php echo JText::_('COM_RSFILES_CHART_DOWNLOADS'); ?></h3>
				<table class="dashboard-table">
					<tr>
						<td align="right">
							<div class="pull-right rsfiles-chart-filter">
								<?php echo JHtml::_('calendar', $this->to, 'to', 'to', '%Y-%m-%d', array('class' => 'input-small', 'onChange' => 'rsfiles_downloads_chart();', 'placeholder' => JText::_('COM_RSFILES_TO'))); ?>
							</div>
							
							<div class="pull-right rsfiles-chart-filter">
								<?php echo JHtml::_('calendar', $this->from, 'from', 'from', '%Y-%m-%d', array('class' => 'input-small', 'onChange' => 'rsfiles_downloads_chart();', 'placeholder' => JText::_('COM_RSFILES_FROM'))); ?>
							</div>
							
							<div class="pull-right rsfiles-chart-filter">
								<?php echo JHtml::image('com_rsfiles/loading.gif', '', array('id' => 'rsfiles-downloads-loading', 'style' => 'display: none;'), true); ?>
							</div>
						</td>
					</tr>
				</table>
				<div class="alert alert-danger" id="rsfiles-downloads-alert" style="display: <?php echo !empty($this->stats) ? 'none' : 'block'; ?>;">
					<button type="button" class="close" onclick="document.getElementById('rsfiles-downloads-alert').style.display = 'none';">&times;</button>
					<?php echo JText::_('COM_RSFILES_CHART_NO_DATA'); ?>
				</div>
				<div class="row-fluid" id="rsfiles-downloads-chart"></div>
			</div>
		</div>
	</div>
	<div class="span6">
		<div class="dashboard-container">
			<div class="dashboard-info">
				<h3><?php echo JText::_('COM_RSFILES_CHART_HITS'); ?></h3>
				<table class="dashboard-table">
					<tr>
						<td style="float: right;">
							<?php echo JHtml::image('com_rsfiles/loading.gif', '', array('id' => 'rsfiles-hits-loading', 'style' => 'display: none;'), true); ?>
							<select name="top" id="top" style="width: 100px" onchange="rsfiles_hits_chart()">
								<option value="5"><?php echo JText::_('COM_RSFILES_CHART_HITS_TOP_5'); ?></option>
								<option selected="selected" value="10"><?php echo JText::_('COM_RSFILES_CHART_HITS_TOP_10'); ?></option>
								<option value="15"><?php echo JText::_('COM_RSFILES_CHART_HITS_TOP_15'); ?></option>
								<option value="20"><?php echo JText::_('COM_RSFILES_CHART_HITS_TOP_20'); ?></option>
							</select>
						</td>
					</tr>
				</table>
				<div class="rsf_clear"></div>
				<div class="alert alert-danger" id="rsfiles-hits-alert" style="display: <?php echo !empty($this->hits) ? 'none' : 'block'; ?>;">
					<button type="button" class="close" onclick="document.getElementById('rsfiles-hits-alert').style.display = 'none';">&times;</button>
					<?php echo JText::_('COM_RSFILES_CHART_NO_HITS_DATA'); ?>
				</div>
				<div class="row-fluid" id="rsfiles-hits-chart"></div>
			</div>
		</div>
	</div>
</div>