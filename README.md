# Resize plugin for CakePHP

> Note: This is a non-stable plugin for CakePHP 3.x at this time. It is currently under development and should be
considered experimental.

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require leoruhland/cakephp-resize
```

Now load the plugin:

```
$ bin/cake plugin load -r Resize
```

You are all set! Now call your resized images like `domain.com/resize/200x200/img/myself.png`.
The `img/myself.png` should be located into your `webroot`.
