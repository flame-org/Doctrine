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
	 * @param bool $powerful
	 * @return array
	 */
	public function toArray($powerful = false)
	{
		$vars = get_object_vars($this);
		if($powerful && count($vars)) {
			foreach($vars as &$var) {
				if($var instanceof Entity) {
					$var = $var->toArray();
				}elseif($var instanceof \Traversable) {
					$var = iterator_to_array($var);
					if(count($var)) {
						$var = array_map(function ($item) {
							if($item instanceof Entity) {
								$item = $item->toArray();
							}

							return $item;
						}, $var);
					}
				}
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
