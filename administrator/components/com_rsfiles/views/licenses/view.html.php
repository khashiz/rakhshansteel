<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class rsfilesViewLicenses extends JViewLegacy
{
	public function display($tpl = null) {
		$this->state 		= $this->get('State');
		$this->items 		= $this->get('Items');
		$this->pagination 	= $this->get('Pagination');
		$this->filterForm   = $this->get('FilterForm');
		
		$this->addToolBar();
		parent::display($tpl);
	}
	
	protected function addToolBar() {
		JToolBarHelper::title(JText::_('COM_RSFILES_LICENSES'),'rsfiles');
		JToolBarHelper::addNew('license.add');
		JToolBarHelper::editList('license.edit');
		JToolBarHelper::deleteList('','licenses.delete');
		JToolBarHelper::publishList('licenses.publish');
		JToolBarHelper::unpublishList('licenses.unpublish');
	}
}