<?php
/**
 * Class BaseCreateManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Managers;

use Flame\Doctrine\Types\IData;

abstract class BaseCreateManager extends BaseManager implements ICreateManager
{

	/** @var  IData */
	protected $data;

	/**
	 * @param IData $data
	 * @return $this
	 */
	public function setData(IData $data)
	{
		$this->data = $data;
		return $this;
	}
}