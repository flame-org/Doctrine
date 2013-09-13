<?php
/**
 * Class IEntityCreatorFactory
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 13.09.13
 */

namespace Flame\Doctrine\Crud\Create;

use Flame\Doctrine\EntityDao;

interface IEntityCreatorFactory
{

	/**
	 * @param EntityDao $dao
	 * @return IEntityCreator
	 */
	public function createEntityCreator(EntityDao $dao);
}