<h3 align="center">
    <a href="https://github.com/umpirsky">
        <img src="https://farm2.staticflickr.com/1709/25098526884_ae4d50465f_o_d.png" />
    </a>
</h3>
<p align="center">
  <a href="https://github.com/umpirsky/Symfony-Upgrade-Fixer">symfony upgrade fixer</a> &bull;
  <a href="https://github.com/umpirsky/Twig-Gettext-Extractor">twig gettext extractor</a> &bull;
  <a href="https://github.com/umpirsky/wisdom">wisdom</a> &bull;
  <a href="https://github.com/umpirsky/centipede">centipede</a> &bull;
  <b>permissions handler<b> &bull;
  <a href="https://github.com/umpirsky/Extraload">extraload</a> &bull;
  <a href="https://github.com/umpirsky/Gravatar">gravatar</a> &bull;
  <a href="https://github.com/umpirsky/locurro">locurro</a> &bull;
  <a href="https://github.com/umpirsky/country-list">country list</a> &bull;
  <a href="https://github.com/umpirsky/Transliterator">transliterator</a>
</p>

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
