<?php
/**
 * EntityDao.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    19.04.13
 */

namespace Flame\Doctrine;

use Nette\Reflection\ClassType;
use Doctrine\DBAL\LockMode;

class EntityDao extends \Kdyby\Doctrine\EntityDao
{

	/**
	 * @return \Flame\Doctrine\Entity
	 */
	public function createEntity()
	{
		$reflection = new ClassType($this->getEntityName());
		return $reflection->newInstanceArgs(func_get_args());
	}

	/**
	 * @return \Flame\Doctrine\Entity
	 */
	public function addNewEntity()
	{
		$reflection = new ClassType($this->getEntityName());
		$entity = $reflection->newInstanceArgs(func_get_args());
		$this->add($entity);
		return $entity;
	}

	/**
	 * @param mixed $id
	 * @param int $lockMode
	 * @param null $lockVersion
	 * @return object
	 */
	public function find($id, $lockMode = LockMode::NONE, $lockVersion = null)
	{
		return parent::find((int) $id, $lockMode, $lockVersion);
	}

}
