<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
JText::script('COM_RSFILES_BRIEFCASE_NAME_INFO');

$fieldsets = array('general');
foreach ($fieldsets as $fieldset) {
	echo JHtml::_('rsfieldset.start', 'adminform', JText::_($this->fieldsets[$fieldset]->label));
	foreach ($this->form->getFieldset($fieldset) as $field) {
		$extra = $field->fieldname == 'remove_days' ? '<span class="rsf_text_conf"> '.JText::_('COM_RSFILES_CONF_DAYS').'</span>' : '';
		
		echo JHtml::_('rsfieldset.element', $field->label, $field->input.$extra);
		
		if ($field->fieldname == 'briefcase_name') 
			echo JHtml::_('rsfieldset.element', '<label for="jform_overwrite_briefcase_name">'.JText::_('COM_RSFILES_BRIEFCASE_NAME_OVERWRITE').'</label>', '<input type="checkbox" onclick="rsf_alert_briefcase_name(this)" name="overwrite_briefcase_name" id="jform_overwrite_briefcase_name" value="1" />');
		
	}
	echo JHtml::_('rsfieldset.end');
}