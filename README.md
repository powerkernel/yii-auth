Yii Auth API
============

Prerequisites
-------------
- [Yii API Starter Kit](https://github.com/powerkernel/yii-api-starter-kit)
- [Yii User API](https://github.com/powerkernel/yii-user)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require powerkernel/yii-auth "@dev"
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

API Documentation
-----------------
[View on Postman](https://documenter.getpostman.com/view/4282480/RWM6xrtQ)