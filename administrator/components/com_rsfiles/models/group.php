<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class rsfilesModelGroup extends JModelAdmin
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
	public function getTable($type = 'Group', $prefix = 'rsfilesTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
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
			try {			
				// Convert the Joomla groups field to an array.
				$registry = new JRegistry;
				$registry->loadString($item->jgroups);
				$item->jgroups = $registry->toArray();
			
				// Convert the Joomla users field to an array.
				$registry = new JRegistry;
				$registry->loadString($item->jusers);
				$item->jusers = $registry->toArray();
			} catch (Exception $e) {}
		}
		
		return $item;
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
		$form = $this->loadForm('com_rsfiles.group', 'group', array('control' => 'jform', 'load_data' => $loadData));
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
		$data = JFactory::getApplication()->getUserState('com_rsfiles.edit.group.data', array());

		if (empty($data))
			$data = $this->getItem();

		return $data;
	}
	
	/**
	 * Method to get the excluded Joomla! users.
	 */
	public function getExcludes() {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$excludes = array();
		$jinput = JFactory::getApplication()->input;
		
		$query->clear();
		$query->select($db->qn('jusers'))
			->from($db->qn('#__rsfiles_groups'))
			->where($db->qn('jusers').' <> '.$db->q(''))
			->where($db->qn('IdGroup').' <> '.$db->q($jinput->getInt('IdGroup',0)));
		
		$db->setQuery($query);
		if ($options = $db->loadColumn()) {
			foreach ($options as $option) {
				try {
					$registry = new JRegistry;
					$registry->loadString($option);
					$option = $registry->toArray();
					$option = array_map('intval',$option);
					$excludes = array_merge($excludes, $option);
				} catch (Exception $e) {}
			}
		}
		
		$excludes = array_unique($excludes);
		return !empty($excludes) ? $excludes : '';
	}
	
	/**
	 * Method to get the excluded Joomla! groups.
	 */
	public function getUsed() {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$used = array();
		$jinput = JFactory::getApplication()->input;
		
		$query->clear();
		$query->select($db->qn('jgroups'))
			->from($db->qn('#__rsfiles_groups'))
			->where($db->qn('jgroups').' <> '.$db->q(''))
			->where($db->qn('IdGroup').' <> '.$db->q($jinput->getInt('IdGroup',0)));
		
		$db->setQuery($query);
		if ($options = $db->loadColumn()) {
			foreach ($options as $option) {
				try {
					$registry = new JRegistry;
					$registry->loadString($option);
					$option = $registry->toArray();
					$option = array_map('intval',$option);
					$used = array_merge($used, $option);
				} catch (Exception $e) {}
			}
		}
		
		$used = array_unique($used);
		return !empty($used) ? $used : '';
	}
}