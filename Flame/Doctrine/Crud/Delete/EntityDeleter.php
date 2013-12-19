<?php
/**
 * Class EntityDeleter
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 13.09.13
 */
namespace Flame\Doctrine\Crud\Delete;

use Flame\Doctrine\Crud\CrudManager;
use Flame\Doctrine\Entity;
use Flame\Doctrine\EntityDao;
use Nette\InvalidArgumentException;
use Nette\InvalidStateException;

class EntityDeleter extends CrudManager implements IEntityDeleter
{

	/** @var array  */
	public $beforeDelete = array();

	/** @var array  */
	public $afterDelete = array();

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
	 * @param Entity|int $entity
	 * @return bool
	 * @throws \Nette\InvalidStateException
	 * @throws \Nette\InvalidArgumentException
	 */
	public function delete($entity)
	{
		if(!$entity instanceof Entity) {
			$entity = $this->dao->find((int) $entity);
		}

		if(!$entity) {
			throw new InvalidArgumentException('Entity not found.');
		}

		try {

			$this->processHooks($this->beforeDelete, array($entity));
			$this->dao->delete($entity);
			$this->processHooks($this->afterDelete);

			if($this->getFlush() === true) {
				$this->dao->save();
			}

			return true;

		}catch (\Exception $ex) {
			throw new InvalidStateException($ex->getMessage());
		}
	}
}