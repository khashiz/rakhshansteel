<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.keepalive');
$current_path = !empty($this->current) ? '&path='.base64_encode($this->current) : ''; 

$ordering	= $this->escape($this->state->get('list.ordering','name'));
$direction	= $this->escape($this->state->get('list.direction','DESC')); ?>

<script type="text/javascript">
Joomla.submitbutton = function(task) {
	if (task == 'upload') {
		jQuery('#rsfUploadModal').modal('show');
		return false;
	} else if (task == 'synchronize'){
		if (confirm('<?php echo JText::_('COM_RSFILES_CONFIRM_SYNCHRONIZATION',true); ?>')) {
			RSFiles.Sync.steps  = [
				'checkFolders',
				'checkFiles',
				'checkDatabase'
			];
			RSFiles.Sync.start();
		} else return false;
	} else if (task == 'briefcase.add') {
		jQuery('#rsfBriefcaseModal').modal('show');
		return false;
	} else if (task == 'files.batch') {
		if (jQuery('#rscursive:checked').length) {		
			RSFiles.Sync.steps  = ['batchFiles'];
			RSFiles.Sync.type = 'batch';
			RSFiles.Sync.batchLimit = <?php echo (int) rsfilesHelper::getConfig('batch_limit', 10); ?>;
			RSFiles.Sync.parentFolder = "<?php echo addslashes($this->current); ?>";
			RSFiles.Sync.start();
		} else {
			Joomla.submitform(task);
		}
	} else {
		Joomla.submitform(task);
	}
}

function jSelectUser(what) {
	var id	 = jQuery(what).data('user-value');
	var name = jQuery(what).data('user-name');
	
	if (id == '') {
		jQuery('#rsfBriefcaseModal').modal('hide');
		return;
	}
	
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?option=com_rsfiles',
		data: 'task=files.briefcase&id=' + id + '&tmpl=component',
		dataType: 'json',
		success: function(response) {
			if (response.data.message != 'undefined') {
				alert(response.data.message);
			}
			
			if (response.success) {
				window.parent.location.reload();
			}
		}
	});
}

function change_root(val) {
	document.location = '<?php echo JURI::root(); ?>administrator/index.php?option=com_rsfiles&task=files.root&root='+val;
	return;
}
</script>

