<?php

use LaravelBlocks\Core\Block;
use LaravelBlocks\Core\Content;
use LaravelBlocks\Core\HasBlocks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as DB;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUp()
    {
        $this->setUpDatabase();
        $this->migrateTables();
    }

    protected function setupDatabase()
    {
        $database = new DB;
        $database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $database->bootEloquent();
        $database->setAsGlobal();
    }

    protected function migrateTables()
    {
        DB::schema()->create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });

        DB::schema()->create('block_cores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('parent_type');
            $table->unsignedInteger('parent_id');
            $table->string('content_type');
            $table->unsignedInteger('content_id');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });

        DB::schema()->create('paragraphs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->timestamps();
        });

        DB::schema()->create('headers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->timestamps();
        });
    }

    protected function makePost()
    {
        $post = new Post;
        $post->title = 'This Is A Post';
        $post->save();

        return $post;
    }

    protected function makeParagraph()
    {
        $paragraph = new Paragraph;
        $paragraph->text = 'This is a paragraph.';
        $paragraph->save();

        return $paragraph;
    }

    protected function makeHeader()
    {
        $header = new Paragraph;
        $header->text = 'This Is A Header';
        $header->save();

        return $header;
    }

    protected function addContentToParent($content, $parent, $order = 0)
    {
        $block = new Block;
        $block->content_id = $content->id;
        $block->content_type = get_class($content);
        $block->parent_id = $parent->id;
        $block->parent_type = get_class($parent);
        $block->order = $order;
        $block->save();
    }
}

class Post extends Model
{
    use HasBlocks;
}

class Paragraph extends Content
{
    public function render()
    {
        return "<p>$this->text</p>";
    }
}

class Header extends Content
{
    public function render()
    {
        return "<h1>$this->text</h1>";
    }
}
