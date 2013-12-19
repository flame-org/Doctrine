<?php
/**
 * Class IEntityCrudFactory
 *
 * @author Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date 19.12.13
 */
namespace Flame\Doctrine\Crud;

interface IEntityCrudFactory 
{

	/**
	 * @param $entityName
	 * @return IEntityCrud
	 */
	public function createEntityCrud($entityName);
} 