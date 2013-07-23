<?php
/**
 * Class Model
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 17.07.13
 */
namespace Flame\Doctrine\Model;

use Flame\Doctrine\EntityDao;
use Nette\Object;

abstract class BaseModel extends Object implements IModel
{

	/** @var  \Flame\Doctrine\EntityDao */
	protected $dao;

	/**
	 * @param EntityDao $dao
	 */
	function __construct(EntityDao $dao)
	{
		$this->dao = $dao;
	}

	/**
	 * @return \Flame\Doctrine\EntityDao
	 */
	public function getDao()
	{
		return $this->dao;
	}
}