<?php
/**
 * Class IManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Managers;

use Flame\Doctrine\Model\IModel;

interface IManager
{

	/**
	 * @return IModel
	 */
	public function getModel();
}