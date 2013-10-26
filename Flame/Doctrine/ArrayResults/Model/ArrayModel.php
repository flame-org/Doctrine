<?php
/**
 * Class ArrayModel
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 16.10.13
 */
namespace Flame\Doctrine\ArrayResults\Model;

use Flame\Doctrine\EntityDao;
use Flame\Doctrine\ArrayResults\IQueryObject;
use Doctrine;
use Kdyby\Doctrine\DqlSelection;
use Kdyby\Doctrine\UnexpectedValueException;
use Nette\Object;

class ArrayModel extends Object implements IArrayModel
{

	/** @var  array|null */
	private $paging;

	/** @var  EntityDao */
	private $dao;

	/**
	 * @param EntityDao $dao
	 */
	function __construct(EntityDao $dao)
	{
		$this->dao = $dao;
	}

	/**
	 * @param IQueryObject $queryObject
	 * @return array
	 */
	public function fetch(IQueryObject $queryObject)
	{
		return $this->getQuery($queryObject)->getArrayResult();
	}

	/**
	 * @param IQueryObject $queryObject
	 * @return array
	 */
	public function fetchOne(IQueryObject $queryObject)
	{
		$result = $this->applyPaging(0, 1)->fetch($queryObject);
		return array_shift($result);
	}

	/**
	 * @param int $offset
	 * @param int $limit
	 * @return $this
	 */
	public function applyPaging($offset, $limit)
	{
		$this->paging = array((int) $offset, (int) $limit);
		return $this;
	}

	/**
	 * @param IQueryObject $queryObject
	 * @return array|Doctrine\ORM\Query
	 * @throws \Kdyby\Doctrine\UnexpectedValueException
	 */
	private function getQuery(IQueryObject $queryObject)
	{
		$query = $queryObject->getQuery($this->dao);
		if ($query instanceof Doctrine\ORM\QueryBuilder) {
			$query = $query->getQuery();

		} elseif ($query instanceof DqlSelection) {
			$query = $query->createQuery();
		}

		if (!$query instanceof Doctrine\ORM\Query) {
			throw new UnexpectedValueException(
				"Method " . $this->getReflection()->getMethod('getQuery') . " must return " .
				"instanceof Doctrine\\ORM\\Query or Kdyby\\Doctrine\\QueryBuilder or Kdyby\\Doctrine\\DqlSelection, " .
				is_object($query) ? 'instance of ' . get_class($query) : gettype($query) . " given."
			);
		}

		return $this->resetPaging($query);
	}

	/**
	 * @param $result
	 * @return array|Doctrine\ORM\Query
	 * @throws \Kdyby\Doctrine\UnexpectedValueException
	 */
	private function resetPaging(Doctrine\ORM\Query $result)
	{
		if($this->paging !== null) {
			list($offset, $limit) = $this->paging;

			$result->setFirstResult($offset)
				->setMaxResults($limit);
		}

		return $result;
	}
}