<?php
/**
 * Class DataSet
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Values;

use Flame\Doctrine\DI\Context;
use Nette\InvalidStateException;
use Nette\Object;
use Nette\Reflection\Property;
use Nette\Utils\Validators;

abstract class DataSet extends Object implements IDataSet
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
	 * @return $this
	 */
	public function setValues($values)
	{
		$properties = $this->getReflection()->getProperties();

		foreach ($properties as $property) {
			if(isset($values[$property->name])) {
				$this->setValue($property->name, $values[$property->name]);
			}
		}

		return $this;
	}

	/**
	 * @return array
	 * @throws \Nette\InvalidStateException
	 */
	public function getValues()
	{
		$vars = $this->getReflection()->getProperties();
		$valid = array();
		foreach ($vars as $var) {
			$value = $this->getValue($var->name);
			if($var->getAnnotation('required') && $value === null) {
				throw new InvalidStateException('Missing desired key "' . $var->name . '"');
			}

			if($value !== null) {
				$valid[$var->name] = $value;
			}
		}

		return $valid;
	}

	/**
	 * @return array
	 */
	public function getEditableValues()
	{
		$vars = $this->getReflection()->getProperties();
		$valid = array();
		foreach ($vars as $var) {
			if(!$var->getAnnotation('editable')) {
				continue;
			}

			$value = $this->getValue($var->name);
			if($value !== null) {
				$valid[$var->name] = $value;
			}
		}

		return $valid;
	}

	/**
	 * @param $name
	 * @param bool $load
	 * @return mixed
	 */
	public function getValue($name, $load = true)
	{
		$property = $this->getReflection()->getProperty($name);
		$property->setAccessible(true);

		if($load === true) {
			$this->attachValidators($property);
			$this->assertType($property);
		}

		return $property->getValue($this);
	}

	/**
	 * @param string $name
	 * @param $value
	 * @return $this
	 */
	public function setValue($name, $value)
	{
		$property = $this->getReflection()->getProperty($name);
		$property->setAccessible(true);
		$property->setValue($this, $value);
		return $this;
	}

	/**
	 * @param Property $property
	 */
	private function attachValidators(Property &$property)
	{
		$value = $property->getValue($this);
		if($class = $property->getAnnotation('validator')) {
			$value = $this->context->getValidator($class)->validate($value);
			$property->setValue($this, $value);
		}
	}

	/**
	 * @param Property $property
	 */
	private function assertType(Property &$property)
	{
		if($type = $property->getAnnotation('var')) {
			Validators::assert($property->getValue($this), $type);
		}
	}
}