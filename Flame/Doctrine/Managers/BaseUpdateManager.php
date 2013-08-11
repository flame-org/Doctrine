<?php
/**
 * Class BaseUpdateManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 21.07.13
 */
namespace Flame\Doctrine\Managers;

use Flame\Doctrine\Entity;
use Flame\Doctrine\Keys\IAllowedKeys;
use Nette\InvalidStateException;

abstract class BaseUpdateManager extends BaseManager implements IUpdateManager, IAllowedKeys
{

	/**
	 * @param Entity $entity
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
		if($entity !== null) {
			$this->setEntity($entity);
		}

		if($this->entity === null) {
			throw new InvalidStateException('Set "' . __CLASS__ .'::$entity" first');
		}

		$this->processKeys($this->getAllowedKeys(), false);
		return $this;
	}
}