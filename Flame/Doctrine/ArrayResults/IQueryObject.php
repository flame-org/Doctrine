<?php
/**
 * Class IQueryObject
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 16.10.13
 */
namespace Flame\Doctrine\ArrayResults;

use Kdyby\Persistence\Queryable;

interface IQueryObject
{

	/**
	 * @param Queryable $repository
	 * @return \Doctrine\ORM\Query|\Doctrine\ORM\QueryBuilder
	 */
	public function getQuery(Queryable $repository);
}