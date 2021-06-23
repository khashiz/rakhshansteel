<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class rsfilesModelStatistics extends JModelList
{
	protected $_query;
	protected $_squery;
	protected $_data;
	protected $_sdata;
	protected $_total=null;
	protected $_stotal=null;
	protected $_pagination=null;
	protected $_spagination=null;
	protected $_layout;
	
	public function __construct() {	
		parent::__construct();
		$this->_buildQuery();
		
		$app = JFactory::getApplication();

		$this->_layout = $app->input->get('layout','default');
		
		// Get pagination request variables
		$limit 		= $app->getUserStateFromRequest('com_rsfiles.'.$this->_layout.'.limit', 'limit', $this->getState('list.limit'), 'int');
		$limitstart = $app->getUserStateFromRequest('com_rsfiles.'.$this->_layout.'.limitstart', 'limitstart', 0, 'int');

		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('com_rsfiles.'.$this->_layout.'.limit', $limit);
		$this->setState('com_rsfiles.'.$this->_layout.'.limitstart', $limitstart);
	}
	
	protected function _buildQuery() {
		$db		= JFactory::getDbo();
		$filter = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$id		= JFactory::getApplication()->input->getInt('id',0);
		
		$query = $db->getQuery(true)->select($db->qn('f.IdFile'))
					->select($db->qn('f.FilePath'))->select($db->qn('f.hits'))->select('COUNT('.$db->qn('s.IdStatistic').') AS downloads')
					->from($db->qn('#__rsfiles_files','f'))
					->join('LEFT',$db->qn('#__rsfiles_statistics','s').' ON '.$db->qn('f.IdFile').' = '.$db->qn('s.IdFile'))
					->where($db->qn('f.FileStatistics').' = '.$db->q(1))
					->group($db->qn('f.IdFile'))->group($db->qn('f.FilePath'))->group($db->qn('f.hits'))
					->order($db->qn('f.FilePath').' DESC');
		
		if ($filter) {
			$query->where($db->qn('f.FilePath').' LIKE '.$db->q('%'.$filter.'%'));
		}
		
		$this->_query = (string) $query;
		
		$query = $db->getQuery(true)->select('s.*')->select($db->qn('u.username'))
					->from($db->qn('#__rsfiles_statistics','s'))
					->join('LEFT',$db->qn('#__users','u').' ON '.$db->qn('u.id').' = '.$db->qn('s.UserId'))
					->where($db->qn('s.IdFile').' = '.$db->q($id))
					->order($db->qn('s.Date').' DESC');
		
		$this->_squery = (string) $query;
	}
	
	public function getData() {
		if (empty($this->_data)) {
			$db	= JFactory::getDbo();
			$db->setQuery($this->_query,$this->getState('com_rsfiles.'.$this->_layout.'.limitstart'), $this->getState('com_rsfiles.'.$this->_layout.'.limit'));
			$this->_data = $db->loadObjectList();
		}
		
		return $this->_data;
	}
	
	public function getTotal() {
		if (empty($this->_total)) {
			$db	= JFactory::getDbo();
			$db->setQuery($this->_query);
			$db->execute();
			$this->_total = $db->getNumRows();
		}
		
		return $this->_total;
	}
	
	public function getPagination()	{
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotal(), $this->getState('com_rsfiles.'.$this->_layout.'.limitstart'), $this->getState('com_rsfiles.'.$this->_layout.'.limit'));
		}
		return $this->_pagination;
	}
	
	public function getStatistics() {
		if (empty($this->_sdata)) {
			$db	= JFactory::getDbo();
			$db->setQuery($this->_squery,$this->getState('com_rsfiles.'.$this->_layout.'.limitstart'), $this->getState('com_rsfiles.'.$this->_layout.'.limit'));
			$this->_sdata = $db->loadObjectList();
		}

		return $this->_sdata;
	}
	
	public function getsTotal() {
		if (empty($this->_stotal)) {
			$db	= JFactory::getDbo();
			$db->setQuery($this->_squery);
			$db->execute();
			$this->_stotal = $db->getNumRows();
		}
		
		return $this->_stotal;
	}
 
	public function getsPagination() {
		if (empty($this->_spagination)) {
			jimport('joomla.html.pagination');
			$this->_spagination = new JPagination($this->getsTotal(), $this->getState('com_rsfiles.'.$this->_layout.'.limitstart'), $this->getState('com_rsfiles.'.$this->_layout.'.limit'));
		}
		return $this->_spagination;
	}
	
	public function getFilepath() {
		$db 	= JFactory::getDbo();
		$query	= $db->getQuery(true);
		
		$query->clear()->select($db->qn('FilePath'))->from($db->qn('#__rsfiles_files'))->where($db->qn('IdFile').' = '.JFactory::getApplication()->input->getInt('id',0));
		$db->setQuery($query);
		return $db->loadResult();
	}
	
	public function delete($pks) {
		$db 	= JFactory::getDbo();
		$query	= $db->getQuery(true);
		
		if ($pks) {
			$pks = array_map('intval',$pks);
		
			$query->clear()->delete($db->qn('#__rsfiles_statistics'))->where($db->qn('IdFile').' IN ('.implode(',',$pks).')');
			$db->setQuery($query);
			$db->execute();
		
			$query->clear()->update($db->qn('#__rsfiles_files'))->set($db->qn('hits').' = 0')->where($db->qn('IdFile').' IN ('.implode(',',$pks).')');
			$db->setQuery($query);
			$db->execute();
		}
		
		return true;
	}
}