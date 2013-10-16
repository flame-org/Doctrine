<?php
/**
 * Class IRestModel
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 16.10.13
 */
namespace Flame\Doctrine\Rest\Model;

use Flame\Doctrine\Rest\IQueryObject;

interface IRestModel
{

	/**
	 * @param int $offset
	 * @param int $limit
	 * @return $this
	 */
	public function applyPaging($offset, $limit);

	/**
	 * @param IQueryObject $queryObject
	 * @return array
	 */
	public function fetch(IQueryObject $queryObject);

	/**
	 * @param IQueryObject $queryObject
	 * @return array
	 */
	public function fetchOne(IQueryObject $queryObject);
}