<?php
/**
 * Class EntityCreator
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Crud\Create;

use Flame\Doctrine\Crud\EntityCrud;
use Flame\Doctrine\Entity;
use Flame\Doctrine\Values\IDataSet;

class EntityCreator extends EntityCrud implements IEntityCreator
{

	/** @var array  */
	private $beforeCreate = array();

	/** @var array  */
	private $afterCreate = array();

	/**
	 * @param IDataSet $values
	 * @return Entity
	 */
	public function create(IDataSet $values)
	{
		$entity = $this->dao->createEntity();

		$this->processHooks($this->beforeCreate, array($entity, $values));

		$_values = $values->getValues();
		foreach ($_values as $key => $value) {
			$entity->$key = $value;
		}

		$this->dao->add($entity);

		$this->processHooks($this->afterCreate, array($entity, $values));

		if($this->flush === true) {
			$this->dao->save();
		}

		return $entity;
	}

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function addBeforeCreate($callback)
	{
		$this->beforeCreate[] = $callback;
		return $this;
	}

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function addAfterCreate($callback)
	{
		$this->afterCreate[] = $callback;
		return $this;
	}
}