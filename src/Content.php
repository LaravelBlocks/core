<?php

namespace LaravelBlocks\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

abstract class Content extends Model
{
    /**
     * Get the rendered output of the block.
     *
     * @return mixed
     */
    abstract public function render();

    /**
     * Returns the block core that morphs to this model.
     *
     * @return MorphOne
     */
    protected function block()
    {
        return $this->morphOne(Block::class, 'content');
    }

    /**
     * Returns the parent model of this content block.
     *
     * @return Model
     */
    public function getParentAttribute()
    {
        $parentClass = $this->block->parent_type;
        return $parentClass::find($this->block->parent_id);
    }
}
