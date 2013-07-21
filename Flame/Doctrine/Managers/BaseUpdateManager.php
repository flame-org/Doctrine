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

abstract class BaseUpdateManager extends BaseManager implements IUpdateManager
{

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
	 * Set new values to entity
	 *
	 * @param Entity $entity
	 * @return $this
	 * @throws \Nette\InvalidStateException
	 */
	public function update(Entity $entity = null)
	{
		$this->updateSetUp($entity);

		if(count($this->data) && count($allowedKeys = $this->getAllowedKeys())) {
			foreach ($this->data as $key => $value) {
				if(in_array($key, $allowedKeys)) {
					$this->entity->$key = $value;
				}
			}
		}

		return $this;
	}

	/**
	 * Setup class environment
	 *
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

	/**
	 * Get list of keys which will be updated
	 *
	 * @return array
	 */
	abstract public function getAllowedKeys();

}