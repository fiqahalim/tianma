<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\MassDestroyContactPersonRequest;
use App\Http\Requests\UpdateContactPersonRequest;

use App\Models\ContactPerson;
use App\Models\Customer;
use Carbon\Carbon;
use Alert;

class IntendedUserController extends Controller
{
    public function index()
    {
        $intendedUsers = ContactPerson::with(['customers'])->get();

        return view('admin.customers.intended-users.index', compact('intendedUsers'));
    }

    public function create()
    {
        $customers = Customer::pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customers.intended-users.create', compact('customers'));
    }

    public function show(ContactPerson $contactPerson)
    {
        $contactPerson->load('customers');

        return view('admin.customers.intended-users.show', compact('contactPerson'));
    }

    public function edit(ContactPerson $contactPerson)
    {
        $customers = Customer::pluck('full_name', 'id')->prepend('Please Select');

        $contactPerson->load('customers');

        return view('admin.customers.intended-users.edit', compact('contactPerson', 'customers'));
    }

    public function update(Request $request, ContactPerson $contactPerson)
    {
        foreach ($request->addMoreInputFields as $key => $value) {
            $contactPerson->update([
                'customer_id' => $request->customer_id,
                'cperson_name' => $value['cperson_name'],
                'cperson_no' => $value['cperson_no'],
                'relationships' => $value['relationships']
            ]);
        }

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.contact-people.index');
    }

    public function store(Request $request)
    {
        foreach ($request->addMoreInputFields as $key => $value) {
            ContactPerson::create([
                'customer_id' => $request->customer_id,
                'cperson_name' => $value['cperson_name'],
                'cperson_no' => $value['cperson_no'],
                'relationships' => $value['relationships']
            ]);
        }

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.contact-people.index');
    }

    public function destroy(ContactPerson $contactPerson)
    {
        $contactPerson->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyContactPersonRequest $request)
    {
        ContactPerson::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
