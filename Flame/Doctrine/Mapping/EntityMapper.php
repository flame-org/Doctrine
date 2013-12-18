<?php
/**
 * Class EntityMapper
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 04.10.13
 */
namespace Flame\Doctrine\Mapping;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Kdyby\Doctrine\Entities\BaseEntity;
use Kdyby\Doctrine\Entities\IdentifiedEntity;
use Nette\Object;

class EntityMapper extends Object implements IEntityMapper
{

	/**
	 * @param $values
	 * @param BaseEntity $entity
	 * @return BaseEntity
	 */
	public function setValues($values, BaseEntity $entity)
	{
		if(count($values)) {
			foreach ($values as $key => $value) {
				if(isset($entity->$key)) {
					$entity->$key = $value;
				}
			}
		}

		return $entity;
	}

	/**
	 * @param BaseEntity $entity
	 * @return array
	 */
	public function getValues(BaseEntity &$entity)
	{
		$details = array();
		foreach ($entity->getReflection()->getProperties(\ReflectionProperty::IS_PROTECTED) as $property) {
			if (!$property->isStatic()) {
				$value = $entity->{$property->getName()};

				if ($value instanceof IdentifiedEntity) {
					$value = $value->getId();
				} elseif ($value instanceof ArrayCollection || $value instanceof PersistentCollection) {
					$value = array_map(function ($entity) {
						if ($entity instanceof IdentifiedEntity) {
							$entity = $entity->getId();
						}

						return $entity;
					}, $value->toArray());
				}

				$details[$property->getName()] = $value;
			}
		}
		return $details;
	}
}