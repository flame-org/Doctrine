<?php
/**
 * Class IEntityCreator
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\Crud\Create;

interface IEntityCreator
{

	/**
	 * @param bool $flush
	 * @return $this
	 */
	public function setFlush($flush);

	/**
	 * @param $values
	 * @return \Flame\Doctrine\Entity
	 */
	public function create($values);

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function addBeforeCreate($callback);

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function addAfterCreate($callback);
}