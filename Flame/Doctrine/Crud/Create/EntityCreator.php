<?php
/**
 * Class EntityCreator
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Crud\Create;

use Flame\Doctrine\Crud\CrudManager;
use Flame\Doctrine\EntityDao;
use Flame\Doctrine\Mapping\IEntityMapper;
use Flame\Doctrine\Entity;

class EntityCreator extends CrudManager implements IEntityCreator
{

	/** @var array  */
	public $beforeCreate = array();

	/** @var array  */
	public $afterCreate = array();

	/** @var \Flame\Doctrine\Mapping\IEntityMapper  */
	private $entityMapper;

	/** @var \Flame\Doctrine\EntityDao  */
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
	 * @param $values
	 * @return Entity
	 */
	public function create($values)
	{
		$entity = $this->dao->createEntity();

		$this->processHooks($this->beforeCreate, array($entity, $values));
		$this->entityMapper->initValues($values, $entity);
		$this->dao->add($entity);
		$this->processHooks($this->afterCreate, array($entity, $values));

		if($this->getFlush() === true) {
			$this->dao->save();
		}

		return $entity;
	}
}