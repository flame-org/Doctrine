<?php
/**
 * exceptions.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.03.13
 */

namespace Flame\Doctrine;

interface Exception
{

}

/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class MemberAccessException extends \LogicException implements Exception
{

	/**
	 * @param string $type
	 * @param string|object $class
	 * @param string $property
	 *
	 * @return MemberAccessException
	 */
	public static function propertyNotWritable($type, $class, $property)
	{
		$class = is_object($class) ? get_class($class) : $class;

		return new static("Cannot write to $type property $class::\$$property.");
	}



	/**
	 * @param string|object $class
	 *
	 * @return MemberAccessException
	 */
	public static function propertyWriteWithoutName($class)
	{
		$class = is_object($class) ? get_class($class) : $class;

		return new static("Cannot write to a class '$class' property without name.");
	}



	/**
	 * @param string $type
	 * @param string|object $class
	 * @param string $property
	 *
	 * @return MemberAccessException
	 */
	public static function propertyNotReadable($type, $class, $property)
	{
		$class = is_object($class) ? get_class($class) : $class;

		return new static("Cannot read $type property $class::\$$property.");
	}



	/**
	 * @param string|object $class
	 *
	 * @return MemberAccessException
	 */
	public static function propertyReadWithoutName($class)
	{
		$class = is_object($class) ? get_class($class) : $class;

		return new static("Cannot read a class '$class' property without name.");
	}



	/**
	 * @param string|object $class
	 *
	 * @return MemberAccessException
	 */
	public static function callWithoutName($class)
	{
		$class = is_object($class) ? get_class($class) : $class;

		return new static("Call to class '$class' method without name.");
	}



	/**
	 * @param object|string $class
	 * @param string $method
	 *
	 * @return MemberAccessException
	 */
	public static function undefinedMethodCall($class, $method)
	{
		$class = is_object($class) ? get_class($class) : $class;

		return new static("Call to undefined method $class::$method().");
	}

}

/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class UnexpectedValueException extends \UnexpectedValueException implements Exception
{

	/**
	 * @param mixed $list
	 * @param string|object $class
	 * @param string $property
	 *
	 * @return UnexpectedValueException
	 */
	public static function invalidEventValue($list, $class, $property)
	{
		$class = is_object($class) ? get_class($class) : $class;

		return new static("Property $class::$$property must be array or NULL, " . gettype($list) . " given.");
	}



	/**
	 * @param string|object $class
	 * @param string $property
	 *
	 * @return UnexpectedValueException
	 */
	public static function notACollection($class, $property)
	{
		$class = is_object($class) ? get_class($class) : $class;

		return new static("Class property $class::\$$property is not an instance of Doctrine\\Common\\Collections\\Collection.");
	}



	/**
	 * @param string|object $class
	 * @param string $property
	 *
	 * @return UnexpectedValueException
	 */
	public static function collectionCannotBeReplaced($class, $property)
	{
		$class = is_object($class) ? get_class($class) : $class;

		return new static("Class property $class::\$$property is an instance of Doctrine\\Common\\Collections\\Collection. Use add<property>() and remove<property>() methods to manipulate it or declare your own.");
	}

}