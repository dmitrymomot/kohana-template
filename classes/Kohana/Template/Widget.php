<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Template_Widget implements Template_Interface {

	/**
	 * Widget name
	 *
	 * @var string
	 */
	protected $_widget_name;

	/**
	 * Instance of class Request
	 *
	 * @var object
	 */
	protected $_widget_request;

	/**
	 * Creating request.
	 *
	 * @return object	// Instance of class Request
	 */
	public function request()
	{
		if ( ! $this->_widget_request)
		{
			$request = Request::initial();

			$this->_widget_request = Request::factory($this->_widget_name)
				->method($request->method())
				->files($request->files())
				->post($request->post())
				->query($request->query());
		}

		return $this->_widget_request;
	}

	/**
	 * Render widget
	 *
	 * @return string
	 */
	public function render()
	{
		return $this->request()->execute()->body();
	}

	/**
	 * Constructor of class Widget.
	 *
	 * @param string $widget_name
	 * @return void
	 */
	public function __construct($widget_name)
	{
		$this->_widget_name = $widget_name;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->render();
	}
}
