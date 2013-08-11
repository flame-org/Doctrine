<?php
/**
 * Class IOptionalKeys
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.08.13
 */
namespace Flame\Doctrine\Keys;

interface IOptionalKeys
{

	/**
	 * Get list of optional keys which will be set to entity
	 *
	 * @return array
	 */
	public function getOptionalKeys();
} 