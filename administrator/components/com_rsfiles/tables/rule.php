<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class rsfilesTableRule extends JTable
{	
	/**
	 * @param	JDatabase	A database connector object
	 */
	public function __construct($db) {
		parent::__construct('#__rsfiles_rules', 'id', $db);
	}
	
	/**
	 * Method to perform sanity checks on the JTable instance properties to ensure
	 * they are safe to store in the database.  Child classes should override this
	 * method to make sure the data they are storing in the database is safe and
	 * as expected before storage.
	 *
	 * @return  boolean  True if the instance is sane and able to be stored in the database.
	 *
	 * @link    http://docs.joomla.org/JTable/check
	 * @since   11.1
	 */
	public function check() {
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$query->select($db->qn('id'))
			->from($db->qn('#__rsfiles_rules'))
			->where($db->qn('folder').' = '.$db->q($this->folder))
			->where($db->qn('id').' <> '.$db->q($this->id));
		$db->setQuery($query);
		if ((int) $db->loadResult()) {
			$this->setError(JText::_('COM_RSFILES_RULE_ALREADY_EXISTS'));
			return false;
		}
		
		// Set ordering
		if (empty($this->id)) {
			$this->ordering = self::getNextOrder();
		}
		
		$this->FileCanView		= isset($this->FileCanView) && is_array($this->FileCanView) ? implode(',',$this->FileCanView) : '';
		$this->FileCanDownload	= isset($this->FileCanDownload) && is_array($this->FileCanDownload) ? implode(',',$this->FileCanDownload) : '';
		$this->FileCanEdit		= isset($this->FileCanEdit) && is_array($this->FileCanEdit) ? implode(',',$this->FileCanEdit) : '';
		$this->FileCanDelete	= isset($this->FileCanDelete) && is_array($this->FileCanDelete) ? implode(',',$this->FileCanDelete) : '';
		$this->FolderCanView	= isset($this->FolderCanView) && is_array($this->FolderCanView) ? implode(',',$this->FolderCanView) : '';
		$this->FolderCanCreate	= isset($this->FolderCanCreate) && is_array($this->FolderCanCreate) ? implode(',',$this->FolderCanCreate) : '';
		$this->FolderCanUpload	= isset($this->FolderCanUpload) && is_array($this->FolderCanUpload) ? implode(',',$this->FolderCanUpload) : '';
		$this->FolderCanDelete	= isset($this->FolderCanDelete) && is_array($this->FolderCanDelete) ? implode(',',$this->FolderCanDelete) : '';
		
		return true;
	}
}