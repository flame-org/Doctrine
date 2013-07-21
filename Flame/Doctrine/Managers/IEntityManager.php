<?php
/**
 * Class IEntityManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 21.07.13
 */
namespace Flame\Doctrine\Managers;

interface IEntityManager
{

	/**
	 * @return \Flame\Doctrine\Entity
	 */
	public function getEntity();
}