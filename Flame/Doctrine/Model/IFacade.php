<?php
/**
 * IFacade.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame
 *
 * @date    13.08.12
 */

namespace Flame\Doctrine\Model;

use Flame\Doctrine\Entities\IEntity;

interface IFacade
{

	/**
	 * @param $id
	 * @return \Flame\Doctrine\Entities\IEntity
	 */
	public function getOne($id);

	/**
	 * @param \Flame\Doctrine\Entities\IEntity $reference
	 * @param bool $flush
	 * @return mixed
	 */
	public function save(IEntity $reference, $flush = true);

	/**
	 * @param \Flame\Doctrine\Entities\IEntity $reference
	 * @param bool $flush
	 * @return mixed
	 */
	public function delete(IEntity $reference, $flush = true);

}
