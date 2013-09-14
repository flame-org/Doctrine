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
			$property->setAccessible(true);

			if(!isset($values[$property->name])) {
				continue;
			}

			$value = $values[$property->name];
			if($class = $property->getAnnotation('validator')) {
				$value = $this->context->getValidator($class)->validate($value);
			}

			if($value !== null) {
				if($type = $property->getAnnotation('var')) {
					Validators::assert($value, $type);
				}

				$property->setValue($this, $value);
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
			$var->setAccessible(true);
			$value = $var->getValue($this);

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
			$var->setAccessible(true);
			if(!$var->getAnnotation('editable')) {
				continue;
			}

			$value = $var->getValue($this);
			if($value !== null) {
				$valid[$var->name] = $value;
			}
		}

		return $valid;
	}
}