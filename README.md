# Laravel Blocks Core

An extensible block system for Laravel that allows for extremely flexible content to be associated with your models.

## Installation

To get started creating your own content blocks, first pull in this core package by running this in your command line:

```bash
composer require laravelblocks/core
```

After installed you'll need to run the migration to create a `blocks` table in your database:

```bash
php artisan migrate
```

## Usage

### Parent Models

If you want a model to be able to have content blocks, it simply needs to use the `HasBlocks` trait like so:

```php
class Post extends Model
{
    use \LaravelBlocks\Core\HasBlocks;

    // ...
}
```

### Content Models

To create your own content blocks, you need to create a model that extends the abstract `Content` class. This class extends the traditional Eloquent Model class, so any `Content` class you create will also be an Eloquent Model. The only function your class needs to implement specifically is the `render` function, which should return the view or HTML content you want to be rendered whenever this block is displayed. 

```php
class Paragraph extends \LaravelBlocks\Core\Content
{
    public function render()
    {
        return '<p>This is a paragraph.</p>';
    }

    // ...
}
```

Of course the `render` function can have whatever logic you want or use any attributes you've added to your block model. For more complex blocks, you can even use Blade templates and return the view in this function.

> It's highly recommended that any bits of HTML that get rendered for a block are generated programmatically, and not from values in the database. If you use HTML from the database, it makes it much easier for a malicious package to create rogue models in your database and render dangerous content onto your website.

### Rendering

When you want to render a block, you can simply call the block's `render` function. Because this function will likely return some HTML, the function results will need to be escaped. If you're rendering all the blocks for a `HasBlocks` model, in a Blade template, it might look something like this:

```
@foreach ($post->blocks as $block)
    {!! $block->render() !!}
@endforeach
```

Note that the `$block->render()` call is placed within `{!! ... !!}`. This is necessary so that any HTML rendered by the block is not escaped and displays properly. This is why it is important to strictly control what HTML can make it into these render functions, and why it is recommended that you either hard-code the HTML tags or use views within the render function itself.
