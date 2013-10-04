<?php
/**
 * Class IEntityDeleter
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 13.09.13
 */
namespace Flame\Doctrine\Crud\Delete;

interface IEntityDeleter
{

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function setFlush($flush);

	/**
	 * @param int|\Flame\Doctrine\Entity $entity
	 * @return bool
	 */
	public function delete($entity);
}