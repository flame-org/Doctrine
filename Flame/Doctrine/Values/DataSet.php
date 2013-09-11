<?php
/**
 * Class DataSet
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Values;

use Flame\Doctrine\IValidator;
use Nette\DI\Container;
use Nette\InvalidStateException;
use Nette\Object;
use Nette\Utils\Validators;

abstract class DataSet extends Object implements IDataSet
{

	/** @var  Container */
	private $context;

	/**
	 * @param Container $context
	 */
	function __construct(Container $context)
	{
		$this->context = $context;
	}

	/**
	 * @param $values
	 * @throws InvalidStateException
	 * @return $this
	 */
	public function setValues($values)
	{
		$properties = $this->getReflection()->getProperties();

		foreach ($properties as $property) {
			$property->setAccessible(true);

			$isRequired = $property->getAnnotation('required');
			if($isRequired && !isset($values[$property->name])) {
				throw new InvalidStateException('Missing desired key "' . $property->name . '"');
			}

			if(!isset($values[$property->name])) {
				continue;
			}

			$value = $values[$property->name];
			if($class = $property->getAnnotation('validator')) {
				$value = $this->getValidator($class)->validate($value);
			}
			
			if($value === null) {
				continue;
			}

			if($type = $property->getAnnotation('var')) {
				Validators::assert($value, $type);
			}

			$property->setValue($this, $value);
		}

		return $this;
	}


	/**
	 * @return array
	 */
	public function getValues()
	{
		$vars = $this->getReflection()->getProperties();
		$valid = array();
		foreach ($vars as $var) {
			$var->setAccessible(true);
			$value = $var->getValue($this);
			if($value !== null) {
				$valid[$var->name] = $value;
			}
		}

		return $valid;
	}

	/**
	 * @param $class
	 * @return IValidator
	 * @throws \Nette\InvalidStateException
	 */
	private function getValidator($class)
	{
		$validator = $this->context->getByType($class);
		if($validator instanceof IValidator) {
			return $validator;
		}

		throw new InvalidStateException('Object "' . $class . '" is not instance of Flame\Doctrine\IValidator');
	}
}