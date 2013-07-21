<?php
/**
 * Class BaseManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Managers;

use Nette\Object;
use Flame\Doctrine\Model\IModel;
use Nette\InvalidStateException;

abstract class BaseManager extends Object implements IManager, IEntityManager
{

	/** @var  \Flame\Doctrine\Entity */
	protected $entity;

	/** @var \Flame\Doctrine\Model\IModel  */
	protected $model;

	/**
	 * @param IModel $model
	 */
	public function __construct(IModel $model)
	{
		$this->model = $model;
	}

	/**
	 * @return \Flame\Doctrine\Entity
	 */
	public function getEntity()
	{
		return $this->entity;
	}

	/**
	 * @return IModel
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * @param bool $flush
	 * @return $this
	 * @throws \Nette\InvalidStateException
	 */
	public function save($flush = true)
	{
		if($this->entity === null) {
			throw new InvalidStateException('Set "' . __CLASS__ .'"::$entity first');
		}

		if($flush === true) {
			$this->model->getDao()->save($this->entity);
		}else{
			$this->model->getDao()->add($this->entity);
		}

		return $this;
	}
}