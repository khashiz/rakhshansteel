<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class rsfilesViewRule extends JViewLegacy
{
	public function display($tpl = null) {
		$this->form 		= $this->get('Form');
		$this->item 		= $this->get('Item');

		$this->addToolBar();
		parent::display($tpl);
	}
	
	protected function addToolBar() {
		JToolBarHelper::title(JText::_('COM_RSFILES_ADD_EDIT_RULE','rsfiles'));
		JToolBarHelper::apply('rule.apply');
		JToolBarHelper::save('rule.save');
		JToolBarHelper::cancel('rule.cancel');
	}
}