<?php
/**
 * Class IEntityManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 21.07.13
 */
namespace Flame\Doctrine\Managers;

use Flame\Doctrine\Entity;
use Flame\Doctrine\IEntityProvider;

interface IEntityManager extends IEntityProvider
{

	/**
	 * @param Entity $entity
	 * @return $this
	 */
	public function setEntity(Entity $entity);
}