<?php
/**
 * Class IDesiredKeys
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.08.13
 */

namespace Flame\Doctrine\Keys;


interface IDesiredKeys
{

	/**
	 * Get list of desired keys which will be set to entity
	 *
	 * @return array
	 */
	public function getDesiredKeys();
} 