<?php
/**
 * Class EntityManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Managers;

use Flame\Doctrine\Crud\Create\IEntityCreatorFactory;
use Flame\Doctrine\Entity;
use Flame\Doctrine\IEntityDaoProvider;
use Flame\Doctrine\IManager;
use Flame\Doctrine\Values\IDataSet;
use Flame\Doctrine\Crud\Delete\IEntityDeleterFactory;
use Nette\InvalidStateException;
use Nette\Object;

class EntityManager extends Object implements IManager
{

	/** @var bool  */
	private $flush = true;

	/** @var  IEntityDaoProvider */
	private $daoProvider;

	/** @var \Flame\Doctrine\Crud\Create\IEntityCreatorFactory  */
	private $creatorFactory;

	/** @var \Flame\Doctrine\Crud\Delete\IEntityDeleterFactory  */
	private $deleterFactory;

	private $updaterFactory;

	function __construct(IEntityCreatorFactory $creatorFactory, IEntityDeleterFactory $deleterFactory/**, $updaterFactory*/)
	{
		$this->creatorFactory = $creatorFactory;
		$this->deleterFactory = $deleterFactory;
//		$this->updaterFactory = $updaterFactory;
	}


	/**
	 * @param IDataSet $values
	 * @return Entity
	 */
	public function create(IDataSet $values)
	{
		return $this->creatorFactory
			->createEntityCreator($this->getDao())
			->setFlush($this->flush)
			->create($values);
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
		return $this->deleterFactory
			->createEntityDeleter($this->getDao())
			->delete($entity);
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
	 * @param IEntityDaoProvider $provider
	 * @return $this
	 */
	public function setDaoProvider(IEntityDaoProvider $provider)
	{
		$this->daoProvider = $provider;
		return $this;
	}

	/**
	 * @return \Flame\Doctrine\EntityDao
	 * @throws \Nette\InvalidStateException
	 */
	protected function getDao()
	{
		if($this->daoProvider === null) {
			throw new InvalidStateException('Please set EntityDaoProvider for manager ' . __CLASS__);
		}

		return $this->daoProvider->getDao();
	}
}