<?php
/**
 * Class IEntityCreator
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Crud\Create;

use Flame\Doctrine\Values\IDataSet;

interface IEntityCreator
{

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function setFlush($flush);

	/**
	 * @param IDataSet $values
	 * @return \Flame\Doctrine\Entity
	 */
	public function create(IDataSet $values);
}