<?php
/**
 * Class BaseCreateManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Managers;

use Flame\Doctrine\Keys\IDesiredKeys;
use Flame\Doctrine\Keys\IOptionalKeys;

abstract class BaseCreateManager extends BaseManager
{

	/**
	 * Initialize entity
	 *
	 * @return $this
	 */
	public function create()
	{
		$this->beforeCreate();
		$this->entity = $this->model->getDao()->createEntity($this->getEntityName());

		if($this instanceof IDesiredKeys) {
			$this->processKeys($this->getDesiredKeys());
		}

		if($this instanceof IOptionalKeys) {
			$this->processKeys($this->getOptionalKeys(), false);
		}

		$this->afterCreate();

		return $this;
	}

	/**
	 * Get name of Entity which will be initialized
	 *
	 * @return string
	 */
	abstract public function getEntityName();

	/**
	 * @return void
	 */
	protected function afterCreate() {}

	/**
	 * @return void
	 */
	protected function beforeCreate() {}
}