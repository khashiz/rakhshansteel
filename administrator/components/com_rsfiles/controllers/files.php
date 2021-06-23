<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.path');

class rsfilesControllerFiles extends JControllerLegacy
{
	/**
	 *	Main constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->registerTask('unpublish', 'publish');
	}
	
	/**
	 *	Method to set the files root
	 */
	public function root() {
		$session	= JFactory::getSession();
		$root		= JFactory::getApplication()->input->get('root','download');
		
		$session->set('rsfroot',$root);
		return $this->setRedirect('index.php?option=com_rsfiles&view=files');
	}
	
	
	/**
	 *	Method to sync folders
	 */
	public function checkFolders() {
		$model  	= $this->getModel('Files');
		$success 	= true;
		$data 		= new stdClass();
		$root		= rsfilesHelper::getConfig('download_folder');
		
		if (empty($root)) {
			$success = false;
			$data->message = JText::_('COM_RSFILES_NO_DOWNLOAD_FOLDER');
		} else {
			// grab the current folder for the input
			// if it's not specified, use the root folder
			$folder = JFactory::getApplication()->input->getString('folder', $root, 'none');
			$limit  = 10;
			
			$model->setOffsetLimit($limit);
			
			// this function returns the folders
			if ($folders = $model->getFoldersRecursive($folder)) {
				if (is_array($folders)) {
					foreach ($folders as $folder) {
						$model->syncFolder($folder);
					}
					if ($next_folder = end($folders)) {
						$data->next_folder = $next_folder;
					}
				} else {
					$data->stop = true;
				}
				
				$data->text = JText::_('COM_RSFILES_FOLDERS_SYNC');
			} else {
				$success = false;
				$data->message = $model->getError();
			}
		}
		
		rsfilesHelper::showResponse($success, $data);
	}
	
	/**
	 *	Method to sync files
	 */
	public function checkFiles() {
		$model  	= $this->getModel('Files');
		$success 	= true;
		$data 		= new stdClass();
		$root		= rsfilesHelper::getConfig('download_folder');
		
		if (empty($root)) {
			$success = false;
			$data->message = JText::_('COM_RSFILES_NO_DOWNLOAD_FOLDER');
		} else {
			$start 	= JFactory::getApplication()->input->getString('file', $root, 'none');
			$limit  = 10;
			
			$model->setOffsetLimit($limit);
			
			// this is so we know where to stop
			$files = $model->getFiles($root, false, false);
			$last_file = end($files);
			
			$files = $model->getFilesRecursive($start);
			
			if (is_array($files)) {
				foreach ($files as $file) {
					$model->syncFile($file);
				}
				
				$file = end($files);
				if (!count($files) || $file == $last_file) {
					$data->stop = true;
				} else {
					$data->next_file = $file;
				}
				$data->text = JText::_('COM_RSFILES_FILES_SYNC');
			} else {
				$success = false;
				$data->message = $model->getError();
			}
		}
		
		rsfilesHelper::showResponse($success, $data);
	}
	
	/**
	 *	Method to purge database
	 */
	public function checkDatabase() {
		$model	= $this->getModel('Files');
		
		// Purge database
		$model->purge();
		
		$data = new stdClass();
		$data->stop = true;
		$data->text = JText::_('COM_RSFILES_FILES_PURGE');
		
		rsfilesHelper::showResponse(true, $data);
	}
	
	/**
	 *	Method to extend permissions to subfolders
	 */
	public function checkExtendFolders() {
		$model  	= $this->getModel('Files');
		$success 	= true;
		$data 		= new stdClass();
		$root		= rsfilesHelper::root(true);
		
		// grab the current folder for the input
		// if it's not specified, use the root folder
		$folder = JFactory::getApplication()->input->getString('folder','');
		$stop	= JFactory::getApplication()->input->getString('stop', '');
		$limit  = 10;
		
		$model->setOffsetLimit($limit);
		$model->setStop($root.$stop);
		
		$fullpath  = $root.$folder;
		
		// this function returns the folders
		if ($folders = $model->getFoldersRecursive($fullpath)) {
			if (is_array($folders)) {
				foreach ($folders as $folder) {
					$model->extendFolder($folder);
				}
				if ($next_folder = end($folders)) {
					$data->next_folder = str_replace($root,'',$next_folder);
				}
			} else {
				$data->stop = true;
			}
			
			$data->text = JText::_('COM_RSFILES_EXTEND_FOR_FOLDERS');
		} else {
			$success = false;
			$data->message = $model->getError();
		}
		
		rsfilesHelper::showResponse($success, $data);
	}
	
