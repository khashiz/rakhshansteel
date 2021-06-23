<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

// Joomla! 3.0
if (version_compare(JVERSION, '3.0', '>=')) {
	require_once JPATH_SITE.'/components/com_rsfiles/helpers/adapter/3.0/tabs.php';
	require_once JPATH_SITE.'/components/com_rsfiles/helpers/adapter/3.0/fieldsets.php';
}