<?php
/**
 * Class IEntityMapper
 *
 * @author Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date 18.12.13
 */
namespace Flame\Doctrine\Mapping;

use Kdyby\Doctrine\Entities\BaseEntity;

interface IEntityMapper 
{

	/**
	 * @param $values
	 * @param BaseEntity $entity
	 * @return BaseEntity
	 */
	public function setValues($values, BaseEntity $entity);

	/**
	 * @param BaseEntity $entity
	 * @return array
	 */
	public function getValues(BaseEntity &$entity);

	/**
	 * @param BaseEntity $entity
	 * @return array
	 */
	public function getSimpleValues(BaseEntity &$entity);
} 