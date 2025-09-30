<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('report.index');
    }

    public function sale()
    {
        return view('report.sale_report');
    }

    public function purchase()
    {
        return view('report.purchase_report');
    }

    public function stock()
    {
        return view('report.stock_report');
    }

    public function financial()
    {
        return view('report.financial_report');
    }

}
