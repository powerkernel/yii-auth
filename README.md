Yii Auth API
============

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Add 
```
{
  "type": "git",
  "url": "git@github.com:powerkernel/yii-auth.git"
}
```
to repositories section of your `composer.json` file

Then either run

```
php composer.phar --prefer-source require powerkernel/yii-auth "@dev"
```

or add

```
"powerkernel/yii-auth": "@dev"
```

to the require section of your `composer.json` file

DB Migration
------------
Run in `/bin` directory

```
php yii mongodb-migrate --migrationPath=@vendor/powerkernel/yii-auth/src/migrations --migrationCollection=auth_migration
```
