<?php
/**
 * Class IDeleteManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 07.09.13
 */
namespace Flame\Doctrine\Managers;

interface IDeleteManager
{

	/**
	 * @param int|string $id
	 * @return $this
	 */
	public function delete($id = null);
}