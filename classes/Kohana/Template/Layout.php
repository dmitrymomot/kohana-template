<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Template_Layout implements Template_Interface {

	protected $layout;

	public function render()
	{
		return View::factory($this->layout);
	}

	public function __construct($name)
	{
		$this->layout = $name;
	}

	public function __toString()
	{
		return $this->render()->render();
	}
}
