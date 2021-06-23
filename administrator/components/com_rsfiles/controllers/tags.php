<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class RsfilesControllerTags extends JControllerAdmin
{	
	public function getModel($name = 'Tag', $prefix = 'RsfilesModel', $config = array('ignore_request' => true)) {
		return parent::getModel($name, $prefix, $config);
	}
}