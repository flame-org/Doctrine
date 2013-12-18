<?php
/**
 * Class RestEntityMapper
 *
 * @author Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date 18.12.13
 */
namespace Flame\Doctrine\Mapping;

use Flame\Doctrine\DI\IContext;
use Kdyby\Doctrine\Entities\BaseEntity;
use Nette\Object;
use Nette\InvalidStateException;
use Nette\Reflection\Property;

class RestEntityMapper extends Object implements IRestEntityMapper
{

	/** @var \Flame\Doctrine\DI\IContext  */
	private $context;

	/** @var \Flame\Doctrine\Mapping\IEntityMapper  */
	private $entityMapper;

	/**
	 * @param IContext $context
	 * @param IEntityMapper $entityMapper
	 */
	function __construct(IContext $context, IEntityMapper $entityMapper)
	{
		$this->context = $context;
		$this->entityMapper = $entityMapper;
	}

	/**
	 * @param $values
	 * @param BaseEntity $entity
	 * @return BaseEntity
	 */
	public function setValues($values, BaseEntity $entity)
	{
		return $this->entityMapper->setValues($values, $entity);
	}

	/**
	 * @param BaseEntity $entity
	 * @return array
	 */
	public function getValues(BaseEntity &$entity)
	{
		return $this->entityMapper->getValues($entity);
	}

	/**
	 * @param $values
	 * @param BaseEntity $entity
	 * @return BaseEntity
	 * @throws \Nette\InvalidStateException
	 */
	public function initValues($values, BaseEntity $entity)
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
	public function updateValues($values, BaseEntity $entity)
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