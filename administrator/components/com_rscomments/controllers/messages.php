<?php
/**
* @package RSComments!
* @copyright (C) 2015 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access');

class RscommentsControllerMessages extends JControllerAdmin
{
	protected $text_prefix = 'COM_RSCOMMENTS';

	/**
	 * Proxy for getModel.
	 *
	 * @param	string	$name	The name of the model.
	 * @param	string	$prefix	The prefix for the PHP class name.
	 *
	 * @return	JModel
	 * @since	1.6
	 */
	public function getModel($name = 'Message', $prefix = 'RscommentsModel', $config = array('ignore_request' => true)) {
		return parent::getModel($name, $prefix, $config);
	}
}