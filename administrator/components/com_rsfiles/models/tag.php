<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class RsfilesModelTag extends JModelAdmin
{
	protected $text_prefix = 'COM_RSFILES';
	
	public function getTable($type = 'Tag', $prefix = 'RsfilesTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true) {
		// Get the form.
		$form = $this->loadForm('com_rsfiles.tag', 'tag', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
			return false;
		
		return $form;
	}
	
	protected function loadFormData() {
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_rsfiles.edit.tag.data', array());

		if (empty($data))
			$data = $this->getItem();

		return $data;
	}
}