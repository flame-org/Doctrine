<?php
/**
 * Class EntityUpdater
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 14.09.13
 */
namespace Flame\Doctrine\Crud\Update;

use Flame\Doctrine\Crud\CrudManager;
use Flame\Doctrine\EntityDao;
use Flame\Doctrine\Mapping\IEntityMapper;
use Flame\Doctrine\Entity;
use Nette\InvalidArgumentException;

class EntityUpdater extends CrudManager implements IEntityUpdater
{

	/** @var array  */
	public $beforeUpdate = array();

	/** @var array  */
	public $afterUpdate = array();

	/** @var \Flame\Doctrine\Mapping\IEntityMapper  */
	private $entityMapper;

	/** @var  EntityDao */
	private $dao;

	/**
	 * @param EntityDao $dao
	 * @param IEntityMapper $entityMapper
	 */
	function __construct(EntityDao $dao, IEntityMapper $entityMapper)
	{
		$this->dao = $dao;
		$this->entityMapper = $entityMapper;
	}

	/**
	 * @param Entity|int $entity
	 * @param $values
	 * @return Entity|object
	 * @throws \Nette\InvalidArgumentException
	 */
	public function update($entity, $values)
	{
		if(!$entity instanceof Entity) {
			$entity = $this->dao->find((int) $entity);
		}

		if(!$entity) {
			throw new InvalidArgumentException('Entity not found.');
		}

		$this->processHooks($this->beforeUpdate, array($entity, $values));

		$this->entityMapper->updateValues($values, $entity);
		$this->dao->add($entity);

		$this->processHooks($this->afterUpdate, array($entity, $values));

		if($this->getFlush() === true) {
			$this->dao->save();
		}

		return $entity;
	}
}