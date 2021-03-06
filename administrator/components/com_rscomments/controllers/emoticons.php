<?php
/**
* @package RSComments!
* @copyright (C) 2015 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access');

class RscommentsControllerEmoticons extends JControllerLegacy
{
	protected $text_prefix = 'COM_RSCOMMENTS_SUBSCRIPTIONS';
	
	/**
	 * Proxy for getModel.
	 *
	 * @param	string	$name	The name of the model.
	 * @param	string	$prefix	The prefix for the PHP class name.
	 *
	 * @return	JModel
	 * @since	1.6
	 */
	public function getModel($name = 'Emoticons', $prefix = 'RscommentsModel', $config = array('ignore_request' => true)) {
		return parent::getModel($name, $prefix, $config);
	}
	
	public function add() {
		$model = $this->getModel();
		
		echo (int) $model->add();
		
		JFactory::getApplication()->close();
	}
	
	public function save() {
		$model = $this->getModel();
		
		if ($data = $model->save()) {
			echo json_encode($data);
		}
		
		JFactory::getApplication()->close();
	}
	
	public function delete() {
		$model = $this->getModel();
		
		echo (int) $model->delete();
		
		JFactory::getApplication()->close();
	}
}