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
bin/cake plugin load -r Resize
```

You are all set! Now call your resized images like `domain.com/resize/200x200/img/myself.png`.
The `img/myself.png` should be located into your `webroot`.

## Configuration

To configure the plugin, you should add to your `app\bootstrap.php`:

### defaultSize *(Default value: [100,100] )*

Sets a defaultSize for invalid sizes.

```
Configure::write('Resize.defaultSize', [100, 100]);
```

### sizes *(Default value: [] )*

Sets a array of allowed sizes to resize your images. *(Fallback to defaultSize)*

```
Configure::write('Resize.sizes', [100, 100]);
```

### maxSize *(Default value: [1920,1920] )*

Sets a maxSize to resize your images. *(Fallback to defaultSize)*

```
Configure::write('Resize.maxSize', [1920, 1920]);
```

## Usage

To resize a picture to 500x500, access the url of your picture(relative to webroot folder) prepending by `resize/500x500/`

Example using the HtmlHelper image method:

(In this case, you must go back one folder to access the root folder and not the images folder)

```
echo $this->Html->image('../resize/250x250/img/example.jpg');
echo $this->Html->image('../resize/250x250/uploads/articles/12/sample-article.jpg');
```
