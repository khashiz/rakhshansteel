<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class rsfilesViewTags extends JViewLegacy
{
	public function display($tpl = null) {
		$this->items 		 = $this->get('Items');
		$this->pagination 	 = $this->get('Pagination');
		$this->state 		 = $this->get('State');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');
		
		$this->addToolBar();
		parent::display($tpl);		
	}
	
	protected function addToolBar() {
		JToolBarHelper::title(JText::_('COM_RSFILES_TAGS'),'rsfiles');
		
		JToolBarHelper::addNew('tag.add');
		JToolBarHelper::editList('tag.edit');
		JToolBarHelper::publishList('tags.publish');
		JToolBarHelper::unpublishList('tags.unpublish');
		JToolBarHelper::deleteList('COM_RSFILES_TAG_CONFIRM_DELETE','tags.delete');
	}
}