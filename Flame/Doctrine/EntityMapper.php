<?php
/**
 * Class EntityMapper
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 02.10.13
 */
namespace Flame\Doctrine;

use Kdyby\Doctrine\Entities\BaseEntity;
use Nette\Object;
use Nette\Reflection\Property;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class EntityMapper extends Object implements IEntityMapper
{

	/**
	 * @param BaseEntity $entity
	 * @return array
	 */
	public function extract(BaseEntity $entity)
	{
		$details = array();
		$properties = $entity->getReflection()->getProperties();
		foreach ($properties as $property) {
			if($property->isStatic() or $property->isPrivate()) {
				continue;
			}

			$property->setAccessible(true);
			$details[$property->getName()] = $property->getValue($entity);
		}

		return $details;
	}

	/**
	 * @param BaseEntity $entity
	 * @return array
	 */
	public function fullExtract(BaseEntity $entity)
	{
		$details = array();
		$values = $this->extract($entity);
		foreach ($values as $k => $value) {
			if ($value instanceof BaseEntity) {
				$value = $this->extract($value);
			} elseif ($value instanceof ArrayCollection || $value instanceof PersistentCollection) {
				$value = array_map(function (BaseEntity $entity) {
					return $this->extract($entity);
				}, $value->toArray());
			}

			$details[$k] = $value;
		}

		return $details;
	}

	/**
	 * @param \ArrayAccess $data
	 * @param BaseEntity $entity
	 * @return void
	 */
	public function load(\ArrayAccess $data, BaseEntity &$entity)
	{
		$properties = $entity->getReflection()->getProperties();

		foreach ($properties as $property) {
			if($property->isPrivate() || !isset($values[$property->name])) {
				continue;
			}

			$this->setValue($property, $values[$property->name]);
		}
	}

	/**
	 * @param Property $property
	 * @param $value
	 * @return void
	 */
	private function setValue(Property &$property, &$value)
	{
		$property->setAccessible(true);
		$property->setValue($this, $value);
	}
}