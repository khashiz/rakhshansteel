<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class plgButtonRsfiles extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;
	
	public function __construct(& $subject, $config) {
		parent::__construct($subject, $config);
	}
	
	/**
	 * Display the button
	 *
	 * @return array A four element array of (article_id, article_title, category_id, object)
	 */
	public function onDisplay($name) {	
		if (!$this->canRun()) 
			return;
		
		static $run = false;
		
		if (!$run) {
			$js = "function rsf_placeholder(editor, what)
				{
					var tag = '{rsfiles path=\"'+what+'\"}';
					if (window.Joomla && window.Joomla.editors && window.Joomla.editors.instances && window.Joomla.editors.instances.hasOwnProperty(editor)) {
						window.parent.Joomla.editors.instances[editor].replaceSelection(tag);
					} else {
						window.jInsertEditorText(tag, editor);
					}
					
					window.parent.jModalClose();
					return false; 
				}
				";
			
			JFactory::getLanguage()->load('plg_editors-xtd_rsfiles', JPATH_ADMINISTRATOR);
			JFactory::getDocument()->addScriptDeclaration($js);
			$run = true;
		}

		$link = 'index.php?option=com_rsfiles&amp;view=files&amp;layout=modal&amp;from=editor&amp;tmpl=component&amp;'.JSession::getFormToken().'=1&amp;editor=' . $name;

		$button = new JObject;
		$button->modal = true;
		$button->class = 'btn';
		$button->link = $link;
		$button->text = JText::_('PLG_RSFILES_BUTTON');
		$button->name = 'file-add';
		$button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";

		return $button;
	}
	
	protected function canRun() {
		if (!JFactory::getApplication()->isClient('administrator'))
			return false;
		
		if (file_exists(JPATH_SITE.'/components/com_rsfiles/rsfiles.php'))
			return true;
		
		return false;
	}
}