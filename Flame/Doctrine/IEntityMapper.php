<?php
/**
 * Class IEntityMapper
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 02.10.13
 */
namespace Flame\Doctrine;

use Kdyby\Doctrine\Entities\BaseEntity;

interface IEntityMapper
{

	/**
	 * @param BaseEntity $entity
	 * @return array
	 */
	public function extract(BaseEntity $entity);

	/**
	 * @param BaseEntity $entity
	 * @return array
	 */
	public function fullExtract(BaseEntity $entity);

	/**
	 * @param \ArrayAccess $data
	 * @param BaseEntity $entity
	 * @return void
	 */
	public function load(\ArrayAccess $data, BaseEntity &$entity);
}