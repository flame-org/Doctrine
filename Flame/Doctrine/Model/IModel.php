<?php
/**
 * Class IModel
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 17.07.13
 */
namespace Flame\Doctrine\Model;

interface IModel
{

	/**
	 * @return \Flame\Doctrine\EntityDao
	 */
	public function getDao();

}