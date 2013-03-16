<?php
/**
 * Facade.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame
 *
 * @date    24.08.12
 */

namespace Flame\Doctrine\Model;

use Flame\Doctrine\Entities\IEntity;

abstract class Facade extends \Nette\Object implements IFacade
{

	/**
	 * @var \Doctrine\ORM\EntityRepository
	 */
	protected $repository;

	/**
	 * @var string
	 */
	protected $repositoryName;

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $entityManager;

	/**
	 * @param \Doctrine\ORM\EntityManager $entityManager
	 * @throws \Nette\InvalidStateException
	 */
	public function __construct(\Doctrine\ORM\EntityManager $entityManager)
	{
		if (!$this->repositoryName)
			throw new \Nette\InvalidStateException('Name of repository must be defined and valid string. ' . __CLASS__ . '::$reposityName.');

		$this->entityManager = $entityManager;
		$this->repository = $entityManager->getRepository($this->repositoryName);
	}

	/**
	 * @param $id
	 * @return \Flame\Doctrine\Entities\IEntity
	 */
	public function getOne($id)
	{
		return $this->repository->findOneById($id);
	}

	/**
	 * @param \Flame\Doctrine\Entities\IEntity $reference
	 * @param bool $flush
	 * @return mixed
	 */
	public function save(IEntity $reference, $flush = true)
	{
		return $this->repository->save($reference, !$flush);
	}

	/**
	 * @param \Flame\Doctrine\Entities\IEntity $reference
	 * @param bool $flush
	 * @return mixed
	 */
	public function delete(IEntity $reference, $flush = true)
	{
		return $this->repository->delete($reference, !$flush);
	}

}
