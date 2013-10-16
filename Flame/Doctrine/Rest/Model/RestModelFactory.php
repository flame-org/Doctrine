<?php
/**
 * Class RestModelFactory
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 16.10.13
 */
namespace Flame\Doctrine\Rest\Model;

use Flame\Doctrine\EntityDao;
use Nette\Object;

class RestModelFactory extends Object implements IRestModelFactory
{

	/**
	 * @param EntityDao $dao
	 * @return IRestModel
	 */
	public function createRestModel(EntityDao $dao)
	{
		return new RestModel($dao);
	}
}