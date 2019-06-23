<?php

namespace Pams\QueryString\Traits;

use Illuminate\Database\Eloquent\Builder;

trait EloquentBuildable
{
    /**
     * @return array
     */
    abstract public static function searchable() : array;

    /**
     *  Trait bootable
     */
    public static function bootEloquentBuildable()
    {
        self::applyOnly();
        self::applySearch();
        self::applySort();
    }

    /**
     * @return array
     */
    private static function getOnly() : array
    {
        $only = request()->get('only', null);

        if($only)
            return explode(';', $only);

        return $only;
    }

    /**
     *
     */
    private static function applyOnly() : void
    {
        $only = self::getOnly();

        if($only)
            static::addGlobalScope('only', function (Builder $builder) use ($only) {
                $builder->select($only);
            });
    }

    /**
     * @return array
     */
    private static function getSearch() : array
    {
        $searchBy = request()->get('search', []);

        if(!empty($searchBy))
            return explode(';', $searchBy);

        return $searchBy;
    }

    /**
     *
     */
    private static function applySearch() : void
    {
        $searchBy = self::getSearch();

        $searchable = self::searchable();

        foreach ($searchBy as $item) {

            $item = explode(':', $item);
            if (array_key_exists($item[0], $searchable)) {
                static::addGlobalScope($item[0], function (Builder $builder) use ($item, $searchable) {
                    $condition = $searchable[$item[0]];
                    $builder->where($item[0], $condition, $item[1]);
                });
            }

        }
    }

    /**
     * @return array
     */
    private static function getSort() : array
    {
        $sort = request()->get('sort', []);

        if(!empty($sort))
            return explode(':', $sort);

        return $sort;
    }

    /**
     *
     */
    private static function applySort() : void
    {
        $sort = self::getSort();

        if($sort)
            static::addGlobalScope('sort', function (Builder $builder) use ($sort) {
                $direction = isset($sort[1]) ? $sort[1] : 'asc';
                $builder->orderBy($sort[0], $direction);
            });
    }
}
