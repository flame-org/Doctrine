<?php
/**
 * Class IManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Managers;

interface IManager
{

	/**
	 * @return \Flame\Doctrine\Model\IModel
	 */
	public function getModel();
}