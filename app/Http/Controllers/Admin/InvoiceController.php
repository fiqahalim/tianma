<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\User;
use App\Models\Commission;
use App\Models\ProductBooking;
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

    public function commissionReport(Request $request)
    {
        if ($request->start_date || $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $commissions = User::whereBetween('created_at', [$start_date,$end_date])->get();
        } else {
            $commissions = User::with(['commissions', 'orders'])->get();
        }

        return view('admin.invoices.commissionReport', compact('commissions'));
    }

    public function salesReport(Request $request)
    {
        if ($request->start_date || $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $sales = Order::whereBetween('created_at', [$start_date,$end_date])->get();
        } else {
            $sales = Order::with(['customer', 'products', 'installments', 'fullPayments'])->get();
        }

        return view('admin.invoices.salesReport', compact('sales'));
    }

    public function agentsReport(Request $request)
    {
        if ($request->start_date || $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $agents = User::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $agents = User::with(['rankings', 'parent'])->get();
        }

        return view('admin.invoices.agentsReport', compact('agents'));
    }

    public function productsReport(Request $request)
    {
        if ($request->start_date || $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $reservations = ProductBooking::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $reservations = ProductBooking::with(['orders'])->get();
        }

        return view('admin.invoices.productsReport', compact('reservations'));
    }

    public function dailyReport(Request $request)
    {
        if ($request->start_date || $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $dailys = Order::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $dailys = Order::with(['customer', 'createdBy', 'commissions', 'lotID'])->get();
        }

        return view('admin.invoices.dailyReport', compact('dailys'));
    }

    public function installmentReport(Request $request)
    {
        if ($request->start_date || $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $installments = Order::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $installments = Order::with(['customer', 'createdBy', 'lotID', 'installments'])->get();
            $today = Carbon::today();
            $date = $today->addMonth(1);
        }

        return view('admin.invoices.installmentReport', compact('installments', 'date'));
    }
}
