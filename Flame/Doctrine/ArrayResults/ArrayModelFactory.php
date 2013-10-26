<?php
/**
 * Class ArrayModelFactory
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 16.10.13
 */
namespace Flame\Doctrine\ArrayResults;

use Flame\Doctrine\EntityDao;
use Nette\Object;

class ArrayModelFactory extends Object implements IArrayModelFactory
{

	/**
	 * @param EntityDao $dao
	 * @return IArrayModel
	 */
	public function createArrayModel(EntityDao $dao)
	{
		return new ArrayModel($dao);
	}
}