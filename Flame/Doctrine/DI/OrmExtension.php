<?php
/**
 * Class OrmExtension
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Doctrine\DI;

use Nette\PhpGenerator\PhpLiteral;

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

		$builder->addDefinition($this->prefix('entityHydrator'))
			->setClass('Flame\Doctrine\Mapping\EntityHydrator');

		$builder->addDefinition($this->prefix('entityMapper'))
			->setClass('Flame\Doctrine\Mapping\EntityMapper');

		$builder->addDefinition($this->prefix('entityCrudFactory'))
			->setClass('Flame\Doctrine\Crud\EntityCrudFactory');

		// syntax sugar for config
		$builder->addDefinition($this->prefix('crud'))
			->setClass('Flame\Doctrine\Crud\EntityCrud')
			->setFactory('@Flame\Doctrine\Crud\EntityCrudFactory::createEntityCrud', array(new PhpLiteral('$entityName')))
			->setParameters(array('entityName'));

		parent::loadConfiguration();

		$configuration = $builder->getDefinition('doctrine.default.ormConfiguration');
		$configuration->addSetup('addCustomStringFunction', array('DATE_FORMAT', 'Flame\Doctrine\StringFunctions\DateFormat'));
	}

}