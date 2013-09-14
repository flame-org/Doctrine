<?php
/**
 * Class IDataSet
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Values;

interface IDataSet
{

	/**
	 * @param string $name
	 * @param $value
	 * @return $this
	 */
	public function setValue($name, $value);

	/**
	 * @param $values
	 * @return $this
	 */
	public function setValues($values);

	/**
	 * @param $name
	 * @param bool $load
	 * @return mixed
	 */
	public function getValue($name, $load = true);

	/**
	 * @return array
	 */
	public function getValues();

	/**
	 * @return array
	 */
	public function getEditableValues();
}