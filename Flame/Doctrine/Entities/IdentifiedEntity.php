<?php
/**
 * IdentifiedEntity.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.03.13
 */

namespace Flame\Doctrine\Entities;

/**
 * @MappedSuperClass
 *
 * @property-read int $id
 */
abstract class IdentifiedEntity extends \Flame\Doctrine\Entities\BaseEntity
{

	/**
	 * @var int
	 *
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	private $id;

}
