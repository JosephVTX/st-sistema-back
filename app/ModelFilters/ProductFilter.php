<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ProductFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function category($category)
    {   
        return $this->whereHas('category', function ($query) use ($category) {
            $query->where('name', $category);
        });
    }

    public function search($search)
    {
        return $this->where('name', 'like', "%$search%");
    }
}
