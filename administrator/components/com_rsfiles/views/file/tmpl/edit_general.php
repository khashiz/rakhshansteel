<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access'); 

$fieldsets = array('general');
foreach ($fieldsets as $fieldset) {
	echo JHtml::_('rsfieldset.start', 'adminform', JText::_($this->fieldsets[$fieldset]->label));
	foreach ($this->form->getFieldset($fieldset) as $field) {
		$extension	= strtolower(rsfilesHelper::getExt($this->item->FilePath));
		
		$extra = '';
		if ($field->fieldname == 'FilePath') {
			$class = $this->item->type == 'local' ? 'far fa-hdd' : 'fas fa-external-link-alt';
			$extra = ' <span class="rs_extra"><i class="'.rsfilesHelper::tooltipClass().' '.$class.'" title="'.rsfilesHelper::tooltipText(JText::_(strtoupper('COM_RSFILES_FILE_TYPE_'.$this->item->type))).'"></i></span>';
		}
		
		if ($this->type != 'external' && $field->fieldname == 'DownloadName') {
			continue;
		}
		
		if ($this->briefcase) {
			if ($this->type == 'folder') {
				if (in_array($field->fieldname, array('publish_down', 'FileStatistics', 'FileVersion', 'IdLicense', 'DownloadMethod', 'DownloadLimit', 'tags')))
					continue;
			} else {
				if ($field->fieldname == 'publish_down' || $field->fieldname == 'FileStatistics' || $field->fieldname == 'DownloadMethod' || $field->fieldname == 'tags')
					continue;
			}
		} else {
			// Dont show specific fields if the path is a folder
			if ($this->type == 'folder' && in_array($field->fieldname, array('FileStatistics','FileVersion','IdLicense','DownloadMethod','DownloadLimit','show_preview', 'tags')))
				continue;
		
			if ($this->type == 'folder' && $field->fieldname == 'publish_down')
				continue;
		}
		
		echo JHtml::_('rsfieldset.element', $field->label, $field->input.$extra);
		
		if ($field->fieldname == 'FilePath' && $this->type != 'folder') {
			$icon	= 'fa fa-file';
			$ext	= $this->item->icon ? $this->item->icon : $extension;
			
			if (in_array($ext, rsfilesHelper::fileExtensions())) {
				$icon = 'flaticon-'.$ext.'-file';
			}
			
			echo JHtml::_('rsfieldset.element', '<label>'.JText::_('COM_RSFILES_FILE_ICON').'</label>', '<button type="button" onclick="jQuery(\'#rsfIcon\').modal(\'show\');" class="btn" id="file_icon"><i id="rsfiles-icon" class="'.$icon.'"></i></button>');
		}
		
		if ($field->fieldname == 'DownloadLimit') {
			if ($this->type == 'file' && !$this->briefcase) {
				$allowed	= array('mp3','ogg','mp4','mov','webm');
				
				if (in_array($extension, $allowed)) {
					if (empty($this->item->poster) || !file_exists(JPATH_SITE.'/components/com_rsfiles/images/poster/'.$this->item->poster)) {
						echo JHtml::_('rsfieldset.element', '<label for="poster" class="'.rsfilesHelper::tooltipClass().'" title="'.rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_POSTER_DESC')).'">'.JText::_('COM_RSFILES_FILE_POSTER').'</label>', '<input type="file" id="poster" name="poster" size="50" />');
					} else {
						$poster = JHTML::_('image', JURI::root().'components/com_rsfiles/images/poster/'.$this->item->poster.'?sid='.rand(), '','width="200" class="rsf_thumb" style="vertical-align: middle;"');
						$poster .= ' <a href="'.JRoute::_('index.php?option=com_rsfiles&task=file.deleteposter&id='.$this->item->IdFile).'">';
						$poster .= '<i class="fa fa-trash"></i>';
						$poster .= '</a>';
						
						echo JHtml::_('rsfieldset.element', '<label for="poster" class="'.rsfilesHelper::tooltipClass().'" title="'.rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_POSTER_DESC')).'">'.JText::_('COM_RSFILES_FILE_POSTER').'</label>', '<span class="rs_extra">'.$poster.'</span>');
					}
				}
			}
			
			if (empty($this->item->FileThumb) || !file_exists(JPATH_SITE.'/components/com_rsfiles/images/thumbs/files/'.$this->item->FileThumb)) {
				echo JHtml::_('rsfieldset.element', '<label for="thumb" class="'.rsfilesHelper::tooltipClass().'" title="'.rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_THUMB_DESC')).'">'.JText::_('COM_RSFILES_FILE_THUMB').'</label>', '<input type="file" id="thumb" name="thumb" size="50" />');
			} else {
				$thumb = JHTML::_('image', JURI::root().'components/com_rsfiles/images/thumbs/files/'.$this->item->FileThumb.'?sid='.rand(), '','class="rsf_thumb" style="vertical-align: middle;"');
				$thumb .= ' <a href="'.JRoute::_('index.php?option=com_rsfiles&task=file.deletethumb&id='.$this->item->IdFile).'">';
				$thumb .= '<i class="fa fa-trash"></i>';
				$thumb .= '</a>';
				
				echo JHtml::_('rsfieldset.element', '<label for="thumb" class="'.rsfilesHelper::tooltipClass().'" title="'.rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_THUMB_DESC')).'">'.JText::_('COM_RSFILES_FILE_THUMB').'</label>', '<span class="rs_extra">'.$thumb.'</span>');
			}
			
			if ($this->type != 'folder') {
				if (empty($this->item->preview) || !file_exists(JPATH_SITE.'/components/com_rsfiles/images/preview/'.$this->item->preview)) {
					$preview = '<input type="file" id="preview" name="preview" size="50" /> <br /><br />';
					$preview .= '<input type="checkbox" id="resize" name="resize" value="1" /> <label class="checkbox inline" for="resize">'.JText::_('COM_RSFILES_FILE_PREVIEW_RESIZE').'</label> <input type="text" value="200" class="input-mini" size="5" name="resize_width" /> px';
					echo JHtml::_('rsfieldset.element', '<label for="preview" class="'.rsfilesHelper::tooltipClass().'" title="'.rsfilesHelper::tooltipText(JText::sprintf('COM_RSFILES_FILE_PREVIEW_DESC',rsfilesHelper::previewExtensions(true))).'">'.JText::_('COM_RSFILES_FILE_PREVIEW').'</label>', '<span class="rs_extra">'.$preview.'</span>');
				} else {
					$properties = rsfilesHelper::previewProperties($this->item->IdFile);
					$preview = '<a href="javascript:void(0);" onclick="rsfiles_show_preview(\''.JRoute::_('index.php?option=com_rsfiles&task=preview&tmpl=component&id='.$this->item->IdFile,false).'\');">'.JText::_('COM_RSFILES_FILE_PREVIEW').'</a>';
					$preview .= ' / <a href="'.JRoute::_('index.php?option=com_rsfiles&task=file.deletepreview&id='.$this->item->IdFile).'">'.JText::_('COM_RSFILES_DELETE').'</a>';
					
					echo JHtml::_('rsfieldset.element', '<label for="preview" class="'.rsfilesHelper::tooltipClass().'" title="'.rsfilesHelper::tooltipText(JText::sprintf('COM_RSFILES_FILE_PREVIEW_DESC',rsfilesHelper::previewExtensions(true))).'">'.JText::_('COM_RSFILES_FILE_PREVIEW').'</label>', '<span class="rs_extra">'.$preview.'</span>');
				}
			}
		}	
	}
	
	echo JHtml::_('rsfieldset.end');
}

echo JHtml::_('bootstrap.renderModal', 'rsfPreviewModal', array('title' => JText::_('COM_RSFILES_FILE_PREVIEW'), 'bodyHeight' => 70));
if ($this->type != 'folder') {
	echo JHtml::_('bootstrap.renderModal', 'rsfIcon', array('title' => JText::_('COM_RSFILES_SELECT_FILE_ICON'), 'bodyHeight' => 70, 'modalWidth' => 40), $this->loadTemplate('icon')); 
}
?>

<script type="text/javascript">
function rsfiles_show_preview(url) {
	jQuery('#rsfPreviewModal .modal-body img').remove();
	jQuery('#rsfPreviewModal .modal-body').prepend('<img class="rsfiles-image-modal" src="'+ url +'" />');
	jQuery('#rsfPreviewModal').modal('show');
}
</script>