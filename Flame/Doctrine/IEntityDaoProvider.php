<?php
/**
 * Class IEntityDaoProvider
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 13.09.13
 */
namespace Flame\Doctrine;

interface IEntityDaoProvider
{

	/**
	 * @return \Flame\Doctrine\EntityDao
	 */
	public function getDao();
}