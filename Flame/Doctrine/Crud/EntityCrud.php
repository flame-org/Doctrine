<?php
/**
 * Class CrudFactory
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 15.09.13
 */
namespace Flame\Doctrine\Crud;

use Flame\Doctrine\Crud\Create\EntityCreator;
use Flame\Doctrine\Crud\Delete\EntityDeleter;
use Flame\Doctrine\Crud\Update\EntityUpdater;
use Flame\Doctrine\EntityDao;
use Flame\Doctrine\Mapping\IRestEntityMapper;
use Nette\Object;

class EntityCrud extends Object implements IEntityCrud
{

	/** @var \Flame\Doctrine\Mapping\IRestEntityMapper  */
	private $entityMapper;

	/** @var \Flame\Doctrine\EntityDao  */
	private $reader;

	/** @var  EntityDeleter */
	private $deleter;

	/** @var  EntityUpdater */
	private $updater;

	/** @var  EntityCreator */
	private $creator;

	/**
	 * @param EntityDao $dao
	 * @param IRestEntityMapper $entityMapper
	 */
	function __construct(EntityDao $dao, IRestEntityMapper $entityMapper)
	{
		$this->reader = $dao;
		$this->entityMapper = $entityMapper;
	}

	/**
	 * @return EntityCreator
	 */
	public function getEntityCreator()
	{
		if ($this->creator) {
			$this->creator = new EntityCreator($this->getEntityReader(), $this->entityMapper);
		}

		return $this->creator;
	}

	/**
	 * @return EntityUpdater
	 */
	public function getEntityUpdater()
	{
		if ($this->updater === null) {
			$this->updater = new EntityUpdater($this->getEntityReader(), $this->entityMapper);
		}

		return $this->updater;
	}

	/**
	 * @return EntityDeleter
	 */
	public function getEntityDeleter()
	{
		if ($this->deleter === null) {
			$this->deleter = new EntityDeleter($this->getEntityReader());
		}

		return $this->deleter;
	}

	/**
	 * @return \Flame\Doctrine\EntityDao
	 */
	public function getEntityReader()
	{
		return $this->reader;
	}
}