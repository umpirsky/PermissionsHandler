# Composer Permissions Handler [![Build Status](https://travis-ci.org/umpirsky/PermissionsHandler.svg?branch=master)](https://travis-ci.org/umpirsky/PermissionsHandler)

Composer script handling directories permissions by making them writable both by the web server and the command line user.

## Usage

Add the following in your root composer.json file:

```json
{
    "require": {
        "umpirsky/composer-permissions-handler": "~1.0"
    },
    "scripts": {
        "post-install-cmd": [
            "Umpirsky\\PermissionsHandler\\ScriptHandler::setPermissions"
        ]
    },
    "extra": {
        "writable-dirs": ["app/cache", "app/logs"]
    }
}
```

`app/cache` and `app/logs` are directories we want writable by the web server and the command line user.

## Examples

* [Symfony](https://github.com/umpirsky/symfony-standard/tree/feature/permissions-handler)
* [Lavarel](https://github.com/umpirsky/laravel/tree/feature/permissions-handler)
