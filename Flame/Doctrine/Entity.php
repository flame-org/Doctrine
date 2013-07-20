<?php
/**
 * BaseEntity.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    14.04.13
 */

namespace Flame\Doctrine;

use Kdyby\Doctrine\Entities\IdentifiedEntity;
use Nette\InvalidStateException;

abstract class Entity extends IdentifiedEntity
{

	/**
	 * @return array
	 */
	public function toArray()
	{
		$vars = get_object_vars($this);
		foreach($vars as &$var) {
			if($var instanceof Entity) {
				$var = $var->toArray();
			}
		}
		return array_merge(array('id' => $this->getId()), $vars);
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

	/**
	 * @param $collection
	 * @return mixed
	 * @throws InvalidStateException
	 */
	protected function collectionToArray($collection)
	{
		if(!is_object($collection)) {
			throw new InvalidStateException('Collection must be object. Given ' . gettype($collection));
		}

		if(method_exists($collection, 'toArray')) {
			return $collection->toArray();
		}

		throw new InvalidStateException('Object ' . get_class($collection) . ' has not method toArray()');

	}
}
