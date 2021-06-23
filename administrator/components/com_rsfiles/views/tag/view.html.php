<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class rsfilesViewTag extends JViewLegacy
{
	public function display($tpl = null) {		
		$this->form  = $this->get('Form');
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');

		$this->addToolbar();
		parent::display($tpl);		
	}
	
	protected function addToolbar() {
		JToolBarHelper::title(JText::_('COM_RSFILES_TAG_EDIT'),'rsfiles');
		
		JToolBarHelper::apply('tag.apply');
		JToolBarHelper::save('tag.save');
		JToolBarHelper::cancel('tag.cancel');
	}
}