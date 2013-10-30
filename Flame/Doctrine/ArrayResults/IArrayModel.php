<?php
/**
 * Class IArrayModel
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 16.10.13
 */
namespace Flame\Doctrine\ArrayResults;

interface IArrayModel
{

	/**
	 * @param int $offset
	 * @param int $limit
	 * @return $this
	 */
	public function applyPaging($offset, $limit);

	/**
	 * @param IQueryObject|\Doctrine\ORM\QueryBuilder|\Doctrine\ORM\Query $queryObject
	 * @return array
	 */
	public function fetch($queryObject);

	/**
	 * @param IQueryObject|\Doctrine\ORM\QueryBuilder|\Doctrine\ORM\Query $queryObject
	 * @return array
	 */
	public function fetchOne($queryObject);
}