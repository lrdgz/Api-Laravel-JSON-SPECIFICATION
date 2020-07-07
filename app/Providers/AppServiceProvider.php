<?php

namespace App\Providers;

use App\JsonApi\JsonApiBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Builder::macro('jsonPaginate', function () {
//            return $this->paginate(
//                $perPage = request('page.size'),
//                $columns = ['*'],
//                $pageName = 'page[number]',
//                $page = request('page.number')
//            )->appends(request()->except('page.number'));
//        });

//        Builder::macro('applySorts', function () {
//            if ( ! property_exists($this->model, 'allowedSorts')){
//                abort(400, 'Please set the public property $allowedSorts inside ' . get_class($this->model));
//            }
//
//            if (is_null($sort = request('sort'))){
//                return $this;
//            }
//
//            $sortFields = Str::of($sort)->explode(',');
//
//            foreach ($sortFields as $sortField){
//                $direction = 'asc';
//
//                if(Str::of($sortField)->startsWith('-')){
//                    $direction = 'desc';
//                    $sortField = Str::of($sortField)->substr(1);
//                }
//
//                if( ! collect($this->model->allowedSorts)->contains($sortField) ){
//                    abort(400, "Invalid Query Parameters, {$sortField} is not allowed.");
//                }
//
//                $this->orderBy($sortField, $direction);
//            }
//
//            return $this;
//        });
    }
}
