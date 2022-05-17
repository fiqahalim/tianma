<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Invoice;
use App\Models\Order;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->start_date || $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $invoices = Invoice::whereBetween('doc_date',[$start_date,$end_date])->get();
        } else {
            $invoices = Invoice::with(['createdBy', 'transactions', 'installments', 'fullPayments', 'customers', 'orders'])->get();
        }
        return view('admin.invoices.index', compact('invoices'));
    }
}
