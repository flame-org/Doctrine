<?php
/**
 * Class EntityDeleter
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 13.09.13
 */
namespace Flame\Doctrine\Crud\Delete;

use Nette\Object;
use Flame\Doctrine\EntityDao;
use Flame\Doctrine\Entity;

class EntityDeleter extends Object implements IEntityDeleter
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
	 * @param int|\Flame\Doctrine\Entity $entity
	 * @return bool
	 */
	public function delete($entity)
	{
		if(!$entity instanceof Entity) {
			$entity = $this->dao->find((int) $entity);
		}

		try {

			$this->beforeDelete($entity);
			$this->dao->delete($entity, $this->flush);
			$this->afterDelete();
			return true;

		}catch (\Exception $ex) {
			return false;
		}
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
	protected function beforeDelete(Entity $entity) {}

	/**
	 * @return void
	 */
	protected function afterDelete() {}
}