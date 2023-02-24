<?php

namespace ProdigyPHP\Prodigy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ProdigyPHP\Prodigy\Database\Factories\BlockFactory;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BlockRow extends Model {

    protected $table = 'prodigy_block_row';

    protected $guarded = [];

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'prodigy_block_page');
    }

    public function row() : BelongsTo
    {
        return $this->belongsTo(Block::class, 'row_block_id');
    }

    public function block() : BelongsTo
    {
        return $this->belongsTo(Block::class);
    }


}
