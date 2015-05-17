# Introduction



## Installation

### Install for custom framework

To start you have to include in your PHP include path, the folder of your library folder where you are going to install this library and then set the autoloader.
Here is an example with a provided autoloader:

```
require_once __DIR__ . '/src/SplAutoloader.php';
$autoload = new SplAutoloader(null, realpath(dirname(__DIR__) . '/src'));
$autoload->register();
```

### Install via Composer

Add the following requirements into your composer.json at root project level. You do not need to add an autoloader, composer will handle it for you if your application is compatible with it.

```
 {
    "require" : {
        "diglin/intrum": "1.*"
    },
    "repositories" : [
        {
            "type": "vcs",
            "url": "git@github.com:diglin/intrum.git"
        }
    ]
 }
 ```

### Magento Composer Installer

 In your `composer.json` at the Magento project level, you will have to set the following informations:

 ```
 {
    "require" : {
        "magento-hackathon/magento-composer-installer" : "*",
        "diglin/intrum": "1.*"
    },
    "repositories" : [
		{
            "type" : "composer",
            "url" : "http://packages.firegento.com"
        },
        {
            "type": "vcs",
            "url": "git@github.com:diglin/intrum.git"
        }
    ],
    "extra" : {
        "magento-root-dir" : "./"
    },
    "scripts": {
        "post-package-install": [
            "Diglin\\Intrum\\Composer\\Magento::postPackageAction"
        ],
        "post-package-update": [
            "Diglin\\Intrum\\Composer\\Magento::postPackageAction"
        ],
        "pre-package-uninstall": [
            "Diglin\\Intrum\\Composer\\Magento::cleanPackageAction"
        ]
    }
 }
 ```
 