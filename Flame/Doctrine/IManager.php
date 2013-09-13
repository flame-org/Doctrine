<?php
/**
 * Class IManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine;

use Flame\Doctrine\Values\IDataSet;

interface IManager
{

	/**
	 * @param IDataSet $values
	 * @return \Flame\Doctrine\Entity
	 */
	public function create(IDataSet $values);

	/**
	 * @param IDataSet $values
	 * @param $entity
	 * @return \Flame\Doctrine\Entity
	 */
	public function update(IDataSet $values, $entity);

	/**
	 * @param \Flame\Doctrine\Entity|int $entity
	 * @return bool
	 */
	public function delete($entity);

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function setFlush($flush);

	/**
	 * @param IEntityDaoProvider $provider
	 * @return $this
	 */
	public function setDaoProvider(IEntityDaoProvider $provider);
}