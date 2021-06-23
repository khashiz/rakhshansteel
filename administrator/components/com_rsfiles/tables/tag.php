<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Application\ApplicationHelper;

class RsfilesTableTag extends JTable
{
	public function __construct($db) {
		parent::__construct('#__rsfiles_tags', 'id', $db);
	}
	
	public function store($updateNulls = false) {
		// New tag
		if (!$this->id && empty($this->created_by)) {
			$this->created_by = JFactory::getUser()->get('id');
		}
		
		// Verify that the title is unique
		$table = JTable::getInstance('Tag', 'RsfilesTable', array('dbo' => $this->getDbo()));
		if ($table->load(array('title' => $this->title)) && ($table->id != $this->id || $this->id == 0)) {
			throw new Exception(JText::_('COM_RSFILES_ERROR_TAG_UNIQUE'));
			return false;
		}
		
		return parent::store($updateNulls);
	}
	
	/**
	 * Method to delete a node and, optionally, its child nodes from the table.
	 *
	 * @param   integer  $pk        The primary key of the node to delete.
	 * @param   boolean  $children  True to delete child nodes, false to move them up a level.
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     http://docs.joomla.org/JTable/delete
	 * @since   2.5
	 */
	public function delete($pk = null, $children = false) {
		$db		= JFactory::getDBO();
		$query	= $db->getQuery(true);
		
		$query->clear()
			->delete($db->qn('#__rsfiles_tag_relation'))
			->where($db->qn('tag').' = '.(int) $pk);
		
		$db->setQuery($query);
		$db->execute();
		
		return parent::delete($pk, $children);
	}
}