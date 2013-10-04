<?php
/**
 * Class EntityCreator
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Crud\Create;

use Flame\Doctrine\Crud\EntityCrud;
use Flame\Doctrine\EntityDao;
use Flame\Doctrine\Rest\EntityMapper;
use Flame\Doctrine\Entity;
use Flame\Doctrine\Values\IDataSet;

class EntityCreator extends EntityCrud implements IEntityCreator
{

	/** @var array  */
	public $beforeCreate = array();

	/** @var array  */
	public $afterCreate = array();

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
	 * @param IDataSet $values
	 * @return Entity
	 */
	public function create($values)
	{
		$entity = $this->dao->createEntity();

		$this->processHooks($this->beforeCreate, array($entity, $values));

		$this->entityMapper->setValues($values, $entity);
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