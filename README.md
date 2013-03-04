Doctrine
========

Collection of classes for working with Doctrine2 on Flame framework

##Instalation

1. Add require into the composer.json

```json
	"require": {
		"flame/doctrine": "@dev"
	}
```

2. Install dependencies
	
```
	composer install/update
```

3. Register **doctrine** extension into the bootstrap.php

```php
	$doctrineExtension = new \Flame\Doctrine\Config\Extension;
    $doctrineExtension->install($configurator);
```

##Usage

**in config.neon**

```
	doctrine:
	  connection: %database%
	  entityDirs: [%appDir%/Entity]
```