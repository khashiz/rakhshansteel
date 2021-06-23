<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class rsfilesModelRule extends JModelAdmin
{
	protected $text_prefix = 'COM_RSFILES';
	
	/**
	 * Returns a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 *
	 * @return	JTable	A database object
	*/
	public function getTable($type = 'Rule', $prefix = 'rsfilesTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
	
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 *
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true) {
		// Get the form.
		$form = $this->loadForm('com_rsfiles.rule', 'rule', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
			return false;
		
		return $form;
	}
	
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData() {
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_rsfiles.edit.rule.data', array());

		if (empty($data))
			$data = $this->getItem();

		return $data;
	}
	
	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 */
	public function getItem($pk = null) {
		if ($item = parent::getItem($pk)) {
			
			if (!empty($item->FolderCanCreate))		$item->FolderCanCreate = explode(',',$item->FolderCanCreate);
			if (!empty($item->FolderCanView))		$item->FolderCanView = explode(',',$item->FolderCanView);
			if (!empty($item->FolderCanUpload))		$item->FolderCanUpload = explode(',',$item->FolderCanUpload);
			if (!empty($item->FolderCanDelete))		$item->FolderCanDelete = explode(',',$item->FolderCanDelete);
			
			if (!empty($item->FileCanDelete))		$item->FileCanDelete = explode(',',$item->FileCanDelete);
			if (!empty($item->FileCanEdit))			$item->FileCanEdit = explode(',',$item->FileCanEdit);
			if (!empty($item->FileCanDownload))		$item->FileCanDownload = explode(',',$item->FileCanDownload);
			if (!empty($item->FileCanView))			$item->FileCanView = explode(',',$item->FileCanView);
		}
		
		return $item;
	}
}