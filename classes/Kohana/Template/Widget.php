<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Template_Widget implements Template_Interface {

	protected $widget;

	public function render()
	{
		return $this->widget->execute()->body();
	}

	public function __construct($name)
	{
		$request = Request::initial();

		$widget = Request::factory($name)
			->method($request->method())
			->post($request->post())
			->query($request->query());

		$this->widget = $widget;
	}

	public function __toString()
	{
		return $this->render();
	}
}
