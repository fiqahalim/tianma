<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Payment;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index()
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $payments = Payment::whereBetween('doc_date',[$start_date,$end_date])->get();
        } else {
            $payments = Payment::all();
        }

        return view('admin.payments.index', compact('payments'));
    }

    public function store()
    {

    }

    public function edit()
    {

    }
}
