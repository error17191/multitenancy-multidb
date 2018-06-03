<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $company = Company::create([
            'name' => $request->name
        ]);

        $request->user()->companies()->save($company);

        return back();
    }
}
