<?php
/**
 * Class IDataSet
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Values;

use Flame\Doctrine\IValidator;

interface IDataSet
{

	/**
	 * @param string $name Property name
	 * @param IValidator $validator
	 * @return $this
	 */
	public function addValidator(IValidator $validator);

	/**
	 * @param $values
	 * @return $this
	 */
	public function setValues($values);

	/**
	 * @return array
	 */
	public function getValues();
}