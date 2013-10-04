<?php
/**
 * Class IEntityUpdate
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 14.09.13
 */

namespace Flame\Doctrine\Crud\Update;

interface IEntityUpdater
{

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function setFlush($flush);

	/**
	 * @param $values
	 * @param int|\Flame\Doctrine\Entity $entity
	 * @return \Flame\Doctrine\Entity
	 */
	public function update($entity, $values);

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function addBeforeUpdate($callback);

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function addAfterUpdate($callback);
}