<?php
/**
 * NamedEntity.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.03.13
 */

namespace Flame\Doctrine\Entities;

/**
 * @MappedSuperClass
 *
 * @method string getId()
 * @method setId(string $name)
 *
 * @method string getName()
 * @method setName(string $name)
 */
abstract class NamedEntity extends IdentifiedEntity
{

	/**
	 * @Column(type="string")
	 */
	protected $name;
}
