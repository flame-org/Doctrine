<?php
/**
 * Class IEntityCreator
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Managers;

interface IEntityCreator
{

	/**
	 * @return \Flame\Doctrine\EntityDao
	 */
	public function getDao();

	/**
	 * @return \Flame\Doctrine\Entity
	 */
	public function create();
}