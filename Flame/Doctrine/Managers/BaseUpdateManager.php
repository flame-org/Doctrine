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

	/** @var  \Flame\Doctrine\Entity */
	private $entity;

	/**
	 * @return \Flame\Doctrine\Entity
	 */
	public function getEntity()
	{
		return $this->entity;
	}

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
	 * @param null $id
	 * @return $this
	 * @throws \Nette\InvalidStateException
	 */
	public function update($id = null)
	{
		if($id !== null) {
			$this->setEntity($this->getModel()->getDao()->find((int) $id));
		}

		$this->beforeUpdate();
		$this->processKeys($this->getAllowedKeys(), false);
		$this->afterUpdate();
		return $this;
	}

	/**
	 * @return void
	 */
	protected function beforeUpdate(){}

	/**
	 * @return void
	 */
	protected function afterUpdate(){}
}