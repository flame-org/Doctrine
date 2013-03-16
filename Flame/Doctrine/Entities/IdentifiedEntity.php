<?php
/**
 * IdentifiedEntity.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.03.13
 */

namespace Flame\Doctrine\Entities;

use Doctrine\ORM\Proxy\Proxy;

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

	/**
	 * @return integer
	 */
	final public function getId()
	{
		if ($this instanceof Proxy && !$this->__isInitialized__ && !$this->id) {
			$identifier = $this->getReflection()->getProperty('_identifier');
			$identifier->setAccessible(TRUE);
			$id = $identifier->getValue($this);
			$this->id = reset($id);
		}

		return $this->id;
	}

}
