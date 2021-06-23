<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.file');

class rsfilesViewFiles extends JViewLegacy
{	
	public function display($tpl = null) {
		$layout					= $this->getLayout();
		$app					= JFactory::getApplication();
		$this->config			= rsfilesHelper::getConfig();
		$this->root				= rsfilesHelper::getRoot();
		$this->briefcase		= $this->root == 'briefcase';
		
		if ($layout == 'form') {
			$this->form		= $this->get('Form');
			$this->path		= $app->input->getString('path','');
			$this->path		= base64_decode($this->path);
			$this->single	= $app->input->getInt('single',0);
			
			// Safari on Windows has a bug and reports a file size of 0 bytes when selecting multiple files.
			if (rsfilesHelper::isSafariWin()) {
				$this->single = 1;
			}
			
			$uri = JUri::getInstance();
			$uri->setVar('single',1);
			$this->singleupload = $uri->toString();
			
			if ((!empty($this->path) && strpos($this->path, $this->config->{$this->root.'_folder'}) !== 0) || empty($this->config->{$this->root.'_folder'})) {
				$app->close();
			}
			
			$this->addScripts();
		} else {
			$this->folder			= $app->input->getString('folder','');
			$this->from				= $app->input->getString('from','');
			$this->current 			= $this->get('Current');
			
			$this->state			= $this->get('State');
			$this->items			= $this->get('Data');
			$this->total			= $this->get('Total');
			$this->pagination		= $this->get('Pagination');
			$this->navigation		= $this->get('Navigation');
			$this->form				= $this->get('BatchForm');
			$this->filterForm    	= $this->get('FilterForm');
			$this->editor			= $app->input->getString('editor');
			
			$this->addToolBar();
		}
		
		parent::display($tpl);
	}
	
	protected function addToolBar() {
		JToolBarHelper::title(JText::_('COM_RSFILES_FILES'),'rsfiles');
		
		if ($this->root != 'briefcase' || $this->current != $this->config->briefcase_folder) {
			JToolBarHelper::custom('upload', 'upload', 'upload', JText::_('COM_RSFILES_UPLOAD_FILES'), false);
			
			if ($this->root != 'briefcase')
				JToolBarHelper::addNew('file.add');
		}
		
		// In the main briefcase folder
		if ($this->current == $this->config->briefcase_folder) {
			JToolBarHelper::addNew('briefcase.add');
		}
		
		JToolBarHelper::editList('file.edit');
		JToolBarHelper::deleteList('COM_RSFILES_FILES_DELETE_INFO','files.delete');
		JToolBarHelper::publishList('files.publish');
		JToolBarHelper::unpublishList('files.unpublish');
		
		if ($this->root != 'briefcase') {
			JToolBarHelper::custom('synchronize','cogs','cogs',JText::_('COM_RSFILES_SYNCHRONIZE_FILES'),false);
			JToolBarHelper::custom('files.statistics','pie','pie',JText::_('COM_RSFILES_ENABLE_STATISTICS'),true);
		}
		
		if ($this->root != 'briefcase') {
			$layout = new JLayoutFile('joomla.toolbar.popup');
			$dhtml = $layout->render(array('text' => JText::_('COM_RSFILES_BATCH'), 'class' => 'icon-checkbox-partial', 'name' => 'batchfiles', 'doTask' => ''));
			JToolbar::getInstance('toolbar')->appendButton('Custom', $dhtml, 'batch');
		}
	}
	
	protected function addScripts() {
		JHtml::_('jquery.ui');
		
		JHtml::script('com_rsfiles/jquery.iframe-transport.js', array('relative' => true, 'version' => 'auto'));
		JHtml::script('com_rsfiles/jquery.fileupload.js', array('relative' => true, 'version' => 'auto'));
		JHtml::script('com_rsfiles/jquery.fileupload-process.js', array('relative' => true, 'version' => 'auto'));
		JHtml::script('com_rsfiles/upload.js', array('relative' => true, 'version' => 'auto'));
	}
}