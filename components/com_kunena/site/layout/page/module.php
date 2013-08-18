<?php
/**
 * Kunena Component
 * @package Kunena.Site
 * @subpackage Controllers.Misc
 *
 * @copyright (C) 2008 - 2013 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

class KunenaLayoutPageModule extends KunenaLayout
{
	public $position = null;

	/**
	 * Renders module position.
	 *
	 * @return string
	 */
	public function renderPosition() {
		$document = JFactory::getDocument();
		if ($this->position && $document->countModules($this->position)) {
			$renderer = $document->loadRenderer('modules');
			$options = array ('style' => 'xhtml' );
			return (string) $renderer->render($this->position, $options, null);
		}
		return '';
	}
}
