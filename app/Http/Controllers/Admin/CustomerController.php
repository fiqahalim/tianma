<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\Order;

use Gate;
use Alert;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use NumberToWords\NumberToWords;

class CustomerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::with(['createdBy'])->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.customers.index');
    }

    public function edit(Customer $customer)
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.customers.index');
    }

    public function show(Customer $customer)
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.customers.show', compact('customer'));
    }

    public function destroy(Customer $customer)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyCustomerRequest $request)
    {
        Customer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function showInvoice(Order $order)
    {
        $order->load('customer', 'createdBy', 'installments', 'bookLocations', 'lotID');

        $customer = $order->customer;

        $perAddr = array(
                $customer->address_1,
                $customer->address_2,
                $customer->postcode,
                $customer->state,
                $customer->city,
                $customer->country,
            );

            $corAddr = Customer::with(['correspondenceAddress', 'contactPersons', 'payments'])
            ->where('id', $customer->id)
            ->get();

            if (!is_null($corAddr)) {
                foreach($corAddr as $k => $addr) {
                    $corrAddr = [
                        $addr->correspondenceAddress->curaddress_1,
                        $addr->correspondenceAddress->curaddress_2,
                        $addr->correspondenceAddress->curpostcode,
                        $addr->correspondenceAddress->curstate,
                        $addr->correspondenceAddress->curcity,
                        $addr->correspondenceAddress->curcountry,
                    ];
                }

                $concat_perAddr = implode(" ", $perAddr);
                $cust_details['per_address'] = $concat_perAddr;

                $concat_corAddr = implode(" ", $corrAddr);
                $cust_details['cor_address'] = $concat_corAddr;
            }

        return view('admin.customers.invoices', compact('order', 'cust_details', 'corAddr'));
    }
}