	/**
	 *	Method to extend permissions to subfiles
	 */
	public function checkExtendFiles() {
		$model  	= $this->getModel('Files');
		$success 	= true;
		$data 		= new stdClass();
		$root		= rsfilesHelper::root(true);
		
		$start 	= JFactory::getApplication()->input->getString('file', '');
		$stop	= JFactory::getApplication()->input->getString('stop', '');
		$limit  = 10;
		
		$model->setOffsetLimit($limit);
		$model->setStop($root.$stop);
		
		// this is so we know where to stop
		$files = $model->getFiles($root.$stop, false, false);
		$last_file = end($files);
		
		$files = $model->getFilesRecursive($root.$start);
		
		if (is_array($files)) {
			foreach ($files as $file) {
				$model->extendFile($file);
			}
			
			$file = end($files);			
			if (!count($files) || $file == $last_file) {
				$data->stop = true;
			} else {
				$data->next_file = str_replace($root,'',$file);
			}
			$data->text = JText::_('COM_RSFILES_EXTEND_FOR_FILES');
		} else {
			$success = false;
			$data->message = $model->getError();
		}
		
		rsfilesHelper::showResponse($success, $data);
	}
	/**
	 *	Method to extend permissions to external files
	 */
	public function checkExtendExternal() {
		$model  	= $this->getModel('Files');
		$success 	= true;
		$data 		= new stdClass();
		$root		= rsfilesHelper::root(true);
		$folder		= JFactory::getApplication()->input->getString('folder', '');
		
		$model->extendExternal($folder);
		
		$data->stop = true;
		$data->text = JText::_('COM_RSFILES_EXTEND_FOR_EXTERNAL');
		
		rsfilesHelper::showResponse($success, $data);
	}
	
	public function batchFiles() {
		$model  	= $this->getModel('Files');
		$input		= JFactory::getApplication()->input;
		$db 		= JFactory::getDbo();
		$query		= $db->getQuery(true);
		$cids		= $input->get('cid', array(), 'array');
		$parent		= $input->getString('parent', '');
		$start		= $input->getInt('start', 0);
		$options	= $input->get('batch', array(), 'array');
		$success	= true;
		$limit		= (int) rsfilesHelper::getConfig('batch_limit', 10);
		$step		= 0;
		$data 		= new stdClass();
		$folders	= array();
		$files		= array();
		$external	= array();
		$root		= rsfilesHelper::getConfig('download_folder');
		
		if ($start) {
			// Start by knowing which files are first to get batched, and get all subfolders from the current path
			$parentFolders = array();
			
			foreach($cids as $cid) {
				$cid = urldecode($cid);
				if (is_file($parent.rsfilesHelper::ds().$cid) || rsfilesHelper::external($cid)) {
					$files[] = rsfilesHelper::external($cid) ? $cid : realpath($parent.rsfilesHelper::ds().$cid);
				} else {
					$parentFolders[] = realpath($parent.rsfilesHelper::ds().$cid);
					$folders[] = realpath($parent.rsfilesHelper::ds().$cid);
				}
			}
			
			// Get all folders recursive
			if ($parentFolders) {
				foreach ($parentFolders as $parentFolder) {
					if ($subfolders = $model->getFolders($parentFolder, true)) {
						$folders = array_merge($folders, $subfolders);
					}
				}
			}
			
			// Add folders from the begining of the batch
			if ($prevFolders = $input->get('folders', array(), 'array')) {
				foreach ($prevFolders as $folder) {
					$folders[] = urldecode($folder);
				}
			}
		} else {
			$folders	= $input->get('folders', array(), 'array');
			$limitstart	= $input->getInt('lstart', 0);
			
			// Let's parse the files from our folders
			if (isset($folders[0])) {
				if ($folderFiles = $model->getFiles(urldecode($folders[0]))) {
					$files	= array_slice($folderFiles, $limitstart, $limit);
					$step	= $limitstart + $limit;
				}
				
				// If we do not have any more files to batch in this folder, we remove the folder
				if (empty($files)) {
					// Get folder path, for external files
					$folderPath = str_replace($root.rsfilesHelper::ds(), '', urldecode($folders[0]));
					
					$query->clear()
						->select($db->qn('IdFile'))
						->from($db->qn('#__rsfiles_files'))
						->where($db->qn('FileParent').' = '.$db->q($folderPath));
					$db->setQuery($query);
					$external = $db->loadColumn();
					
					$model->batch(array($folderPath));
					unset($folders[0]);
					$folders = array_merge($folders, array());
					$step = 0;
				}
			}
		}
		
		// Batch files
		if ($files) {
			foreach ($files as $i => $file) {
				if (!rsfilesHelper::external($file)) {
					$files[$i] = str_replace(realpath($parent).rsfilesHelper::ds(), '', realpath($file));
				}
			}
			
			$model->batch($files);
		}
		
		// Batch external files
		if ($external) {
			$model->batch($external);
		}
		
		if (empty($folders) && empty($files)) {
			$data->stop = true;
		} else {
			$data->folders = $folders;
			$data->step = $step;
			$data->parent = $parent;
		}
		
		rsfilesHelper::showResponse($success, $data);
	}
	
