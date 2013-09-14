<?php
/**
 * Class IEntityUpdate
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 14.09.13
 */

namespace Flame\Doctrine\Crud\Update;

use Flame\Doctrine\Values\IDataSet;

interface IEntityUpdater
{

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function setFlush($flush);

	/**
	 * @param IDataSet $values
	 * @param int|\Flame\Doctrine\Entity $entity
	 * @return \Flame\Doctrine\Entity
	 */
	public function update(IDataSet $values, $entity);
}