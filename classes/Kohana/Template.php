<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Template {

	/**
	 * Gets instance of class Template_Block
	 *
	 * @param string $name
	 * @return object
	 */
	public static function block($name = 'empty')
	{
		$class = new Template_Block($name);

		if ( ! $class instanceof Template_Interface)
		{
			throw new Template_Exception(__('Class :class don\'t instance of Template_Interface', array(':class' => 'Template_Block')));
		}

		return $class;
	}

	/**
	 * Gets instance of class Template_Layout
	 *
	 * @param string $name
	 * @return object
	 */
	public static function layout($name = 'empty')
	{
		$class = new Template_Layout($name);

		if ( ! $class instanceof Template_Interface)
		{
			throw new Template_Exception(__('Class :class don\'t instance of Template_Interface', array(':class' => 'Template_Layout')));
		}

		return $class;
	}

	/**
	 * Gets instance of class Template_Widget
	 *
	 * @param string $name
	 * @return object
	 */
	public static function widget($name = 'empty')
	{
		$class = new Template_Widget($name);

		if ( ! $class instanceof Template_Interface)
		{
			throw new Template_Exception(__('Class :class don\'t instance of Template_Interface', array(':class' => 'Template_Widget')));
		}

		return $class;
	}
}
