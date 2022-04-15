<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactPerson;

class IntendedUserController extends Controller
{
    public function index()
    {
        $intendedUsers = ContactPerson::with(['customers'])->get();

        return view('admin.customers.intended-users.index', compact('intendedUsers'));
    }

    public function create()
    {
        return view('admin.customers.intended-users.create');
    }

    public function show(ContactPerson $contactPerson)
    {
        return view('admin.customers.intended-users.index', compact('contactPerson'));
    }

    public function edit(ContactPerson $contactPerson)
    {
        return view('admin.customers.intended-users.index', compact('contactPerson'));
    }

    public function update()
    {

    }


    public function store ()
    {

    }

    public function destroy()
    {

    }

    public function massDestroy()
    {

    }
}
