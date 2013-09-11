<?php
/**
 * Class BaseManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Managers;

use Flame\ArrayHash;
use Flame\Doctrine\Entity;
use Flame\Doctrine\IEntityProvider;
use Nette\Object;
use Nette\InvalidStateException;

/**
 * Class BaseManager
 *
 * @package Flame\Doctrine\Managers
 * @method \Flame\ArrayHash getData
 */
abstract class BaseManager extends Object implements IEntityProvider
{

	/** @var \Flame\ArrayHash  */
	protected $data;

	public function __construct()
	{
		$this->data = new ArrayHash;
	}

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function save($flush = true)
	{
		if($flush === true) {
			$this->getModel()->getDao()->save($this->getEntity());
		}else{
			$this->getModel()->getDao()->add($this->getEntity());
		}

		return $this;
	}

	/**
	 * @param ArrayHash|array|object $data
	 * @return $this
	 */
	public function setData($data)
	{
		if(!$data instanceof ArrayHash) {
			$this->data = ArrayHash::from((array) $data);
		}else{
			$this->data = $data;
		}

		return $this;
	}

	/**
	 * @param array $keys
	 * @param bool $desired
	 * @throws \Nette\InvalidStateException
	 */
	protected function processKeys(array $keys, $desired = true)
	{
		if(!$this->getEntity() instanceof Entity) {
			throw new InvalidStateException('Invalid Entity given');
		}

		if(count($keys)) {
			foreach ($keys as $key => $value) {
				// Skip if key is not desired and is not set in data set
				if((is_numeric($key) && $desired === false && !isset($this->data->$value)) ||
					(is_string($key) && $desired === false && !isset($this->data->$key))) {
					continue;
				}

				if($value instanceof IValidator) {
					$this->getEntity()->$key = $value->process($this->data->getValue($key, $desired));
				}elseif($value instanceof \Closure) {
					$this->getEntity()->$key = call_user_func($value, $this->data->getValue($key, $desired));
				}else{
					$this->getEntity()->$value = $this->data->getValue($value, $desired);
				}
			}
		}
	}
}