	/**
	 *	Method to publish / unpublish files.
	 */
	public function publish() {
		// Check for request forgeries
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		// Get items to publish from the request.
		$cid = JFactory::getApplication()->input->get('cid', array(), 'array');
		$data = array('publish' => 1, 'unpublish' => 0);
		$task = $this->getTask();
		$value = isset($data[$task]) ? (int) $data[$task] : 0;
		
		// Get the model.
		$model = $this->getModel('Files');
		
		if (!$model->publish($cid, $value)) {
			$this->setMessage($model->getError(),'error');
		} else {
			if ($value == 1) {
				$ntext = 'COM_RSFILES_FILES_N_ITEMS_PUBLISHED';
			} else {
				$ntext = 'COM_RSFILES_FILES_N_ITEMS_UNPUBLISHED';
			}
			
			$this->setMessage(JText::plural($ntext, count($cid)));
		}
		
		$root = rsfilesHelper::getConfig(rsfilesHelper::getRoot().'_folder');
		$path = JFactory::getApplication()->input->getString('path','');
		
		if ($path != $root) {
			$path = str_replace($root.rsfilesHelper::ds(),'',$path);
		} else {
			$path = '';
		}
		
		$pathURL = ($path) ? '&folder=' . urlencode($path) : '';
		$this->setRedirect(JRoute::_('index.php?option=com_rsfiles&view=files'.$pathURL, false));
	}
	
	/**
	 *	Method to create a new folder.
	 */
	public function create() {
		// Get the model.
		$model		= $this->getModel('Files');
		$folder 	= JFactory::getApplication()->input->getString('folder','');
		$data 		= new stdClass();
		$success	= true;
		
		if (!$model->create($folder)) {
			$success = false;
			$data->message = $model->getError();
		} else {
			$data->message = JText::_('COM_RSFILES_NEW_FOLDER_CREATED');
		}
		
		rsfilesHelper::showResponse($success, $data);
	}
	
