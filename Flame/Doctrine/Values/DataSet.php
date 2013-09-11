<?php
/**
 * Class DataSet
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Values;

use Flame\Doctrine\IValidator;
use Nette\InvalidStateException;
use Nette\Object;
use Nette\Utils\Validators;

abstract class DataSet extends Object implements IDataSet
{

	/** @var IValidator[]  */
	private $validators = array();

	/**
	 * @param array $values
	 */
	public function __construct($values = array())
	{
		$this->setValues($values);
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
			$isRequired = $property->getAnnotation('required');
			if($isRequired && !isset($values[$property->name])) {
				throw new InvalidStateException('Missing desired key "' . $property->name . '"');
			}

			if(isset($values[$property->name])) {
				$property->setAccessible(true);
				$property->setValue($this, $values[$property->name]);
			}
		}

		return $this;
	}

	/**
	 * @param IValidator $validator
	 * @return $this
	 * @throws \Nette\InvalidStateException
	 */
	public function addValidator(IValidator $validator)
	{
		$type = get_class($validator);
		if(isset($this->validators[$type])) {
			throw new InvalidStateException('Validator with same type "' . $type . '"  exist in the class "' . __CLASS__ . '" yet.');
		}

		$this->validators[$type] = $validator;
		return $this;
	}


	/**
	 * @return array
	 */
	public function getValues()
	{
		$properties = $this->getReflection()->getProperties();

		$valid = array();
		foreach ($properties as $property) {
			$property->setAccessible(true);
			$value = $property->getValue($this);

			$validator = trim($property->getAnnotation('validator'), '\\');

			if($validator && isset($this->validators[(string) $validator])) {
				$value = $this->validators[$validator]->validate($value);
			}

			if ($value !== null) {
				if($type = $property->getAnnotation('var')) {
					Validators::assert($value, $type);
				}

				$valid[$property->name] = $value;
			}
		}

		return $valid;
	}
}