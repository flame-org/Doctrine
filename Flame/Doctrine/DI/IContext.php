<?php
/**
 * Class IContext
 *
 * @author Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date 18.12.13
 */
namespace Flame\Doctrine\DI;

use Flame\Doctrine\IValidator;

interface IContext 
{

	/**
	 * @param $class
	 * @return IValidator
	 */
	public function getValidator($class);
} 