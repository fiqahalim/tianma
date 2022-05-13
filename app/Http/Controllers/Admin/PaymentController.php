<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Payment;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->start_date || $request->end_date) {
            $end_date = [];
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();

            $payments = Payment::whereBetween('doc_date', [$start_date, $end_date])->get();
        } else {
            $payments = Payment::all();
        }
        return view('admin.payments.index', compact('payments'));
    }
}
