<?php
/**
 * Class BaseUpdateManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 21.07.13
 */
namespace Flame\Doctrine\Managers;

use Flame\Doctrine\Entity;
use Nette\InvalidStateException;
use Flame\Doctrine\Types\IData;

abstract class BaseUpdateManager extends BaseManager implements IUpdateManager
{

	/** @var array  */
	protected $allowedKeys = array();

	/** @var  IData */
	protected $data;

	/**
	 * @return \Flame\Rest\Types\ObjectData
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param $data
	 * @return $this
	 */
	public function setData(IData $data)
	{
		$this->data = $data;
		return $this;
	}

	/**
	 * @param array $keys
	 * @return $this
	 */
	public function setAllowedKeys(array $keys)
	{
		$this->allowedKeys = $keys;
		return $this;
	}

	/**
	 * @param \Flame\Doctrine\Entity $entity
	 * @return $this
	 */
	public function setEntity(Entity $entity)
	{
		$this->entity = $entity;
		return $this;
	}

	/**
	 * @param Entity $entity
	 * @return $this
	 * @throws \Nette\InvalidStateException
	 */
	public function update(Entity $entity = null)
	{
		$this->updateSetUp($entity);

		$data = (array) $this->data->getRaw();
		if(count($data) && count($this->allowedKeys)) {
			foreach ($data as $key => $value) {
				if(in_array($key, $this->allowedKeys)) {
					$this->entity->$key = $value;
				}
			}
		}

		return $this;
	}

	/**
	 * @param $entity
	 * @return $this
	 * @throws \Nette\InvalidStateException
	 */
	protected function updateSetUp($entity)
	{
		if($entity !== null) {
			$this->setEntity($entity);
		}

		if($this->entity === null) {
			throw new InvalidStateException('Set "' . __CLASS__ .'::$entity" first');
		}

		return $this;
	}

}