Doctrine
========

Collection of classes for working with Doctrine2 on Kdyby/Doctrine

##Instalation

1. Add require into the composer.json

```json
	"require": {
		"flame/doctrine": "@dev"
	}
```

2. Install dependencies
	
```
	composer install /update
```

##Usage

**in config.neon**

```
	doctrine:
		defaultRepositoryClassName: \Flame\Doctrine\EntityDao
		autoGenerateProxyClasses: true
		metadata:
			Sharezone\Entity: %appDir%/Entity
		ignoredAnnotations: [date, author]
```