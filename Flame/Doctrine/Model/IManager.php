<?php
/**
 * Class IManager
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\Model;

interface IManager
{

	/**
	 * @return IModel
	 */
	public function getModel();
}