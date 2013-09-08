<?php
/**
 * Class IEntityProvider
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 07.09.13
 */
namespace Flame\Doctrine;

interface IEntityProvider
{

	/**
	 * @return \Flame\Doctrine\Entity
	 */
	public function getEntity();
}