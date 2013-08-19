<?php
/**
 * Class OrmExtension
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\DI;

class OrmExtension extends \Kdyby\Doctrine\DI\OrmExtension
{

	public $defaults = array(
		'defaultRepositoryClassName' => 'Flame\Doctrine\EntityDao',
		'autoGenerateProxyClasses' => true
	);

	public function loadConfiguration()
	{
		$this->managerDefaults = array_merge($this->managerDefaults, $this->defaults);

		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('entities'))
			->setClass('\Flame\Doctrine\Utils\Entities');

		parent::loadConfiguration();
	}

}