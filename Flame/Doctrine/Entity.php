<?php
/**
 * BaseEntity.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    14.04.13
 */

namespace Flame\Doctrine;

use Flame\Doctrine\Mapping\EntityHydrator;
use Kdyby\Doctrine\Entities\IdentifiedEntity;

abstract class Entity extends IdentifiedEntity
{

	/** @var  EntityHydrator */
	private $hydrator;

	/**
	 * @return EntityHydrator
	 */
	private function getHydrator()
	{
		if ($this->hydrator === null) {
			$this->hydrator = new EntityHydrator();
		}

		return $this->hydrator;
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		return $this->getHydrator()->extract($this);
	}

	/**
	 * @return array
	 */
	public function toSimpleArray()
	{
		return $this->getHydrator()->simpleExtract($this);
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		if (isset($this->name) && $this->name !== null) {
			return (string)$this->name;
		} else {
			return (string)$this->id;
		}
	}
}
