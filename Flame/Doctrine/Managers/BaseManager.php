<?php
/**
 * Class BaseManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Managers;

use Flame\ArrayHash;
use Nette\Object;
use Flame\Doctrine\Model\IModel;
use Nette\InvalidStateException;

/**
 * Class BaseManager
 *
 * @package Flame\Doctrine\Managers
 * @method \Flame\ArrayHash getData
 */
abstract class BaseManager extends Object implements IManager, IEntityManager
{

	/** @var \Flame\ArrayHash  */
	protected $data;

	/** @var  \Flame\Doctrine\Entity */
	protected $entity;

	/** @var \Flame\Doctrine\Model\IModel  */
	protected $model;

	/**
	 * @param IModel $model
	 */
	public function __construct(IModel $model)
	{
		$this->model = $model;
		$this->data = new ArrayHash;
	}

	/**
	 * @return \Flame\Doctrine\Entity
	 */
	public function getEntity()
	{
		return $this->entity;
	}

	/**
	 * @param bool $flush
	 * @return $this
	 * @throws \Nette\InvalidStateException
	 */
	public function save($flush = true)
	{
		if($this->entity === null) {
			throw new InvalidStateException('Set "' . __CLASS__ .'"::$entity first');
		}

		if($flush === true) {
			$this->model->getDao()->save($this->entity);
		}else{
			$this->model->getDao()->add($this->entity);
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
	 */
	protected function processKeys(array $keys, $desired = true)
	{
		if(count($keys)) {
			foreach ($keys as $key => $value) {
				// Skip if key is not desired and is not set in data set
				if(is_numeric($key) && $desired === false && !isset($this->data->$value)) {
					continue;
				}

				if($value instanceof IService) {
					$this->entity->$key = $value->process($this->data->getValue($key, $desired));
				}elseif($value instanceof \Closure) {
					$this->entity->$key = call_user_func($value, $this->data->getValue($key, $desired));
				}else{
					$this->entity->$value = $this->data->getValue($value, $desired);
				}
			}
		}
	}
}