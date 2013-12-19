<?php
/**
 * Class EntityCrudFactory
 *
 * @author Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date 19.12.13
 */
namespace Flame\Doctrine\Crud;

use Flame\Doctrine\Mapping\IEntityMapper;
use Kdyby\Doctrine\EntityManager;
use Nette\Object;

class EntityCrudFactory extends Object implements IEntityCrudFactory
{

	/** @var \Kdyby\Doctrine\EntityManager  */
	private $entityManager;

	/** @var \Flame\Doctrine\Mapping\IEntityMapper  */
	private $entityMapper;

	/**
	 * @param EntityManager $entityManager
	 * @param IEntityMapper $entityMapper
	 */
	function __construct(EntityManager $entityManager, IEntityMapper $entityMapper)
	{
		$this->entityManager = $entityManager;
		$this->entityMapper = $entityMapper;
	}

	/**
	 * @param $entityName
	 * @return EntityCrud
	 */
	public function createEntityCrud($entityName)
	{
		return new EntityCrud($this->entityManager->getDao($entityName), $this->entityMapper);
	}
} 