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

abstract class CrudFactory
{

	/** @var \Flame\Doctrine\EntityDao  */
	protected $dao;

	/**
	 * @param EntityDao $dao
	 */
	function __construct(EntityDao $dao)
	{
		$this->dao = $dao;
	}

	/**
	 * @return EntityCreator
	 */
	public function createCreator()
	{
		return new EntityCreator($this->dao);
	}

	/**
	 * @return EntityUpdater
	 */
	public function createUpdater()
	{
		return new EntityUpdater($this->dao);
	}

	/**
	 * @return EntityDeleter
	 */
	public function createDeleter()
	{
		return new EntityDeleter($this->dao);
	}
}