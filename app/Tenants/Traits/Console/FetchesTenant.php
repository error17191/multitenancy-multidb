<?php

namespace App\Tenants\Traits\Console;


use App\Company;

trait FetchesTenant
{
    public function tenants($ids = null)
    {
        return Company::when($ids, function ($query) use ($ids) {
            return $query->whereIn('id', $ids);
        })->get();
    }
}