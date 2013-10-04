<?php
/**
 * Class EntityUpdater
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 14.09.13
 */
namespace Flame\Doctrine\Crud\Update;

use Flame\Doctrine\Crud\EntityCrud;
use Flame\Doctrine\EntityDao;
use Flame\Doctrine\Rest\EntityMapper;
use Flame\Doctrine\Entity;

class EntityUpdater extends EntityCrud implements IEntityUpdater
{

	/** @var array  */
	public $beforeUpdate = array();

	/** @var array  */
	public $afterUpdate = array();

	/** @var \Flame\Doctrine\Rest\EntityMapper  */
	private $entityMapper;

	/**
	 * @param EntityDao $dao
	 * @param EntityMapper $entityMapper
	 */
	function __construct(EntityDao $dao, EntityMapper $entityMapper)
	{
		parent::__construct($dao);

		$this->entityMapper = $entityMapper;
	}

	/**
	 * @param Entity|int $entity
	 * @param $values
	 * @return Entity|object
	 */
	public function update($entity, $values)
	{
		if(!$entity instanceof Entity) {
			$entity = $this->dao->find((int) $entity);
		}

		$this->processHooks($this->beforeUpdate, array($entity, $values));

		$this->entityMapper->setValues($values, $entity);
		$this->dao->add($entity);

		$this->processHooks($this->afterUpdate, array($entity, $values));

		if($this->flush === true) {
			$this->dao->save();
		}

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
}