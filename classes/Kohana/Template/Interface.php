<?php defined('SYSPATH') or die('No direct script access.');

interface Kohana_Template_Interface {

	public function render();

	public function __toString();
}
