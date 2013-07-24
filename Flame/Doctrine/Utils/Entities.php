<?php
/**
 * Class Entities
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 21.07.13
 */
namespace Flame\Doctrine\Utils;

use Flame\Doctrine\Entity;
use Nette\Object;

class Entities extends Object
{

	/**
	 * @param $entity
	 * @return array
	 */
	public function toArray($entity)
	{
		if($entity instanceof Entity) {
			return $entity->toArray();
		}

		return (array) $entity;
	}
}