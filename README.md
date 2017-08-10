<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Viet Nam Location</h1>
    <br>
</p>

## Requirements

 - yii2-widget-depdrop
 - yii2-widget-select2
 
## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require  dungphanxuan/yii2-vnlocation=dev-master
```

or add

```json
"dungphanxuan/yii2-vnlocation": "@dev"
```

to the require section of your composer.json.

Then init migrate for setup table

 - yii migrate --migrationPath=@vendor/dungphanxuan/yii2-vnlocation/mi
   grations


##  Configure

> **NOTE:** Make sure that you don't have `go` component configuration in your config files.

Add following lines to your main configuration file:

```php
'modules' => [
    'go' => [
        'class' => 'dungphanxuan\vnlocation\Module',
    ],
],
```

## Import data

Fill console config:
```php
'controllerMap' => [
        'location-import' => [
            'class' => \dungphanxuan\vnlocation\commands\ImportController::className(),
        ],
    ],
```

Run:

```bash
# Process and exit on finish
./yii location-import
```

## Todo 

 - Init Migrate
 - Init Region
 - Init City
 - Init District
 - Init Ward
 - Seed Data