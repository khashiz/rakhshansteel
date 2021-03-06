<?php
/**
* @package RSComments!
* @copyright (C) 2015 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access');

class RscommentsViewEmoticons extends JViewLegacy
{
	public function display($tpl = null) {
		$this->items 		= $this->get('Items');
		
		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar() {
		JToolbarHelper::title(JText::_('COM_RSCOMMENTS_EMOTICONS'), 'rscomment');
		JToolbarHelper::addNew('emoticons.add');
		JToolbarHelper::preferences('com_rscomments');
		
		JHtml::script('com_rscomments/admin.js', array('relative' => true, 'version' => 'auto'));
	}
}