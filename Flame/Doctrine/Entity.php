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
		return array_merge(array('id' => $this->getId()), get_object_vars($this));
	}

	/**
	 *
	 */
	public function toFullArray()
	{
		$vars = $this->toArray();
		if(count($vars)) {
			foreach($vars as &$var) {
				if($var instanceof Entity) {
					$var = $var->toFullArray();
				}elseif($var instanceof \Traversable) {
					$var = array_map(function ($item) {
						if($item instanceof Entity) {
							$item = $item->toArray();
						}

						return $item;
					}, iterator_to_array($var));
				}
			}
		}

		return $vars;
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
