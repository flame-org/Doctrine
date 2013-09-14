<?php
/**
 * Class EntityCrud
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 14.09.13
 */
namespace Flame\Doctrine\Crud;

use Nette\InvalidStateException;
use Nette\Object;
use Flame\Doctrine\EntityDao;

abstract class EntityCrud extends Object
{

	/** @var bool  */
	protected $flush = true;

	/** @var  EntityDao */
	protected $dao;

	/**
	 * @param EntityDao $dao
	 */
	function __construct(EntityDao $dao)
	{
		$this->dao = $dao;
	}

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
	 * @param $hooks
	 * @param array $args
	 * @throws \Nette\InvalidStateException
	 */
	protected function processHooks($hooks, array $args = array())
	{
		if(count($hooks)) {
			foreach ($hooks as $hook) {
				if(!is_callable($hook)) {
					throw new InvalidStateException('Invalid callback "' . $hook . '" given.');
				}

				call_user_func_array($hook, $args);
			}
		}
	}

}