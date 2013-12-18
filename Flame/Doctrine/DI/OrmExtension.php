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

	/** @var array  */
	public $defaults = array(
		'defaultRepositoryClassName' => 'Flame\Doctrine\EntityDao'
	);

	/**
	 * @return void
	 */
	public function loadConfiguration()
	{
		$this->managerDefaults = array_merge($this->managerDefaults, $this->defaults);

		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('context'))
			->setClass('\Flame\Doctrine\DI\Context');

		$builder->addDefinition($this->prefix('entityMapper'))
			->setClass('Flame\Doctrine\Mapping\EntityMapper');

		$builder->addDefinition($this->prefix('restEntityMapper'))
			->setClass('Flame\Doctrine\Mapping\RestEntityMapper');

		parent::loadConfiguration();

		$configuration = $builder->getDefinition('doctrine.default.ormConfiguration');
		$configuration->addSetup('addCustomStringFunction', array('DATE_FORMAT', 'Flame\Doctrine\StringFunctions\DateFormat'));
	}

}