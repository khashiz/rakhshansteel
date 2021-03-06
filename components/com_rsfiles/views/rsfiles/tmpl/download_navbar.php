<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<div class="navbar navbar-info">
	<div class="navbar-inner rsf_navbar">
		<a class="btn btn-navbar" id="rsf_navbar_btn" data-toggle="collapse" data-target=".rsf_navbar .nav-collapse"><i class="fa fa-arrow-down"></i></a>
		<a class="brand visible-tablet visible-phone" href="javascript:void(0)"><?php echo JText::_('COM_RSFILES_NAVBAR'); ?></a>
		<div class="nav-collapse collapse">
			<div class="nav pull-left">
				<ul class="nav rsf_navbar_ul">
					
					<?php if (!$this->briefcase) { ?>
					<li>
						<a class="btn <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_NAVBAR_HOME')); ?>" href="<?php echo JRoute::_('index.php?option=com_rsfiles'.$this->itemid); ?>">
							<span class="fa fa-home"></span>
						</a>
					</li>
					<?php } ?>
					
					<?php if ($this->user->get('id') > 0 && $this->config->enable_briefcase && !empty($this->config->briefcase_folder) && (rsfilesHelper::briefcase('CanDownloadBriefcase') || rsfilesHelper::briefcase('CanUploadBriefcase') || rsfilesHelper::briefcase('CanDeleteBriefcase') || rsfilesHelper::briefcase('CanMaintainBriefcase'))) { ?>
					<li>
						<a class="btn <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_NAVBAR_BRIEFCASE')); ?>" href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=briefcase'.$this->itemid); ?>">
							<span class="fa fa-briefcase"></span>
						</a>
					</li>
					<?php } ?>
					
					<?php if ($this->config->show_search && !$this->briefcase && !$this->tagMenu) { ?>
					<li>
						<a class="btn <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_NAVBAR_SEARCH')); ?>" href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=search'.$this->itemid); ?>">
							<span class="fa fa-search"></span>
						</a>
					</li>
					<?php } ?>
					
					<?php if ($this->config->show_details) { ?>
					<li>
						<a class="btn <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_NAVBAR_DETAILS')); ?>" href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=details'.($this->briefcase ? '&from=briefcase' : '').rsfilesHelper::getPath(true).($this->hash ? '&hash='.$this->hash : '').$this->itemid); ?>">
							<span class="fa fa-list"></span>
						</a>
					</li>
					<?php } ?>
					
					<?php if ($this->canedit) { ?>
					<li>
						<a class="btn <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_NAVBAR_EDIT')); ?>" href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=edit'.($this->briefcase ? '&from=briefcase' : '').rsfilesHelper::getPath(true).'&return='.base64_encode(JURI::getInstance()).$this->itemid); ?>">
							<span class="fa fa-edit"></span>
						</a>
					</li>
					<?php } ?>
					
					<?php if ($this->candelete) { ?>
					<li>
						<a class="btn <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_NAVBAR_DELETE')); ?>" href="<?php echo JRoute::_('index.php?option=com_rsfiles&task=rsfiles.delete'.($this->briefcase ? '&from=briefcase' : '').rsfilesHelper::getPath(true).$this->itemid); ?>" onclick="if (!confirm('<?php echo JText::_('COM_RSFILES_DELETE_FILE_MESSAGE',true); ?>')) return false;">
							<span class="fa fa-trash"></span>
						</a>
					</li>
					<?php } ?>
					
					<?php if (!$this->briefcase && $this->config->show_email) { ?>
					<?php require_once JPATH_SITE . '/components/com_mailto/helpers/mailto.php'; ?>
					<?php $template = $this->app->getTemplate(); ?>
					<?php $link     = $this->base . JRoute::_('index.php?option=com_rsfiles&layout=download'.rsfilesHelper::getPath(true).$this->itemid, false); ?>
					<?php $url      = 'index.php?option=com_mailto&tmpl=component&template=' . $template . '&link=' . MailToHelper::addLink($link); ?>
					<li>
						<a class="btn <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_NAVBAR_EMAIL')); ?>" href="<?php echo $url; ?>" onclick="window.open(this.href,'win2','width=400,height=350,menubar=yes,resizable=yes'); return false;">
							<span class="fa fa-envelope"></span>
						</a>
					</li>
					<?php } ?>
					
					<?php if (!$this->briefcase && $this->config->show_report) { ?>
					<li>
						<a class="btn <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_NAVBAR_REPORT')); ?>" href="javascript:void(0)" onclick="rsfiles_show_modal('<?php echo JRoute::_('index.php?option=com_rsfiles&layout=report&tmpl=component'.rsfilesHelper::getPath(true).$this->itemid); ?>', '&nbsp;' , 500);">
							<span class="fa fa-exclamation-triangle"></span>
						</a>
					</li>
					<?php } ?>
					
					<?php if ($this->candownload && $this->config->show_bookmark && !$this->file->FileType) { ?>
					<li>
						<a class="btn <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::isBookmarked($this->path) ? JText::_('COM_RSFILES_NAVBAR_FILE_IS_BOOKMARKED') : JText::_('COM_RSFILES_NAVBAR_BOOKMARK_FILE'); ?>" href="javascript:void(0);" onclick="rsf_bookmark('<?php echo JURI::root(); ?>','<?php echo $this->escape(addslashes($this->path)); ?>','<?php echo $this->briefcase ? 1 : 0; ?>','<?php echo $this->app->input->getInt('Itemid',0); ?>', this)">
							<i class="<?php echo rsfilesHelper::isBookmarked($this->path) ? 'fa' : 'far'; ?> fa-bookmark fa-fw"></i>
						</a>
					</li>
					<?php } ?>
					
					<li>
						<?php $backURL = $this->tagMenu ? JRoute::_('index.php?option=com_rsfiles&layout=tags') : JRoute::_('index.php?option=com_rsfiles'.($this->briefcase ? '&layout=briefcase' : '').$this->previous.$this->itemid); ?>
						<a class="btn <?php echo rsfilesHelper::tooltipClass(); ?>" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_NAVBAR_BACK')); ?>" href="<?php echo $backURL; ?>">
							<span class="fa fa-arrow-left"></span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="alert" id="rsf_alert" style="display:none;">
	<button type="button" class="close" onclick="document.getElementById('rsf_alert').style.display = 'none';">&times;</button>
	<span id="rsf_message"></span>
</div>