<?php
/**
 * Class EntityUpdater
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 14.09.13
 */
namespace Flame\Doctrine\Crud\Update;

use Flame\Doctrine\Crud\EntityCrud;
use Flame\Doctrine\Entity;
use Flame\Doctrine\Values\IDataSet;

class EntityUpdater extends EntityCrud implements IEntityUpdater
{

	/** @var array  */
	private $beforeUpdate = array();

	/** @var array  */
	private $afterUpdate = array();

	/**
	 * @param IDataSet $values
	 * @param Entity|int $entity
	 * @return Entity
	 */
	public function update($entity, IDataSet $values)
	{
		if(!$entity instanceof Entity) {
			$entity = $this->dao->find((int) $entity);
		}

		$this->processHooks($this->beforeUpdate, array($entity, $values));

		$_values = $values->getEditableValues();
		foreach ($_values as $key => $value) {
			$entity->$key = $value;
		}

		$this->processHooks($this->afterUpdate, array($entity, $values));

		$this->save($entity);
		return $entity;
	}

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function addBeforeUpdate($callback)
	{
		$this->beforeUpdate[] = $callback;
		return $this;
	}

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function addAfterUpdate($callback)
	{
		$this->afterUpdate[] = $callback;
		return $this;
	}

	/**
	 * @param Entity $entity
	 */
	protected function save(Entity $entity)
	{
		$this->dao->add($entity);

		if($this->flush === true) {
			$this->dao->save();
		}
	}
}