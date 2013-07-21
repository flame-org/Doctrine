<?php
/**
 * Class ICreateManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Managers;

interface ICreateManager extends ISaveManager, IEntityManager
{

	/**
	 * @return $this
	 */
	public function create();
}