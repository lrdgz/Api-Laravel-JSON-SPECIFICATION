<?php

namespace App\Models;

use App\Models\Traits\HasSorts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{

//    use HasSorts;
    public $allowedSorts = ['title', 'content'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'user_id' => 'integer',
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTitle(Builder $query, $value){
        $query->where('title', 'LIKE', "%{$value}%");
    }

    public function scopeContent(Builder $query, $value){
        $query->where('content', 'LIKE', "%{$value}%");
    }

    public function scopeYear(Builder $query, $value){
        $query->whereYear('created_at', $value);
    }

    public function scopeMonth(Builder $query, $value){
        $query->whereMonth('created_at', $value);
    }

    public function scopeSearch(Builder $query, $values){

        foreach (Str::of($values)->explode(' ') as $value) {
            $query
                ->orWhere('title', 'LIKE',  "%{$value}%")
                ->orWhere('content', 'LIKE',  "%{$value}%");
        }
    }
}
