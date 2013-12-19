<?php
/**
 * Class IEntityHydrator
 *
 * @author Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date 18.12.13
 */
namespace Flame\Doctrine\Mapping;

use Kdyby\Doctrine\Entities\BaseEntity;

interface IEntityHydrator
{

	/**
	 * @param $values
	 * @param BaseEntity $entity
	 * @return BaseEntity
	 */
	public function hydrate($values, BaseEntity $entity);

	/**
	 * @param BaseEntity $entity
	 * @return array
	 */
	public function extract(BaseEntity &$entity);

	/**
	 * @param BaseEntity $entity
	 * @return array
	 */
	public function simpleExtract(BaseEntity &$entity);
} 