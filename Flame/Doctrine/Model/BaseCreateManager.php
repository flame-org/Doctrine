<?php
/**
 * Class BaseCreateManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Model;

use Flame\Rest\Types\ObjectData;
use Nette\InvalidStateException;

abstract class BaseCreateManager extends BaseManager implements ICreateManager
{

	/** @var  \Flame\Doctrine\Entity */
	protected $entity;

	/** @var  ObjectData */
	protected $data;

	/**
	 * @param $data
	 * @return $this
	 */
	public function setData($data)
	{
		$this->data = new ObjectData($data);
		return $this;
	}

	/**
	 * @return \Flame\Doctrine\Entity
	 */
	public function getEntity()
	{
		return $this->entity;
	}

	/**
	 * @param bool $flush
	 * @return $this
	 * @throws \Nette\InvalidStateException
	 */
	public function save($flush = true)
	{
		if($this->entity === null) {
			throw new InvalidStateException('Call create method first');
		}

		if($flush === true) {
			$this->model->getDao()->save($this->entity);
		}else{
			$this->model->getDao()->add($this->entity);
		}

		return $this;
	}
}