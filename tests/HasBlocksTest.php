<?php

use Illuminate\Database\Eloquent\Collection;

class HasBlocksTest extends TestCase
{
    /** @test */
    function it_can_get_its_blocks_in_order()
    {
        $post = $this->makePost();

        $paragraphOne = $this->makeParagraph();
        $paragraphTwo = $this->makeParagraph();
        $header = $this->makeHeader();

        $this->addContentToParent($paragraphOne, $post, 2);
        $this->addContentToParent($paragraphTwo, $post, 3);
        $this->addContentToParent($header, $post, 1);

        $expectedBlocks = new Collection([
            $header->fresh(),
            $paragraphOne->fresh(),
            $paragraphTwo->fresh(),
        ]);

        $this->assertEquals($expectedBlocks, $post->blocks);
    }
}
