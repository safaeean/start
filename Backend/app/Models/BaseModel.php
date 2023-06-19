<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function scopePaginateAndSearchAndOrder($q)
    {
        return $q
            ->search(request('q'))
            ->order(request('sort_by'), request('order'))
            ->paginate(30);
    }

    public function scopeOrder($q, $sort_by, $order)
    {
        return $q
            ->when($sort_by, function ($q) use ($sort_by, $order) {
                $q->orderby($sort_by, $order == "descending" ? "desc" : "asc");
            });
    }

}
