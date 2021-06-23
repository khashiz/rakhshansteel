<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$candelete = rsfilesHelper::briefcase('CanDeleteBriefcase') || rsfilesHelper::briefcase('CanMaintainBriefcase') ? 1 : 0; ?>

<?php if ($this->params->get('show_page_heading') != 0) { ?>
<div class="page-header">
	<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
</div>
<?php } ?>

<div class="rsfiles-layout">
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->loadTemplate('navbar'); ?>
		
		<?php if (($this->config->show_pagination_position == 0 || $this->config->show_pagination_position == 2) && $this->pagination->pagesTotal > 1) { ?>
		<div class="pagination">
			<p class="counter pull-right">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
		<?php } ?>
		
		<?php if ((!$this->maintenance && $this->briefcase_root != $this->config->briefcase_folder) || ($this->maintenance && $this->current != $this->config->briefcase_folder)) { ?>
		<div class="well">
			<div class="span8">
				<?php if ($this->config->show_folder_desc == 1 && !empty($this->fdescription)) { ?>
				<?php echo $this->fdescription; ?>
				<?php } ?>
			</div>
			
			<?php if(($this->maintenance && !empty($this->folder)) || !$this->maintenance) { ?>
			<div class="span4">
				<b class="rsf_briefcase_name"><?php echo JText::_('COM_RSFILES_BRIEFCASE_FILES'); ?></b> <?php echo $this->curentfilesno; ?> / <?php echo $this->maxfilesno; ?> <br />
				<b class="rsf_briefcase_name"><?php echo JText::_('COM_RSFILES_BRIEFCASE_QUOTA'); ?></b> <?php echo $this->currentquota; ?> / <?php echo $this->maxfilessize; ?> Mb
				<?php $percentage = (ceil($this->currentquota/$this->maxfilessize*100) <= 100 ? ceil($this->currentquota/$this->maxfilessize*100) : '100'); ?>
				<?php $class = $percentage >= 90 ? 'progress-danger' : ''; ?>
				<div class="progress <?php echo $class; ?>">
					<div class="bar" style="width: <?php echo $percentage; ?>%;">&nbsp;</div>
				</div>
			</div>
			<?php } ?>
			<div class="clearfix"></div>
		</div>
		<?php } ?>
		
		<form action="<?php echo htmlentities(JURI::getInstance(), ENT_COMPAT, 'UTF-8'); ?>" method="post" id="adminForm" name="adminForm">
			<table class="rsf_files table table-striped">
				<thead>
					<tr>
						<th width="30%"><?php echo JHtml::_('grid.sort', 'COM_RSFILES_FILE_NAME', 'name', $this->listDirn, $this->listOrder); ?></th>
						<?php if ($this->config->list_show_date) { ?><th width="10%"><?php echo JHtml::_('grid.sort', 'COM_RSFILES_FILE_DATE', 'date', $this->listDirn, $this->listOrder); ?></th><?php } ?>
						<th width="10%">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($this->items)) { ?>
					<?php foreach ($this->items as $i => $item) { ?>
					<?php if (!empty($item->DownloadLimit) && $item->Downloads >= $item->DownloadLimit) $this->download = false; ?>
					
					<tr class="row<?php echo $i % 2; ?>">
						<td class="rsfiles-download-info">
							<?php $thumbnail = rsfilesHelper::thumbnail($item); ?>
							<?php if ($item->type != 'folder') { ?>
								<?php $download = rsfilesHelper::downloadlink($item,$item->fullpath); ?>
								<?php if ($this->download && $this->config->direct_download) { ?>
								<?php if ($download->ismodal) { ?>
								<a class="rsfiles-file <?php echo $thumbnail->class; ?>" href="javascript:void(0)" onclick="rsfiles_show_modal('<?php echo $download->dlink; ?>','<?php echo JText::_('COM_RSFILES_DOWNLOAD'); ?>',600);" title="<?php echo $thumbnail->image; ?>">
								<?php } else { ?>
								<a class="rsfiles-file <?php echo $thumbnail->class; ?>" href="<?php echo $download->dlink; ?>" title="<?php echo $thumbnail->image; ?>">
								<?php } ?>
								
								<?php } else { ?>
								<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=download&from=briefcase&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="rsfiles-file <?php echo $thumbnail->class; ?>" title="<?php echo $thumbnail->image; ?>">
								<?php } ?>
									<i class="rsfiles-file-icon <?php echo $item->icon; ?>"></i> <?php echo (!empty($item->filename) ? $item->filename : $item->name); ?>
								</a> 
								
								<br />
								
								<?php if ($item->isnew) { ?>
									<span class="badge badge-info"><?php echo JText::_('COM_RSFILES_NEW'); ?></span>
								<?php } ?>
								
								<?php if ($item->popular) { ?>
									<span class="badge badge-success"><?php echo JText::_('COM_RSFILES_POPULAR'); ?></span>
								<?php } ?>
								
								<?php if ($this->config->list_show_version && !empty($item->fileversion)) { ?><span class="badge <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_VERSION')); ?>"><i class="fa fa-code-branch"></i> <?php echo $item->fileversion; ?></span><?php } ?>
								<?php if ($this->config->list_show_license && !empty($item->filelicense)) { ?><span class="badge <?php echo rsfilesHelper::tooltipClass(); ?> badge-license" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_LICENSE')); ?>"><i class="fa fa-flag"></i> <?php echo $item->filelicense; ?></span><?php } ?>
								<?php if ($this->config->list_show_size && !empty($item->size)) { ?><span class="badge <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_SIZE')); ?>"><i class="fa fa-file"></i> <?php echo $item->size; ?></span><?php } ?>
								
							<?php } else { ?>
								<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=briefcase&folder='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="<?php echo $thumbnail->class; ?>" title="<?php echo $thumbnail->image; ?>">
									<i class="rsfiles-file-icon fa fa-folder"></i> <?php echo (!empty($item->filename) ? $item->filename : $item->name); ?>
								</a>
							<?php } ?>
						</td>
						<?php if ($this->config->list_show_date) { ?><td><?php if ($item->type != 'folder') echo $item->dateadded; ?></td><?php } ?>
						<td>
							<?php if ($item->type != 'folder') { ?>
							<?php if ($this->download && $this->config->direct_download) { ?>
							<?php if ($download->ismodal) { ?>
							<a class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_DOWNLOAD')); ?>" href="javascript:void(0)" onclick="rsfiles_show_modal('<?php echo $download->dlink; ?>','<?php echo JText::_('COM_RSFILES_DOWNLOAD'); ?>',600);">
							<?php } else { ?>
							<a class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_DOWNLOAD')); ?>" href="<?php echo $download->dlink; ?>">
							<?php } ?>
							<?php } else { ?>
							<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=download&from=briefcase&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_DOWNLOAD')); ?>">
							<?php } ?>
								<i class="fa fa-download fa-fw"></i>
							</a>
							
							<?php if ($this->config->show_details) { ?>
							<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=details&from=briefcase&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_DETAILS')); ?>">
								<i class="fa fa-list fa-fw"></i>
							</a>
							<?php } ?>
							
							<?php $properties	= rsfilesHelper::previewProperties($item->id, $item->fullpath); ?>
							<?php $extension	= $properties['extension']; ?>
							<?php $size			= $properties['size']; ?>
							
							<?php if (in_array(strtolower($extension), rsfilesHelper::previewExtensions()) && $item->show_preview) { ?>
							<a href="javascript:void(0)" onclick="rsfiles_show_modal('<?php echo JRoute::_('index.php?option=com_rsfiles&layout=preview&from=briefcase&tmpl=component&path='.rsfilesHelper::encode($item->fullpath).$this->itemid, false); ?>','<?php echo JText::_('COM_RSFILES_PREVIEW'); ?>', <?php echo $size['height']; ?>, '<?php echo $properties['handler']; ?>');" class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_PREVIEW')); ?>">
								<i class="fa fa-search fa-fw"></i>
							</a>
							
							<?php } ?>
							
							<?php if (($this->download || $this->maintenance) && $this->config->show_bookmark && !$item->FileType) { ?>
							<a href="javascript:void(0);" class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::isBookmarked($item->fullpath) ? JText::_('COM_RSFILES_NAVBAR_FILE_IS_BOOKMARKED') : JText::_('COM_RSFILES_NAVBAR_BOOKMARK_FILE'); ?>" onclick="rsf_bookmark('<?php echo JURI::root(); ?>','<?php echo $this->escape(addslashes(urldecode($item->fullpath))); ?>','<?php echo $this->briefcase ? 1 : 0; ?>','<?php echo $this->app->input->getInt('Itemid',0); ?>', this)">
								<i class="<?php echo rsfilesHelper::isBookmarked($item->fullpath) ? 'fa' : 'far'; ?> fa-bookmark fa-fw"></i>
							</a>
							<?php } ?>
							
							<?php if ($candelete) { ?>
							<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&task=rsfiles.delete&from=briefcase&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_NAVBAR_DELETE')); ?>" onclick="if (!confirm('<?php echo JText::_('COM_RSFILES_DELETE_FILE_MESSAGE',true); ?>')) return false;">
								<i class="fa fa-trash fa-fw"></i>
							</a>
							<?php } ?>
							
							<?php } else { ?>

								<?php if ($candelete) { ?>
								<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&task=rsfiles.delete&from=briefcase&folder='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_NAVBAR_DELETE')); ?>" onclick="if (!confirm('<?php echo JText::_('COM_RSFILES_DELETE_MESSAGE',true); ?>')) return false;">
									<i class="fa fa-trash fa-fw"></i>
								</a>
								<?php } ?>
								
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
					<?php } else { ?>
					<tr>
						<td colspan="3"><?php echo JText::_('COM_RSFILES_NO_FILES'); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="filter_order" value="<?php echo $this->escape($this->listOrder); ?>" />
			<input type="hidden" name="filter_order_Dir" value="<?php echo $this->escape($this->listDirn); ?>" />
		</form>
		
		<?php if (($this->config->show_pagination_position == 1 || $this->config->show_pagination_position == 2) && $this->pagination->pagesTotal > 1) { ?>
		<div class="pagination">
			<p class="counter pull-right">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
		<?php } ?>
	</div>
</div>
</div>

<?php if ($this->config->modal == 1) echo JHtml::_('bootstrap.renderModal', 'rsfRsfilesModal', array('title' => '', 'bodyHeight' => 70)); ?>