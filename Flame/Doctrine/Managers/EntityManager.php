<?php
/**
 * Class EntityManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Managers;

use Flame\Doctrine\Entity;
use Flame\Doctrine\IManager;
use Flame\Doctrine\Values\IDataSet;
use Nette\Object;

class EntityManager extends Object implements IManager
{

	/** @var bool  */
	private $flush = true;

	/**
	 * @param IEntityCreator $creator
	 * @return Entity
	 */
	public function create(IEntityCreator $creator)
	{
		$entity = $creator->create();
		$creator->getDao()->add($entity);

		if($this->flush === true) {
			$creator->getDao()->save();
		}

		return $entity;
	}

	/**
	 * @param IEntityUpdater $updater
	 * @return \Flame\Doctrine\Entity
	 */
	public function update(IDataSet $values, $entity)
	{
		// TODO: Implement update() method.
	}

	/**
	 * @param Entity|int $entity
	 * @return bool
	 */
	public function delete($entity)
	{
		if(!$entity instanceof Entity) {
			$entity = $this->dao->find((int) $entity);
		}

		try {

			$this->dao->delete($entity, $this->flush);
			return true;

		}catch (\Exception $ex) {
			return false;
		}
	}

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function setFlushMode($flush)
	{
		$this->flush = (bool) $flush;
		return $this;
	}
}