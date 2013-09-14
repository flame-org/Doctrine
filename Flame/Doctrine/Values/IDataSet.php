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
	 * @param $values
	 * @return $this
	 */
	public function setValues($values);

	/**
	 * @return array
	 */
	public function getValues();

	/**
	 * @return array
	 */
	public function getEditableValues();
}