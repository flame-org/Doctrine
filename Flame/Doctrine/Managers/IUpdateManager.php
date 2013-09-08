<?php
/**
 * Class IUpdateManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 21.07.13
 */

namespace Flame\Doctrine\Managers;

interface IUpdateManager extends IManager
{

	/**
	 * @param int|string $id
	 * @return $this
	 */
	public function update($id = null);

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function save($flush = true);
}