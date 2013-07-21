<?php
/**
 * Class IUpdateManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 21.07.13
 */

namespace Flame\Doctrine\Managers;

use Flame\Doctrine\Entity;

interface IUpdateManager extends ISaveManager, IEntityManager
{

	/**
	 * @param Entity $entity
	 * @return $this
	 */
	public function update(Entity $entity = null);
}