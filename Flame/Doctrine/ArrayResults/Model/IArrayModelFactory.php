<?php
/**
 * Class IArrayModelFactory
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 16.10.13
 */
namespace Flame\Doctrine\ArrayResults\Model;

use Flame\Doctrine\EntityDao;

interface IArrayModelFactory
{

	/**
	 * @param EntityDao $dao
	 * @return IArrayModel
	 */
	public function createArrayModel(EntityDao $dao);
}