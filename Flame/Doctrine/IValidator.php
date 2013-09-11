<?php
/**
 * Class IValidator
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 02.08.13
 */
namespace Flame\Doctrine;

interface IValidator
{

	/**
	 * @param $data
	 * @return mixed
	 */
	public function validate($data);
} 