<?php
/**
 * Class IManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine;

use Flame\Doctrine\Managers\IEntityCreator;
use Flame\Doctrine\Values\IDataSet;

interface IManager
{

	/**
	 * @param IEntityCreator $creator
	 * @return \Flame\Doctrine\Entity
	 */
	public function create(IEntityCreator $creator);

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
	public function setFlushMode($flush);
}