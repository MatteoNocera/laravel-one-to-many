<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Type;

class Project extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'projects';

    protected $fillable = ['title', 'slug', 'cover_image', 'content', 'type_id'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
