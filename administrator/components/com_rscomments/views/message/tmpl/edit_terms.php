<?php
/**
* @package RSComments!
* @copyright (C) 2015 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access');
	
echo JHtml::_('rsfieldset.start', 'adminform', JText::_($this->fieldsets['terms']->label));
foreach ($this->form->getFieldset('terms') as $field) 
	echo JHtml::_('rsfieldset.element', $field->label, $field->input);
echo JHtml::_('rsfieldset.end');