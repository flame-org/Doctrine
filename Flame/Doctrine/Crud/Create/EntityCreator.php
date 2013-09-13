<?php
/**
 * Class EntityCreator
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Crud\Create;

use Flame\Doctrine\Entity;
use Flame\Doctrine\EntityDao;
use Flame\Doctrine\Values\IDataSet;
use Nette\Object;

class EntityCreator extends Object implements IEntityCreator
{

	/** @var bool  */
	private $flush = true;

	/** @var  EntityDao */
	private $dao;

	/**
	 * @param EntityDao $dao
	 */
	function __construct(EntityDao $dao)
	{
		$this->dao = $dao;
	}

	/**
	 * @param IDataSet $values
	 * @return Entity
	 */
	public function create(IDataSet $values)
	{
		$entity = $this->dao->createEntity();

		$this->beforeCreate($entity);

		$values = $values->getValues();
		foreach ($values as $key => $value) {
			$entity->$key = $value;
		}

		$this->afterCreate($entity);

		$this->save($entity);
		return $entity;
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
	 * @param Entity $entity
	 */
	protected function save(Entity $entity)
	{
		$this->dao->add($entity);

		if($this->flush === true) {
			$this->dao->save();
		}
	}

	/**
	 * @param Entity $entity
	 */
	protected function beforeCreate(Entity $entity){}

	/**
	 * @param Entity $entity
	 */
	protected function afterCreate(Entity $entity){}
}