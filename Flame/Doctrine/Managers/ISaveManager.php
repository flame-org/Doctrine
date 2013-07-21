<?php
/**
 * Class ISaveManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Managers;

interface ISaveManager
{

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function save($flush = true);
}