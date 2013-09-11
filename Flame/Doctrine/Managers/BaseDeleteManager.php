<?php
/**
 * Class BaseDeleteManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 07.09.13
 */
namespace Flame\Doctrine\Managers;

use Flame\Doctrine\Entity;
use Nette\InvalidStateException;
use Nette\Object;

abstract class BaseDeleteManager extends Object implements IDeleteManager
{

	/** @var \Flame\Doctrine\Entity  */
	private $entity;

	/**
	 * @param null $id
	 * @return $this
	 * @throws \Nette\InvalidStateException
	 */
	public function delete($id = null)
	{
		if($id !== null) {
			$this->setEntity($this->getModel()->getDao()->find((int) $id));
		}

		if(!$entity = $this->getEntity()) {
			throw new InvalidStateException('Invalid Entity given.');
		}

		$this->beforeDelete();
		$this->getModel()->getDao()->delete($entity);
		$this->afterDelete();
		return $this;
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
	 * @return \Flame\Doctrine\Entity
	 */
	public function getEntity()
	{
		return $this->entity;
	}

	/**
	 * @return void
	 */
	protected function afterDelete() {}

	/**
	 * @return void
	 */
	protected function beforeDelete() {}
}