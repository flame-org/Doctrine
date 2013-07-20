<?php
/**
 * Class BaseManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Model;

use Nette\Object;

abstract class BaseManager extends Object implements IManager
{

	/** @var \Flame\Doctrine\Model\IModel  */
	protected $model;

	/**
	 * @param IModel $model
	 */
	public function __construct(IModel $model)
	{
		$this->model = $model;
	}

	/**
	 * @return IModel
	 */
	public function getModel()
	{
		return $this->model;
	}
}