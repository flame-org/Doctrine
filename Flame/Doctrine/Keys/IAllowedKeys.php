<?php
/**
 * Class IAllowedKeys
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.08.13
 */

namespace Flame\Doctrine\Keys;


interface IAllowedKeys
{

	/**
	 * Get list of keys which will be updated
	 *
	 * @return array
	 */
	public function getAllowedKeys();
} 