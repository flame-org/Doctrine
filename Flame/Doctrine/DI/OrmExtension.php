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

		$builder->addDefinition($this->prefix('creatorFactory'))
			->setClass('Flame\Doctrine\Crud\Create\EntityCreatorFactory');

		$builder->addDefinition($this->prefix('deleterFactory'))
			->setClass('Flame\Doctrine\Crud\Delete\EntityDeleterFactory');

		$builder->addDefinition($this->prefix('updaterFactory'))
			->setClass('Flame\Doctrine\Crud\Update\EntityUpdaterFactory');

		$builder->addDefinition($this->prefix('entityMapper'))
			->setClass('Flame\Doctrine\Rest\EntityMapper');

		parent::loadConfiguration();
	}

}