<?php

class ContentTest extends TestCase
{
    /** @test */
    function it_can_get_its_parent()
    {
        $post = $this->makePost();

        $paragraph = $this->makeParagraph();

        $this->addContentToParent($paragraph, $post);

        $this->assertEquals($post->fresh(), $paragraph->parent);
    }
}
