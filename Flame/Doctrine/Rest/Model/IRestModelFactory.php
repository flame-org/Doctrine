<?php
/**
 * Class IRestModelFactory
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 16.10.13
 */
namespace Flame\Doctrine\Rest\Model;

use Flame\Doctrine\EntityDao;

interface IRestModelFactory
{

	/**
	 * @param EntityDao $dao
	 * @return IRestModel
	 */
	public function createRestModel(EntityDao $dao);
}