<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Template_Block implements Template_Interface {

	protected $config;

	public function render()
	{
		$response = NULL;

		try
		{
			$widget_list = $this->{'_from_'.$this->config['source']}($this->layout);

			foreach ($widget_list as $widget)
			{
				$response .= Template::widget($widget);
			}
		}
		catch (Template_Exception $e)
		{
			throw new Template_Exception(__('Block :block connot be rendered', array(':block' => $this->layout)));
		}

		return $response;
	}

	public function __construct($name)
	{
		$this->layout = $name;
		$this->config = Kohana::$config->load('template.block');
	}

	public function __toString()
	{
		$response = $this->render();
		// $response = $this->_from_config('test');

		if ( ! is_string($response))
		{
			$response = Debug::vars($response);
		}

		return $response;
	}


	/**
	 * Gets widget list from database
	 *
	 * @param string $block_name
	 * @return array|NULL
	 */
	protected function _from_database($block_name)
	{
		$query = DB::select('name', 'execute_path')
			->from($this->config['table_name'])
			->where('block', '=', $block_name)
			->where('status', '=', '1')
			->order_by('position', 'ASC')
			->cached(Kohana::$cache_life, ( ! Kohana::$caching))
			->execute()
			->as_array('name', 'execute_path');

		return (count($query) > 0) ? $query : NULL;
	}

	/**
	 * Gets widget list from config
	 *
	 * @param string $block_name
	 * @return array|NULL
	 */
	protected function _from_config($block_name)
	{
		$widgets = Kohana::$config->load($this->config['config_name'].'.'.$block_name);
		return (count($widgets) > 0) ? $widgets : NULL;
	}
}
