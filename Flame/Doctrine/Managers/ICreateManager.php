<?php
/**
 * Class ICreateManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Managers;

interface ICreateManager extends IManager
{

	/**
	 * @return $this
	 */
	public function create();

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function save($flush = true);
}