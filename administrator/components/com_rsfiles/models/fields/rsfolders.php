<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('JPATH_PLATFORM') or die;

class JFormFieldRSFolders extends JFormField
{
	public $type = 'RSFolders';

	protected function getInput() {
		$html	= array();
		$script = array();
		
		// Build the script.
		$script[] = '	function jSelectFolder(path) {';
		$script[] = '		jQuery("#'.$this->id.'_id").val(path);';
		$script[] = '		jQuery("#'.$this->id.'_name").val(path);';
		$script[] = '		jQuery(\'#rsfFoldersModal\').modal(\'hide\');';
		$script[] = '	}';
		
		$script[] = '	function jDeselectFolder() {';
		$script[] = '		jQuery("#'.$this->id.'_id").val("");';
		$script[] = '		jQuery("#'.$this->id.'_name").val("'.JText::_('COM_RSFILES_DOWNLOAD_ROOT',true).'");';
		$script[] = '	}';

		// Add the script to the document head.
		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));
		
		$title = $this->value;

		if (empty($title)) {
			$title = JText::_('COM_RSFILES_DOWNLOAD_ROOT');
		}
		$title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
		
		$html[] = '<span class="input-append">';
		$html[] = '<input type="text" class="input-large" id="'.$this->id.'_name" value="'.$title.'" disabled="disabled" size="35" />';
		$html[] = '<a class="btn" title="'.JText::_('COM_RSFILES_CHANGE_DOWNLOAD_ROOT').'"  href="javascript:void(0)" onclick="jQuery(\'#rsfFoldersModal\').modal(\'show\');">';
		$html[] = '<i class="icon-file"></i> '.JText::_('JSELECT').'</a>';
		$html[] = '<a class="btn" title="'.JText::_('COM_RSFILES_CLEAR').'"  href="javascript:void(0)" onclick="jDeselectFolder();"><i class="icon-remove"></i></a>';
		$html[] = '</span>';

		// class='required' for client side validation
		$class = '';
		if ($this->required) {
			$class = ' class="required modal-value"';
		}

		$html[] = '<input type="hidden" id="'.$this->id.'_id"'.$class.' name="'.$this->name.'" value="'.$this->value.'" />';
		
		$html[] = JHtml::_('bootstrap.renderModal', 'rsfFoldersModal', array('title' => JText::_('COM_RSFILES_CONF_SET_DOWNLOAD_FOLDER'), 'url' => JRoute::_('index.php?option=com_rsfiles&view=files&layout=modal&tmpl=component&'.JSession::getFormToken().'=1', false), 'height' => 800, 'bodyHeight' => 70));
		return implode("\n", $html);
	}
}