<?php
/**
 * Class CrudManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 14.09.13
 */
namespace Flame\Doctrine\Crud;

use Nette\InvalidStateException;
use Nette\Object;

abstract class CrudManager extends Object
{

	/** @var bool  */
	private $flush = true;

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function setFlush($flush)
	{
		$this->flush = (bool) $flush;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getFlush()
	{
		return $this->flush;
	}

	/**
	 * @param $hooks
	 * @param array $args
	 * @throws \Nette\InvalidStateException
	 */
	protected function processHooks($hooks, array $args = array())
	{
		if(!is_array($hooks)) {
			throw new InvalidStateException('Hooks configuration must be in array');
		}

		foreach ($hooks as $hook) {
			if(!is_callable($hook)) {
				throw new InvalidStateException('Invalid callback given.');
			}

			call_user_func_array($hook, $args);
		}
	}
}