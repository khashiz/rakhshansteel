<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class rsfilesTableFile extends JTable
{

	/**
	 * @param	JDatabase	A database connector object
	 */
	public function __construct($db) {
		parent::__construct('#__rsfiles_files', 'IdFile', $db);
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
		if ($this->FileType) {
			$code = rsfilesHelper::externalStatus($this->FilePath);
			$contentType = rsfilesHelper::externalHeaders($this->FilePath,'Content-Type');
			$contentType = is_array($contentType) ? $contentType : array($contentType);
			
			foreach ($contentType as $i => $type) {
				if (strpos($type,'text/html') !== false) {
					unset($contentType[$i]);
				}
			}
			
			if (count($contentType) == 0) {
				$this->setError(JText::_('COM_RSFILES_EXTERNAL_INVALID_FILE'));
				return false;
			}
			
			if (!in_array(substr($code,0,1), array(2,3))) {
				$this->setError(JText::sprintf('COM_RSFILES_EXTERNAL_RESPONSE_CODE_ERROR', $code));
				return false;
			}
		}
		
		if (empty($this->IdFile) && $this->FileType == 1) {
			$this->DownloadName = empty($this->DownloadName) ? rsfilesHelper::getExternalName($this->FilePath) : $this->DownloadName;
		}
		
		if (JFactory::getApplication()->isClient('administrator')) {
			if (isset($this->ScreenshotsTags) && is_array($this->ScreenshotsTags)) {
				$this->ScreenshotsTags = implode(',',$this->ScreenshotsTags);
			} else $this->ScreenshotsTags = '';
			
			if (isset($this->CanCreate) && is_array($this->CanCreate)) {
				$this->CanCreate = implode(',',$this->CanCreate);
			} else $this->CanCreate = '';
			
			if (isset($this->CanUpload) && is_array($this->CanUpload)) {
				$this->CanUpload = implode(',',$this->CanUpload);
			} else $this->CanUpload = '';
			
			if (isset($this->CanDelete) && is_array($this->CanDelete)) {
				$this->CanDelete = implode(',',$this->CanDelete);
			} else $this->CanDelete = '';
			
			if (isset($this->CanEdit) && is_array($this->CanEdit)) {
				$this->CanEdit = implode(',',$this->CanEdit);
			} else $this->CanEdit = '';
			
			if (isset($this->CanDownload) && is_array($this->CanDownload)) {
				$this->CanDownload = implode(',',$this->CanDownload);
			} else $this->CanDownload = '';
			
			if (isset($this->CanView) && is_array($this->CanView)) {
				$this->CanView = implode(',',$this->CanView);
			} else $this->CanView = '';
		}
		
		if (!empty($this->IdFile)) {
			$this->ModifiedDate = JFactory::getDate()->toSql();
		}
		
		if ($this->FileType && (empty($this->DateAdded) || $this->DateAdded == JFactory::getDbo()->getNullDate()))
			$this->DateAdded = JFactory::getDate()->toSql();
		
		if (is_file($this->FilePath) && empty($this->IdFile)) {
			$this->hash = md5_file($this->FilePath);
			$this->FileSize = rsfilesHelper::formatBytes(rsfilesHelper::filesize($this->FilePath));
		}

		if ($this->FileType == 1) {
			$this->FileSize = rsfilesHelper::formatBytes(rsfilesHelper::externalHeaders($this->FilePath, 'Content-Length'));
		}
		
		$this->DownloadLimit = (int) $this->DownloadLimit;
		$this->publish_down = empty($this->publish_down) ? JFactory::getDbo()->getNullDate() : $this->publish_down;
		
		return true;
	}
}