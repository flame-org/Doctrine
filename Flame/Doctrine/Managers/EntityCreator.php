<?php
/**
 * Class EntityCreator
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Managers;

use Flame\Doctrine\Entity;
use Flame\Doctrine\Model\IModel;
use Flame\Doctrine\Values\IDataSet;
use Nette\Object;

class EntityCreator extends Object implements IEntityCreator
{

	/** @var  IDataSet */
	private $values;

	/** @var  IModel */
	private $model;

	/**
	 * @param IModel $model
	 * @param IDataSet $values
	 */
	function __construct(IModel $model, IDataSet $values)
	{
		$this->model = $model;
		$this->values = $values;
	}

	/**
	 * @return \Flame\Doctrine\EntityDao
	 */
	public function getDao()
	{
		return $this->model->getDao();
	}

	/**
	 * @return \Flame\Doctrine\Entity
	 */
	public function create()
	{
		$entity = $this->getDao()->createEntity();
		$this->beforeCreate($entity);
		$values = $this->values->getValues();
		foreach ($values as $key => $value) {
			$entity->$key = $value;
		}

		$this->getDao()->add($entity);
		$this->afterCreate($entity);

		return $entity;
	}

	/**
	 * @param Entity $entity
	 */
	protected function beforeCreate(Entity $entity){}

	/**
	 * @param Entity $entity
	 */
	protected function afterCreate(Entity $entity){}
}