<?php
/**
 * Class ICreateManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Model;

interface ICreateManager extends ISaveManager
{

	/**
	 * @return \Flame\Doctrine\Entity
	 */
	public function getEntity();

	/**
	 * @return $this
	 */
	public function create();
}