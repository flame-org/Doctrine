<?php
/**
 * Class ICreateService
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 02.08.13
 */
namespace Flame\Doctrine\Managers;

interface IService
{

	/**
	 * @param $data
	 * @return mixed
	 */
	public function process($data);
} 