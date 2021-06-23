<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class rsfilesViewRules extends JViewLegacy
{
	public function display($tpl = null) {
		$this->state 		= $this->get('State');
		$this->items 		= $this->get('Items');
		$this->total 		= $this->get('Total');
		$this->pagination 	= $this->get('Pagination');
		$this->filterForm   = $this->get('FilterForm');
		
		$this->addToolBar();
		parent::display($tpl);
	}
	
	protected function addToolBar() {
		JToolBarHelper::title(JText::_('COM_RSFILES_RULES'),'rsfiles');
		JToolBarHelper::addNew('rule.add');
		JToolBarHelper::editList('rule.edit');
		JToolBarHelper::deleteList('','rules.delete');
	}
}