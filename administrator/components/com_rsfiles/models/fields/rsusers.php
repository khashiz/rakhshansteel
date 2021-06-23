<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('JPATH_PLATFORM') or die;
JFormHelper::loadFieldClass('list');

class JFormFieldRSUsers extends JFormFieldList
{
	public $type = 'RSUsers';

	protected function getOptions() {
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$jinput = JFactory::getApplication()->input;
		$options= array();
		
		// Get the selected users
		$query->clear();
		$query->select('jusers');
		$query->from('#__rsfiles_groups');
		$query->where('IdGroup = '.$db->quote($jinput->getInt('IdGroup',0)));
		
		$db->setQuery($query);
		if ($users = $db->loadResult()) {
			$registry = new JRegistry;
			$registry->loadString($users);
			$users = $registry->toArray();
			$users =array_map('intval',$users);
			
			if (!empty($users)) {
				// Get the options
				$query->clear();
				$query->select($db->qn('id','value'))->select($db->qn('name','text'));
				$query->from($db->qn('#__users'));
				$query->where($db->qn('id').' IN ('.implode(',',$users).')');
				
				$db->setQuery($query);
				$options = $db->loadObjectList();
			}
		}
		
		return $options;
	}
}