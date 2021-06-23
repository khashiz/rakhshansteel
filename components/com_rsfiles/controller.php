<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport('joomla.application.component.controller');

class rsfilesController extends JControllerLegacy
{
	/**
	 *	Main constructor
	 */
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 *	Set the captcha image
	 */
	public function captcha() {
		$config = rsfilesHelper::getConfig();
		
		if ($config->captcha_enabled == 1) {
			ob_end_clean();
			$captcha = new JSecurImage();
			
			$captcha->num_lines = $config->captcha_lines ? 8 : 0;
			$captcha_characters = $config->captcha_characters;
			$captcha->code_length = $captcha_characters;
			$captcha->image_width = 30*$captcha_characters + 50;
			$captcha->show();
		}
		die();
	}
	
	/**
	 *	Get content
	 */
	public function filepath() {
		rsfilesHelper::filepath();
	}
	
	/**
	 *	Method to display the preview
	 */
	public function preview() {
		$id = JFactory::getApplication()->input->getInt('id',0);
		return rsfilesHelper::preview($id);
	}
	
	public function approve() {
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$app	= JFactory::getApplication();
		$hash	= $app->input->getString('hash','');
		$where	= array();
		
		if ($moderation_email = rsfilesHelper::getMessage('moderate')) {
			if (!empty($moderation_email->to)) {
				if ($emails = explode(',',$moderation_email->to)) {
					
					$query->clear()
						->select($db->qn('IdFile'))->select($db->qn('FilePath'))
						->from($db->qn('#__rsfiles_files'))
						->where($db->qn('briefcase').' = 0')
						->where($db->qn('published').' = 0');
					
					foreach ($emails as $email) {
						$email	= trim($email);
						
						if (empty($email)) {
							continue;
						}
						
						$where[] = 'MD5(CONCAT('.$db->q($email).','.$db->qn('IdFile').')) = '.$db->q($hash);
					}
					
					if ($where) {
						$query->where(implode(' OR ',$where));
					}
					
					$db->setQuery($query);
					if ($file = $db->loadObject()) {
						$query->clear()
							->update($db->qn('#__rsfiles_files'))
							->set($db->qn('published').' = 1')
							->where($db->qn('IdFile').' = '.$db->q($file->IdFile));
						$db->setQuery($query);
						$db->execute();
						
						$app->enqueueMessage(JText::_('COM_RSFILES_FILE_APPROVED'));
						return $this->setRedirect(JRoute::_('index.php?option=com_rsfiles&layout=download&path='.rsfilesHelper::encode($file->FilePath),false));
					}
				}
			}
		}
		
		$app->enqueueMessage(JText::_('COM_RSFILES_FILE_APPROVED_ERROR'));
		return $this->setRedirect(JRoute::_('index.php?option=com_rsfiles',false));
	}
	
	public function cron() {
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$ds		= rsfilesHelper::ds();
		$limit	= 10;
		$step	= 1;
		
		// Get rules
		$query->select('*')
			->from($db->qn('#__rsfiles_rules'))
			->order($db->qn('ordering').' ASC');
		$db->setQuery($query);
		if ($rules = $db->loadObjectList()) {
			jimport('joomla.filesystem.folder');
			jimport('joomla.filesystem.file');
			
			// Get main download folder
			$download_folder = rsfilesHelper::getConfig('download_folder');
			
			if (!empty($download_folder)) {
				foreach ($rules as $rule) {
					$root = $download_folder. (!empty($rule->folder) ? $ds.$rule->folder : '');
					
					if (is_dir($root)) {
						
						// Parse folders
						if ($folders = JFolder::folders($root, '.', false, true, array('.htaccess'))) {
							foreach ($folders as $folder) {
								
								if ($step > $limit) break;
								
								if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
									$folder = str_replace('/',"\\",$folder);
								}
								
								$folder = str_replace($download_folder, '', $folder);
								$folder = trim($folder, $ds);
								
								// Check folder in database
								$query->clear()
									->select($db->qn('IdFile'))
									->from($db->qn('#__rsfiles_files'))
									->where($db->qn('FilePath').' = '.$db->q($folder));
								$db->setQuery($query);
								if (! (int) $db->loadResult()) {
									$query->clear()
										->insert($db->qn('#__rsfiles_files'))
										->set($db->qn('FileDescription').' = '.$db->q(''))
										->set($db->qn('metadescription').' = '.$db->q(''))
										->set($db->qn('metakeywords').' = '.$db->q(''))
										->set($db->qn('FileParent').' = '.$db->q(''))
										->set($db->qn('FilePath').' = '.$db->q($folder))
										->set($db->qn('DateAdded').' = '.$db->q(JFactory::getDate()->toSql()))
										->set($db->qn('DownloadMethod').' = 0')
										->set($db->qn('briefcase').' = 0')
										->set($db->qn('published').' = 1');
										
									$query->set($db->qn('CanView').' = '.$db->q($rule->FolderCanView));
									$query->set($db->qn('CanCreate').' = '.$db->q($rule->FolderCanCreate));
									$query->set($db->qn('CanUpload').' = '.$db->q($rule->FolderCanUpload));
									$query->set($db->qn('CanDelete').' = '.$db->q($rule->FolderCanDelete));
									
									$db->setQuery($query);
									$db->execute();
									
									$step++;
								}
							}
						}
						
						if ($step > $limit) return;
						
						// Parse files
						if ($files	= JFolder::files($root, '.', false, true, array('.htaccess'))) {
							foreach ($files as $file) {
								
								if ($step > $limit) break;
								
								if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
									$file = str_replace('/',"\\",$file);
								}
								
								$original	= $file;
								$file		= str_replace($download_folder, '', $file);
								$file		= trim($file, $ds);
								
								// Check file in database
								$query->clear()
									->select($db->qn('IdFile'))
									->from($db->qn('#__rsfiles_files'))
									->where($db->qn('FilePath').' = '.$db->q($file));
								$db->setQuery($query);
								if (! (int) $db->loadResult()) {
									$query->clear()
										->insert($db->qn('#__rsfiles_files'))
										->set($db->qn('FileDescription').' = '.$db->q(''))
										->set($db->qn('metadescription').' = '.$db->q(''))
										->set($db->qn('metakeywords').' = '.$db->q(''))
										->set($db->qn('FileParent').' = '.$db->q(''))
										->set($db->qn('FilePath').' = '.$db->q($file))
										->set($db->qn('DateAdded').' = '.$db->q(JFactory::getDate()->toSql()))
										->set($db->qn('DownloadMethod').' = '.$db->q($rule->DownloadMethod))
										->set($db->qn('briefcase').' = 0')
										->set($db->qn('IdLicense').' = '.$db->q($rule->IdLicense))
										->set($db->qn('FileStatistics').' = '.$db->q($rule->FileStatistics))
										->set($db->qn('show_preview').' = '.$db->q($rule->show_preview))
										->set($db->qn('DownloadLimit').' = '.$db->q($rule->DownloadLimit))
										->set($db->qn('published').' = 1')
										->set($db->qn('hash').' = '.$db->q(md5_file($original)));
									
									$query->set($db->qn('CanView').' = '.$db->q($rule->FileCanView));
									$query->set($db->qn('CanDownload').' = '.$db->q($rule->FileCanDownload));
									$query->set($db->qn('CanEdit').' = '.$db->q($rule->FileCanEdit));
									$query->set($db->qn('CanDelete').' = '.$db->q($rule->FileCanDelete));
									
									$db->setQuery($query);
									$db->execute();
									
									$step++;
								}
							}
						}
					}
				}
			}
		}
	}
}