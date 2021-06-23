<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class RsfilesModelTags extends JModelList
{
	public function __construct($config = array()) {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				't.title', 't.created_by',
				't.published', 'u.username', 'published'
			);
		}

		parent::__construct($config);
	}
	
	protected function getListQuery() {
		$db 	= JFactory::getDBO();
		$query 	= $db->getQuery(true);
		
		// Select fields
		$query->select('t.*');
		$query->select($db->qn('u.username'));
		
		// Select from table
		$query->from($db->qn('#__rsfiles_tags','t'));
		
		// Join the users table
		$query->join('LEFT',$db->qn('#__users','u').' ON '.$db->qn('t.created_by').' = '.$db->qn('u.id').'');
		
		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			$search = $db->Quote('%'.$db->escape($search, true).'%');
			$query->where($db->qn('t.title').' LIKE '.$search);
		}
		
		// Filter by published state
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where($db->qn('t.published').' = '. (int) $published);
		} elseif ($published === '') {
			$query->where($db->qn('t.published').' IN (0,1)');
		}
		
		// Add the list ordering clause
		$listOrdering = $this->getState('list.ordering', 't.title');
		$listDirn = $db->escape($this->getState('list.direction', 'asc'));
		$query->order($db->escape($listOrdering).' '.$listDirn);
		
		return $query;
	}
}