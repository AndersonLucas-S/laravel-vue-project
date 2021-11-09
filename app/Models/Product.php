<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'brand', 'amount',  'image'];


    public function getResults($data, $total)
    {
        if (!isset($data['filter']) && !isset($data['name']) && !isset($data['description']) && !isset($data['brand']) && !isset($data['amount']))
            return $this->orderBy('id', 'DESC')->paginate($total);

        return $this->where(function ($query) use ($data) {
                    if (isset($data['filter'])) {
                        $filter = $data['filter'];
                        $query->where('name', $filter);
                        $query->orWhere('description', 'LIKE', "%{$filter}%");
                    }

                    if (isset($data['name']))
                        $query->where('name', $data['name']);
                    
                    if (isset($data['description'])) {
                        $description = $data['description'];
                        $query->where('description', 'LIKE', "%{$description}%");
                    }

                    if (isset($data['brand'])){
                        $query->where('brand', $data['brand']);
                    }

                    if (isset($data['amount'])){
                        $query->where('amount', $data['amount']);
                    }
                })//->toSql();dd($results);
                ->orderBy('id', 'DESC')
                ->paginate($total);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
