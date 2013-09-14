<?php
/**
 * Class EntityDeleter
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 13.09.13
 */
namespace Flame\Doctrine\Crud\Delete;

use Flame\Doctrine\Crud\EntityCrud;
use Flame\Doctrine\Entity;

class EntityDeleter extends EntityCrud implements IEntityDeleter
{

	/** @var array  */
	private $beforeDelete = array();

	/** @var array  */
	private $afterDelete = array();

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

			$this->processHooks($this->beforeDelete, array($entity));
			$this->dao->delete($entity, $this->flush);
			$this->processHooks($this->afterDelete);
			return true;

		}catch (\Exception $ex) {
			return false;
		}
	}

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function addBeforeDelete($callback)
	{
		$this->beforeDelete[] = $callback;
		return $this;
	}

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function addAfterDelete($callback)
	{
		$this->afterDelete[] = $callback;
		return $this;
	}
}