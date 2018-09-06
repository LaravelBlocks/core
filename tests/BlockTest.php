<?php

use LaravelBlocks\Core\Block;

class BlockTest extends TestCase
{
    /** @test */
    function it_can_get_its_parent()
    {
        $parent = $this->makePost();

        $block = new Block;
        $block->parent_id = $parent->id;
        $block->parent_type = get_class($parent);

        $this->assertEquals($parent->fresh(), $block->parent);
        $this->assertEquals($parent->fresh(), $block->parent()->first());
    }

    /** @test */
    function it_can_get_its_content()
    {
        $content = $this->makeParagraph();

        $block = new Block;
        $block->content_id = $content->id;
        $block->content_type = get_class($content);

        $this->assertEquals($content->fresh(), $block->content);
        $this->assertEquals($content->fresh(), $block->content()->first());
    }
}
