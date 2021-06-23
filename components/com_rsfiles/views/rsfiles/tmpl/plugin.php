<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<div class="rsfiles-layout">
<div class="row-fluid">
	<div class="span12">
		<table class="rsf_files table table-striped table-condensed">
			<?php if ($this->params->get('header',1)) { ?>
			<thead>
				<tr>
					<th width="30%"><?php echo JText::_('COM_RSFILES_FILE_NAME'); ?></th>
					<?php if ($this->params->get('date')) { ?><th width="10%"><?php echo JText::_('COM_RSFILES_FILE_DATE'); ?></th><?php } ?>
					<th width="8%">&nbsp;</th>
				</tr>
			</thead>
			<?php } ?>
			<tbody>
				<?php if (!empty($this->items)) { ?>
				<?php foreach ($this->items as $i => $item) { ?>
				<?php $canDownload = rsfilesHelper::permissions('CanDownload',$item->fullpath); ?>
				<?php if (!empty($item->DownloadLimit) && $item->Downloads >= $item->DownloadLimit) $canDownload = false; ?>
				
				<tr class="row<?php echo $i % 2; ?>">
					<td class="rsfiles-download-info">
						<?php if ($item->type != 'folder') { ?>
							<?php $download = rsfilesHelper::downloadlink($item,$item->fullpath); ?>
							<?php if ($canDownload && $this->config->direct_download) { ?>
							<?php if ($download->ismodal) { ?>
							<a class="rsfiles-file" href="javascript:void(0)" onclick="rsfiles_show_modal('<?php echo $download->dlink; ?>', '<?php echo JText::_('COM_RSFILES_DOWNLOAD'); ?>', 600)">
							<?php } else { ?>
							<a class="rsfiles-file" href="<?php echo $download->dlink; ?>">
							<?php } ?>
							<?php } else { ?>
							<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=download&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="rsfiles-file">
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
							
							<?php if ($this->params->get('version') && !empty($item->fileversion)) { ?><span class="badge <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_VERSION')); ?>"><i class="fa fa-code-branch"></i> <?php echo $item->fileversion; ?></span><?php } ?>
							<?php if ($this->params->get('license') && !empty($item->filelicense)) { ?><span class="badge <?php echo rsfilesHelper::tooltipClass(); ?> badge-license" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_LICENSE')); ?>"><i class="fa fa-flag"></i> <?php echo $item->filelicense; ?></span><?php } ?>
							<?php if ($this->params->get('size') && !empty($item->size)) { ?><span class="badge <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_SIZE')); ?>"><i class="fa fa-file"></i> <?php echo $item->size; ?></span><?php } ?>
							<?php if ($this->config->list_show_downloads && !empty($item->downloads)) { ?><span class="badge <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_DOWNLOADS')); ?>"><i class="fa fa-download"></i> <?php echo $item->downloads; ?></span><?php } ?>
							
						<?php } else { ?>
							<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&folder='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>">
								<i class="rsfiles-file-icon fa fa-folder"></i> <?php echo (!empty($item->filename) ? $item->filename : $item->name); ?>
							</a>
						<?php } ?>
					</td>
					<?php if ($this->params->get('date')) { ?><td><?php if ($item->type != 'folder') echo $item->dateadded; ?></td><?php } ?>
					<td>
						<?php if ($item->type != 'folder') { ?>
						<?php if ($canDownload && $this->config->direct_download) { ?>
						<?php if ($download->ismodal) { ?>
						<a class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_DOWNLOAD')); ?>" href="javascript:void(0)" onclick="rsfiles_show_modal('<?php echo $download->dlink; ?>', '<?php echo JText::_('COM_RSFILES_DOWNLOAD'); ?>', 600);">
						<?php } else { ?>
						<a class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_DOWNLOAD')); ?>" href="<?php echo $download->dlink; ?>">
						<?php } ?>
						<?php } else { ?>
						<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=download&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_DOWNLOAD')); ?>">
						<?php } ?>
							<i class="fa fa-download fa-fw"></i>
						</a>
						
						<?php if ($this->config->show_details) { ?>
						<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=details&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_DETAILS')); ?>">
							<i class="fa fa-list fa-fw"></i>
						</a>
						<?php } ?>
						
						<?php if ($canDownload) { ?>
						<?php $properties	= rsfilesHelper::previewProperties($item->id, $item->fullpath); ?>
						<?php $extension	= $properties['extension']; ?>
						<?php $size			= $properties['size']; ?>
						
						<?php if (in_array($extension, rsfilesHelper::previewExtensions()) && $item->show_preview) { ?>
						<a href="javascript:void(0)" onclick="rsfiles_show_modal('<?php echo JRoute::_('index.php?option=com_rsfiles&layout=preview&tmpl=component&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>', '<?php echo JText::_('COM_RSFILES_PREVIEW'); ?>', <?php echo $size['height']; ?>, '<?php echo $properties['handler']; ?>');" class="<?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_PREVIEW')); ?>">
							<i class="fa fa-search fa-fw"></i>
						</a>
						<?php } ?>
						<?php } ?>
						
						<?php } ?>
					</td>
				</tr>
				<?php } ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
</div>

<?php if ($this->config->modal == 1) echo JHtml::_('bootstrap.renderModal', 'rsfRsfilesModal', array('title' => '', 'bodyHeight' => 70)); ?>