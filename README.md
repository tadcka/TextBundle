TextBundle
==========

[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/tadcka/TextBundle/badges/quality-score.png?s=421227ce87b33b44a643b90cdde23e53421bd6af)](https://scrutinizer-ci.com/g/tadcka/TextBundle/)

Localized texts manager.

## Installation

### Step 1: Download TadckaTextBundle using composer

Add TadckaTextBundle in your composer.json:

```js
{
    "require": {
        "tadcka/text-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update tadcka/text-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Tadcka\TextBundle\TadckaTextBundle(),
    );
}
```

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

Code License:
[Resources/meta/LICENSE](https://github.com/tadcka/TextBundle/blob/master/Resources/meta/LICENSE)
