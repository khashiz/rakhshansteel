<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class rsfilesViewEmail extends JViewLegacy
{
	public function display($tpl = null) {
		$this->form			= $this->get('Form');
		$this->type			= $this->get('Type');
		$this->types		= $this->get('Types');
		
		if (!in_array($this->type,$this->types)) {
			JFactory::getApplication()->close();
		}
		
		parent::display($tpl);
	}
}