	/**
	 *	Method to remove a file/folder.
	 */
	public function delete() {
		// Get the model.
		$model	= $this->getModel('Files');
		$cid 	= JFactory::getApplication()->input->get('cid',array(),'array');
		
		if (!$model->delete($cid)) {
			$this->setMessage($model->getError(),'error');
		} else {
			$this->setMessage(JText::plural('COM_RSFILES_FILES_N_ITEMS_DELETED', count($cid)));
		}
		
		$root = rsfilesHelper::getConfig(rsfilesHelper::getRoot().'_folder');
		$path = JFactory::getApplication()->input->getString('path','');
		
		if ($path != $root) {
			$path = str_replace($root.rsfilesHelper::ds(),'',$path);
		} else {
			$path = '';
		}
		
		$pathURL = ($path) ? '&folder=' . urlencode($path) : '';
		$this->setRedirect(JRoute::_('index.php?option=com_rsfiles&view=files'.$pathURL, false));
	}
	
	/**
	 *	Enable statistics for files
	 */
	public function statistics() {
		// Check for request forgeries
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		// Get model
		$model	= $this->getModel('Files');
		
		$cid	= JFactory::getApplication()->input->get('cid',array(),'array');
		
		// Enable statistics
		if (!$model->statistics($cid)) {
			$this->setMessage($model->getError(),'error');
		} else {
			$this->setMessage(JText::_('COM_RSFILES_FILES_STATISTICS_ENABLED'));
		}
		
		$path = JFactory::getApplication()->input->getString('path','');
		$root = rsfilesHelper::getConfig(rsfilesHelper::getRoot().'_folder');
		
		if ($path != $root) {
			$path = str_replace($root.rsfilesHelper::ds(),'',$path);
		} else {
			$path = '';
		}
		
		$pathURL = ($path) ? '&folder=' . urlencode($path) : '';
		$this->setRedirect(JRoute::_('index.php?option=com_rsfiles&view=files'.$pathURL, false));
	}
	
	/**
	 *	Check file
	 */
	public function checkupload() {
		// Get model
		$model		= $this->getModel('Files');
		$success 	= true;
		$data 		= new stdClass();
		
		if (!$model->checkupload()) {
			$success = false;
			$data->message = $model->getError();
		} else {
			$data->message	= $model->getState('success.message');
			$data->exists	= (int) $model->getState('perform.insert');
			$data->filename	= $model->getState('file.name');
		}
		
		rsfilesHelper::showResponse($success, $data);
	}
	
	/**
	 *	Upload files
	 */
	public function upload() {
		// Get model
		$model		= $this->getModel('Files');
		$success 	= true;
		$data 		= new stdClass();
		
		if (!$model->upload()) {
			$success = false;
			$data->message = $model->getError();
		} else {
			$data->message = $model->getState('success.message');
		}
		
		rsfilesHelper::showResponse($success, $data);
	}
	
	/**
	 *	Cancel uploaded file
	 */
	public function cancelupload() {
		// Get model
		$model		= $this->getModel('Files');
		$success 	= true;
		
		if (!$model->cancelupload()) {
			$success = false;
		}
		
		rsfilesHelper::showResponse($success);
	}
	
	/**
	 *	Create a new briefcase folder
	 */
	public function briefcase() {
		// Get model
		$model		= $this->getModel('Files');
		$id			= JFactory::getApplication()->input->getInt('id',0);
		$success 	= true;
		$data 		= new stdClass();
		
		if (!$model->briefcase($id)) {
			$success = false;
			$data->message = $model->getError();
		} else {
			$data->message = JText::_('COM_RSFILES_BRIEFCASE_CREATED');
		}
		
		rsfilesHelper::showResponse($success, $data);
	}
	
	/**
	 * Method to run batch operations.
	 *
	 * @param   object  $model  The model.
	 * @return  boolean   True if successful, false otherwise and internal error is set.
	 * @since   1.6
	 */
	public function batch() {
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Set the model
		$model	= $this->getModel('Files');
		$pks    = JFactory::getApplication()->input->get('cid', array(), 'array');
		$folder = JFactory::getApplication()->input->get('folder','');
		$folder = $folder ? '&folder='.$folder : '';
		
		if (!$model->batch($pks)) {
			throw new Exception($model->getError(), 500);
		} else {
			JFactory::getApplication()->enqueueMessage(JText::_('COM_RSFILES_BATCH_COMPLETED'));
		}
		
		// Preset the redirect
		$this->setRedirect('index.php?option=com_rsfiles&view=files'.$folder);
	}
}