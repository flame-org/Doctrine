<?php
/**
 * Class Context
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 11.09.13
 */
namespace Flame\Doctrine\DI;

use Nette\Object;
use Flame\Doctrine\IValidator;
use Nette\InvalidStateException;
use Nette\DI\Container;

class Context extends Object
{

	/** @var  Container */
	private $container;

	/**
	 * @param Container $container
	 */
	function __construct(Container $container)
	{
		$this->container = $container;
	}

	/**
	 * @param $class
	 * @return IValidator
	 * @throws \Nette\InvalidStateException
	 */
	public function getValidator($class)
	{
		$validator = $this->container->getByType($class);
		if($validator instanceof IValidator) {
			return $validator;
		}

		throw new InvalidStateException('Object "' . $class . '" is not instance of Flame\Doctrine\IValidator');
	}

}