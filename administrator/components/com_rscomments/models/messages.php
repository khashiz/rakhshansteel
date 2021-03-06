<?php
/**
* @package RSComments!
* @copyright (C) 2015 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Language\LanguageHelper;

class RscommentsModelMessages extends JModelList {

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery() {
		$db 	= JFactory::getDbo();
		$query 	= $db->getQuery(true);

		// Select fields
		$query->select('DISTINCT('.$db->qn('tag').')');

		// Select from table
		$query->from($db->qn('#__rscomments_messages'));

		// Add the list ordering clause
		$query->order($db->qn('tag').' ASC');

		return $query;
	}

	public function getAvailableLanguages() {
		$db 		= JFactory::getDbo();
		$query 		= $db->getQuery(true);
		$languages 	= LanguageHelper::getKnownLanguages();

		$query->select('DISTINCT('.$db->qn('tag').')')->from('`#__rscomments_messages`');
		$db->setQuery($query);
		$exclude_langs = $db->loadObjectList();

		foreach($exclude_langs as $lang)
			unset($languages[$lang->tag]);

		return $languages;
	}
}