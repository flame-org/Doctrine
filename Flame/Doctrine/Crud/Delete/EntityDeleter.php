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
use Nette\FatalErrorException;

class EntityDeleter extends EntityCrud implements IEntityDeleter
{

	/** @var array  */
	public $beforeDelete = array();

	/** @var array  */
	public $afterDelete = array();

	/**
	 * @param int|\Flame\Doctrine\Entity $entity
	 * @return bool
	 * @throws \ErrorException
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
			throw new \ErrorException($ex->getMessage());
		}
	}
}