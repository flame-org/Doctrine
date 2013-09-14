<?php
/**
 * Class IEntityUpdaterFactory
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 14.09.13
 */
namespace Flame\Doctrine\Crud\Update;

use Flame\Doctrine\EntityDao;

interface IEntityUpdaterFactory
{

	/**
	 * @param EntityDao $dao
	 * @return IEntityUpdater
	 */
	public function createEntityUpdater(EntityDao $dao);
}