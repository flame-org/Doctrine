<?php
/**
 * Class DataSet
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Values;

use Flame\Doctrine\DI\Context;
use Flame\Doctrine\EntityMapper;
use Kdyby\Doctrine\Entities\BaseEntity;
use Nette\InvalidStateException;
use Nette\Object;
use Nette\Reflection\Property;
use Nette\Utils\Validators;

abstract class DataSet extends BaseEntity implements IDataSet
{

	/** @var  Context */
	private $context;

	/** @var \Flame\Doctrine\EntityMapper  */
	private $entityMapper;

	/**
	 * @param Context $context
	 */
	function __construct(Context $context)
	{
		$this->context = $context;
		$this->entityMapper = new EntityMapper;
	}

	/**
	 * @param $values
	 * @return $this
	 */
	public function setValues($values)
	{
		$this->entityMapper->load($values, $this);

		return $this;
	}

	/**
	 * @return array
	 * @throws \Nette\InvalidStateException
	 */
	public function getValues()
	{
		$vars = $this->entityMapper->extract($this);
		$valid = array();
		foreach ($vars as $var) {
			$value = $this->getValue($var->name);
			if($var->getAnnotation('required') && $value === null) {
				throw new InvalidStateException('Missing desired key "' . $var->name . '"');
			}

			if($value !== null) {
				$this->assertType($var, $value);
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
				$this->assertType($var, $value);
				$valid[$var->name] = $value;
			}
		}

		return $valid;
	}

	/**
	 * @param $name
	 * @param bool $validators
	 * @return mixed
	 */
	public function getValue($name, $validators = true)
	{
		$property = $this->getReflection()->getProperty($name);
		$property->setAccessible(true);

		$value = $property->getValue($this);
		if($value !== null && $validators === true) {
			$value = $this->validate($property);
		}

		return $value;
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
	 * @return mixed
	 */
	private function validate(Property &$property)
	{
		$value = $property->getValue($this);
		if($class = $property->getAnnotation('validator')) {
			$value = $this->context->getValidator($class)->validate($value);
		}

		return $value;
	}

	/**
	 * @param Property $property
	 * @param $value
	 */
	private function assertType(Property &$property, $value)
	{
		if($type = $property->getAnnotation('var')) {
			Validators::assert($value, $type);
		}
	}
}