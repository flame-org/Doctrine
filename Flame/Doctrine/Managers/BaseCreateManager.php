<?php
/**
 * Class BaseCreateManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Managers;

abstract class BaseCreateManager extends BaseManager
{

	/**
	 * Initialize entity
	 *
	 * @return $this
	 */
	public function create()
	{
		$this->entity = $this->model->getDao()->createEntity($this->getEntityName());
		$this->processKeys($this->getDesiredKeys());
		$this->processKeys($this->getOptionalKeys(), false);
		return $this;
	}

	/**
	 * Get name of Entity which will be initialized
	 *
	 * @return string
	 */
	abstract public function getEntityName();

	/**
	 * Get list of desired keys which will be set to entity
	 *
	 * @return array
	 */
	abstract protected function getDesiredKeys();

	/**
	 * Get list of optional keys which will be set to entity
	 *
	 * @return array
	 */
	abstract protected function getOptionalKeys();
}