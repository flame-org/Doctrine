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
	 * @throws \Nette\InvalidStateException
	 */
	public function checkRequiredValues($values, BaseEntity &$entity)
	{
		$properties = $entity->getReflection()->getProperties();
		foreach ($properties as $property) {
			if($property->hasAnnotation('required') && !isset($values[$property->name])) {
				throw new InvalidStateException('Missing required key "' . $property->name . '"');
			}
		}
	}

	/**
	 * @param $values
	 * @param BaseEntity $entity
	 */
	public function setValues($values, BaseEntity &$entity)
	{
		$properties = $entity->getReflection()->getProperties();
		foreach ($properties as $property) {
			if(!isset($values[$property->name]) || !$property->hasAnnotation('writable')) {
				continue;
			}

			$value = $values[$property->name];
			if($value !== null && $validatorClass = $property->getAnnotation('validator')) {
				$value = $this->context->getValidator($validatorClass)->validate($value);
			}

			$entity->{$property->name} = $value;
		}
	}

}