<form method="post" action="<?php echo JRoute::_('index.php?option=com_rsfiles&view=files'); ?>" name="adminForm" id="adminForm">
	<div class="row-fluid">
		<div id="j-sidebar-container" class="span2">
			<?php echo JHtmlSidebar::render(); ?>
		</div>
		<div id="j-main-container" class="span10 j-main-container">
			<div id="com-rsfiles-sync-progress" style="display:none;">
				<?php echo JHtml::image('com_rsfiles/loader.gif', '', array(), true); ?>
				<div id="com-rsfiles-sync-text"></div>
			</div>
			
			<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
			
			<div class="alert" style="display: none;" id="com-rsfiles-alert"></div>
			<div class="well">
				<div class="rsf_navigation">
					<?php echo $this->navigation; ?>
				</div>
				
				<?php if ($this->root != 'briefcase' || $this->current != $this->config->briefcase_folder) { ?>
				<div class="input-prepend rsf_new_folder">
					<input type="text" id="newfolder"  name="newfolder" class="input-large" value="" size="30" />
					<button type="button" class="btn btn-info button" onclick="rsf_create();"><?php echo JText::_('COM_RSFILES_CREATE'); ?></button>
				</div>
				<?php } ?>
			</div>
			
			<table class="table table-striped adminlist">
			<thead>
				<th width="1%" align="center" class="hidden-phone center"><input type="checkbox" name="checkall-toggle" id="rscheckbox" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this);"/></th>
				<th><?php echo JHtml::_('searchtools.sort', 'COM_RSFILES_FILES', 'name', $direction, $ordering); ?></th>
				<th class="center" align="center"><?php echo JHtml::_('searchtools.sort', 'COM_RSFILES_FILE_DATE_ADDED', 'date', $direction, $ordering); ?></th>
				
				<?php if (!$this->briefcase) { ?>
				<th class="center hidden-phone" align="center" width="1%"><?php echo JText::_('COM_RSFILES_FILES_REPORTS'); ?></th>
				<th class="center hidden-phone" align="center" width="1%"><?php echo JText::_('COM_RSFILES_FILES_STATISTICS'); ?></th>
				<?php } ?>
				
				<th class="center hidden-phone" align="center" width="1%"><?php echo JText::_('COM_RSFILES_FILES_EDIT'); ?></th>
				<th class="center hidden-phone" align="center" width="1%"><?php echo JText::_('JSTATUS'); ?></th>
			</thead>
			<tbody id="rsfiles_files">
				<?php foreach ($this->items as $i => $item) { ?>
					<tr class="row<?php echo $i % 2; ?>">
						<td class="center hidden-phone">
							<?php echo JHtml::_('grid.id', $i, $item->fullpath); ?>
						</td>
						
						<?php if ($item->type == 'folder') { ?>
						<td class="nowrap has-context">
							<i class="fa fa-folder"></i> 
							<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&view=files&folder='.$item->fullpath); ?>">
								<?php echo $item->name; ?>
							</a>  
							<?php echo !empty($item->filename) ? '<span class="rsf_fname"><i>('.$item->filename.')</i></span>' : '';?>
						</td>
						<td class="center hidden-phone" align="center"></td>
						
						<?php if (!$this->briefcase) { ?>
						<td class="center hidden-phone" align="center"></td>
						<td class="center hidden-phone" align="center"></td>
						<?php } ?>
						
						<td class="center hidden-phone" align="center">
							<?php $folderUrl = $item->id ? JRoute::_('index.php?option=com_rsfiles&task=file.edit&IdFile='.$item->id) : JRoute::_('index.php?option=com_rsfiles&task=file.edit&cid='.$item->fullpath); ?>
							<a href="<?php echo $folderUrl; ?>">
								<i class="fa fa-edit"></i>
							</a>
						</td>
						<?php } ?>
						
						<?php if($item->type == 'file' || $item->type == 'external') { ?>
						<td class="nowrap has-context">
							<?php $fileUrl = $item->id ? JRoute::_('index.php?option=com_rsfiles&task=file.edit&IdFile='.$item->id) : JRoute::_('index.php?option=com_rsfiles&task=file.edit&cid='.$item->fullpath); ?>
							<i class="fa fa-<?php echo $item->type == 'file' ? 'file' : 'external-link-square-alt'; ?>"></i>
							<a href="<?php echo $fileUrl; ?>">
								<?php echo $item->name; ?>
							</a>
							<?php if (!empty($item->filename)) { ?><span class="rsf_fname"><i>(<?php echo $item->filename;?>)</i></span><?php } ?>
							
							<div class="rsfiles-file-info">
							
								<?php if (!empty($item->fileversion)) { ?>
								<span class="badge hasTooltip" title="<?php echo JText::_('COM_RSFILES_FILES_VERSION'); ?>"><i class="fa fa-code-branch"></i> <?php echo $item->fileversion; ?></span>
								<?php } ?>
								
								<?php if (!empty($item->filelicense)) { ?>
								<span class="badge hasTooltip" title="<?php echo JText::_('COM_RSFILES_FILES_LICENSE'); ?>"><i class="fa fa-flag"></i> <?php echo $item->filelicense; ?></span>
								<?php } ?>
								
								<?php if (!empty($item->DownloadLimit)) { ?>
								<span class="badge hasTooltip" title="<?php echo JText::_('COM_RSFILES_FILES_HITS_LIMIT'); ?>"><i class="fa fa-download"></i> <?php echo $item->Downloads.' / '.$item->DownloadLimit; ?></span>
								<?php } ?>
							
								<?php if (!empty($item->hits)) { ?>
								<span class="badge hasTooltip" title="<?php echo JText::_('COM_RSFILES_HITS'); ?>"><i class="fa fa-eye"></i> <?php echo $item->hits; ?></span>
								<?php } ?>
							
							</div>
							
						</td>
						
						<td class="center" align="center"><?php echo $item->dateadded; ?></td>
						
						<?php if (!$this->briefcase) { ?>
						<td class="center hidden-phone" align="center">
							<a class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_REPORTS'),$item->reports); ?>" href="<?php echo JRoute::_('index.php?option=com_rsfiles&view=reports&id='.$item->fullpath); ?>">
								<i class="fa fa-info-circle"></i>
							</a>
						</td>
						
						<td class="center hidden-phone" align="center">
							<?php if($item->stats) { ?>
							<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&view=statistics&layout=view&id='.$item->id); ?>" target="_blank" title="<?php echo rsfilesHelper::tooltipText(JText::sprintf('COM_RSFILES_STATISTICS_VIEW_FOR',$item->name)); ?>" class="<?php echo rsfilesHelper::tooltipClass(); ?>">
								<i class="fa fa-chart-pie rsfiles-icon-green"></i>
							</a> 
							<?php } else { ?> 
							<a href="javascript:void(0)" onclick="statistics(<?php echo $i; ?>);" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_STATISTICS_NOT_ENABLED')); ?>" class="<?php echo rsfilesHelper::tooltipClass(); ?>">
								<i class="fa fa-chart-pie rsfiles-icon-red"></i>
							</a>
							<?php } ?>
						</td>
						<?php } ?>
						
						<td class="center hidden-phone" align="center">
							<a href="<?php echo $fileUrl; ?>">
								<i class="fa fa-edit"></i>
							</a>
						</td>
						<?php } ?>
						
						<td class="center hidden-phone" align="center">
							<?php echo JHtml::_('jgrid.published', $item->published, $i, 'files.'); ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="9" align="center"><?php echo $this->pagination->getListFooter(); ?></td>
				</tr>
			</tfoot>
		</table>
		</div>
	</div>
	
	<?php if (!$this->briefcase) { ?>
	<?php echo JHtml::_('bootstrap.renderModal', 'modal-batchfiles', array('title' => JText::_('COM_RSFILES_BATCH_FILES'), 'footer' => $this->loadTemplate('batch_footer'), 'bodyHeight' => 70), $this->loadTemplate('batch')); ?>
	<?php } ?>
	
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="path" id="path" value="<?php echo $this->current; ?>" />
	<input type="hidden" name="folder" value="<?php echo $this->folder; ?>" />
</form>

<?php echo JHtml::_('bootstrap.renderModal', 'rsfUploadModal', array('title' => JText::_('COM_RSFILES_UPLOAD_FILES'), 'url' => JRoute::_('index.php?option=com_rsfiles&view=files&layout=form&tmpl=component'.$current_path, false), 'height' => 700, 'bodyHeight' => 70)); ?>
<?php echo JHtml::_('bootstrap.renderModal', 'rsfBriefcaseModal', array('title' => JText::_('COM_RSFILES_UPLOAD_FILES'), 'url' => JRoute::_('index.php?option=com_users&view=users&layout=modal&tmpl=component&field=addusers', false), 'height' => 700, 'bodyHeight' => 70)); ?>