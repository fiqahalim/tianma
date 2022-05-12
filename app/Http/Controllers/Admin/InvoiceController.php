<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index()
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $invoices = Payment::whereBetween('doc_date',[$start_date,$end_date])->get();
        } else {
            $invoices = Invoice::all();
        }

        return view('admin.invoices.index', compact('invoices'));
    }
}
