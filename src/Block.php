<?php

namespace LaravelBlocks\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Block extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'block_cores';

    /**
     * Returns the parent model that this block belongs to.
     *
     * @return MorphTo
     */
    public function parent()
    {
        return $this->morphTo('parent');
    }

    /**
     * Returns the content model that this block owns.
     *
     * @return MorphTo
     */
    public function content()
    {
        return $this->morphTo('content');
    }
}
