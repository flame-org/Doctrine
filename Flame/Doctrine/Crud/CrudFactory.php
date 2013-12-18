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

class CrudFactory
{

	/** @var \Flame\Doctrine\EntityDao  */
	private $dao;

	/** @var \Flame\Doctrine\Mapping\IRestEntityMapper  */
	private $entityMapper;

	/**
	 * @param EntityDao $dao
	 * @param IRestEntityMapper $entityMapper
	 */
	function __construct(EntityDao $dao, IRestEntityMapper $entityMapper)
	{
		$this->dao = $dao;
		$this->entityMapper = $entityMapper;
	}

	/**
	 * @return EntityCreator
	 */
	public function createCreator()
	{
		return new EntityCreator($this->dao, $this->entityMapper);
	}

	/**
	 * @return EntityUpdater
	 */
	public function createUpdater()
	{
		return new EntityUpdater($this->dao, $this->entityMapper);
	}

	/**
	 * @return EntityDeleter
	 */
	public function createDeleter()
	{
		return new EntityDeleter($this->dao);
	}
}