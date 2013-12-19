<?php
/**
 * Class IEntityCrud
 *
 * @author Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date 19.12.13
 */
namespace Flame\Doctrine\Crud;

interface IEntityCrud 
{

	/**
	 * @return \Flame\Doctrine\EntityDao
	 */
	public function getEntityReader();

	/**
	 * @return \Flame\Doctrine\Crud\Delete\EntityDeleter
	 */
	public function getEntityDeleter();

	/**
	 * @return \Flame\Doctrine\Crud\Update\EntityUpdater
	 */
	public function getEntityUpdater();

	/**
	 * @return \Flame\Doctrine\Crud\Create\EntityCreator
	 */
	public function getEntityCreator();
} 