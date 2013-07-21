<?php
/**
 * Class IData
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 21.07.13
 */

namespace Flame\Doctrine\Types;


interface IData
{

	/**
	 * @param string $name
	 * @return mixed
	 */
	public function get($name);

	/**
	 * @param string $name
	 * @param null $default
	 * @return mixed
	 */
	public function getOptional($name, $default = null);

	/**
	 * @return mixed
	 */
	public function getRaw();

}