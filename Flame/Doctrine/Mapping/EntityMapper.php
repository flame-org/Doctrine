<?php
/**
 * Class EntityMapper
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 04.10.13
 */
namespace Flame\Doctrine\Mapping;

use Doctrine\Common\Collections\Collection;
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
		if($entity instanceof IdentifiedEntity) {
			$details['id'] = $entity->getId();
		}

		$properties = $this->getEntityProperties($entity);
		foreach ($properties as $property) {
			if (!$property->isStatic()) {
				$value = $entity->{$property->getName()};
				$details[$property->getName()] = $this->extractor($value);
			}
		}

		return $details;
	}

	/**
	 * @param BaseEntity $entity
	 * @return array
	 */
	public function getSimpleValues(BaseEntity &$entity)
	{
		$details = array();
		if($entity instanceof IdentifiedEntity) {
			$details['id'] = $entity->getId();
		}

		$properties = $this->getEntityProperties($entity);
		foreach ($properties as $property) {
			if (!$property->isStatic()) {
				$value = $entity->{$property->getName()};
				$details[$property->getName()] = $this->simpleExtractor($value);
			}
		}

		return $details;
	}

	/**
	 * @param BaseEntity $entity
	 * @return \Nette\Reflection\Property[]
	 */
	protected function getEntityProperties(BaseEntity &$entity)
	{
		return $entity->getReflection()->getProperties(\ReflectionProperty::IS_PROTECTED);
	}

	/**
	 * @param $value
	 * @return array
	 */
	protected function extractor($value)
	{
		if ($value instanceof BaseEntity) {
			$value = $this->getValues($value);
		} elseif ($value instanceof Collection) {
			$value = array_map(function ($entity) {
				if ($entity instanceof BaseEntity) {
					$entity = $this->getValues($entity);
				}

				return $entity;
			}, $value->toArray());
		}

		return $value;
	}

	/**
	 * @param $value
	 * @return array
	 */
	protected function simpleExtractor($value)
	{
		if ($value instanceof IdentifiedEntity) {
			$value = $value->getId();
		} elseif ($value instanceof Collection) {
			$value = array_map(function ($entity) {
				if ($entity instanceof IdentifiedEntity) {
					$entity = $entity->getId();
				}

				return $entity;
			}, $value->toArray());
		}

		return $value;
	}
}