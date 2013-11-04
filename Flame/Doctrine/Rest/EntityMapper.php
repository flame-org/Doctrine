<?php
/**
 * Class EntityMapper
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 04.10.13
 */
namespace Flame\Doctrine\Rest;

use Kdyby\Doctrine\Entities\BaseEntity;
use Nette\InvalidStateException;
use Nette\Object;
use Flame\Doctrine\DI\Context;
use Nette\Reflection\Property;

class EntityMapper extends Object
{

	/** @var  Context */
	private $context;

	/**
	 * @param Context $context
	 */
	function __construct(Context $context)
	{
		$this->context = $context;
	}

	/**
	 * @param $values
	 * @param BaseEntity $entity
	 * @return BaseEntity
	 * @throws \Nette\InvalidStateException
	 */
	public function initValues($values, BaseEntity &$entity)
	{
		$parsedValues = array();
		$properties = $entity->getReflection()->getProperties();
		foreach ($properties as $property) {
			if($property->hasAnnotation('required') && !isset($values[$property->name])) {
				throw new InvalidStateException('Missing required key "' . $property->name . '"');
			}

			if(!isset($values[$property->name]) && (!$property->hasAnnotation('writable') || !$property->hasAnnotation('required'))) {
				continue;
			}

			$value = $values[$property->name];
			if($value !== null) {
				$parsedValues[$property->name] = $this->validateProperty($property, $value);
			}
		}

		return $this->setValues($parsedValues, $entity);
	}

	/**
	 * @param $values
	 * @param BaseEntity $entity
	 * @return BaseEntity
	 */
	public function updateValues($values, BaseEntity &$entity)
	{
		$parsedValues = array();
		$properties = $entity->getReflection()->getProperties();
		foreach ($properties as $property) {
			if(!isset($values[$property->name]) || !$property->hasAnnotation('writable')) {
				continue;
			}

			$value = $values[$property->name];
			if($value !== null) {
				$parsedValues[$property->name] = $this->validateProperty($property, $value);
			}
		}

		return $this->setValues($parsedValues, $entity);
	}

	/**
	 * @param $values
	 * @param BaseEntity $entity
	 * @return BaseEntity
	 */
	public function setValues(&$values, BaseEntity &$entity)
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
	 * @param Property $property
	 * @param $value
	 * @return mixed
	 */
	private function validateProperty(Property $property, $value)
	{
		if($validatorClass = $property->getAnnotation('validator')) {
			$value = $this->context->getValidator($validatorClass)->validate($value);
		}

		return $value;
	}

}