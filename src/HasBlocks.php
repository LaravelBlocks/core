<?php

namespace LaravelBlocks\Core;

use Illuminate\Database\Eloquent\Collection;

trait HasBlocks
{
    /**
     * Returns all of the block cores that morph to this model.
     *
     * @return Collection
     */
    protected function blockCores()
    {
        return $this->morphMany(Block::class, 'parent')->orderBy('order')->getResults();
    }

    /**
     * Returns all of the content blocks that are associated with this model.
     *
     * @return Collection
     */
    public function getBlocksAttribute()
    {
        $blocks = $this->blockCores()->map(function ($block) {
            return $block->content;
        });
        return $blocks;
    }
}
