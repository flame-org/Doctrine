<?php
/**
 * Class IEntityDeleterFactory
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 13.09.13
 */
namespace Flame\Doctrine\Crud\Delete;

use Flame\Doctrine\EntityDao;

interface IEntityDeleterFactory
{

	/**
	 * @param EntityDao $dao
	 * @return IEntityDeleter
	 */
	public function createEntityDeleter(EntityDao $dao);
}