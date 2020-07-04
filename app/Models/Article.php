<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{

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

    public function scopeApplySorts(Builder $query, $sort){

        if (is_null($sort)){
            return;
        }

        $sortFields = Str::of($sort)->explode(',');

        foreach ($sortFields as $sortField){
            $direction = 'asc';

            if(Str::of($sortField)->startsWith('-')){
                $direction = 'desc';
                $sortField = Str::of($sortField)->substr(1);
            }

            if( ! collect($this->allowedSorts)->contains($sortField) ){
                abort(400, "Invalid Query Parameters, {$sortField} is not allowed.");
            }

            $query->orderBy($sortField, $direction);
        }
    }

}
