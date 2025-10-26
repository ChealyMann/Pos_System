<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;

    class ReportController extends Controller
    {
        // Main report index
        public function index()
        {
            return view('report.index');
        }

        // Sale report form and list
        public function sale()
        {
            // Get all reports of type 'Monthly Sales' or 'Sales by Product'
            $reports = DB::table('reports')
                ->whereIn('report_type', ['Monthly Sales', 'Sales by Product'])
                ->orderByDesc('create_at')
                ->get();

            return view('report.sale_report', compact('reports'));
        }

        // Handle sale report generation
        public function generateSaleReport(Request $request)
        {
            $request->validate([
                'report_name' => 'required|string|max:255',
                'report_type' => 'required|string|in:Monthly Sales,Sales by Product',
                'date' => 'required|date_format:Y-m',
            ]);
            $reportType = $request->input('report_type');
            $reportName = $request->input('report_name');
            $month = $request->input('date');
            $user = Auth::user()->user_name;

            // Query sales for the selected month
            $sales = DB::table('sales')
                ->where('sale_date', 'like', $month . '%')
                ->get();

            $totalAmount = $sales->sum('total_amount');
            $totalRecords = $sales->count();

            // Insert into reports table
            DB::table('reports')->insert([
                'report_type' => $reportType,
                'report_name' => $reportName,
                'date' => $month . '-01',
                'generate_by' => $user,
                'total_records' => $totalRecords,
                'total_amount' => $totalAmount,
                'create_at' => now(),
                'create_by' => $user,
            ]);

            return redirect()->route('report.sale')->with('success', 'Report generated successfully.');
        }

        // Sale report detail page
        public function saleDetail($id)
        {
            $report = DB::table('reports')->where('report_id', $id)->first();

            $month = date('m', strtotime($report->date));
            $year = date('Y', strtotime($report->date));

            $saleItems = DB::table('sale_items')
                ->join('sales', 'sale_items.sale_id', '=', 'sales.sale_id')
                ->join('products', 'sale_items.product_id', '=', 'products.product_id')
                ->join('users', 'sales.sale_by', '=', 'users.user_id')
                ->whereMonth('sales.sale_date', $month)
                ->whereYear('sales.sale_date', $year)
                ->select(
                    'sale_items.sale_id',
                    'sales.sale_date',
                    'users.user_name as sale_by',
                    'products.product_name',
                    'sale_items.qty',
                    'sale_items.unit_price',
                    'sale_items.total_price',
                    'sales.payment_method'
                )
                ->get();

            return view('report.sale_report_detail', compact('report', 'saleItems'));
        }

        // Purchase report
        public function purchase()
        {
            return view('report.purchase_report');
        }

        // Stock report form and list
        public function stock()
        {
            // Get all reports of type 'Stock In', 'Stock Out', etc.
            $reports = DB::table('reports')
                ->whereIn('report_type', ['Stock In', 'Stock Out', 'Expired Stock', 'Current Stock'])
                ->orderByDesc('create_at')
                ->get();


            return view('report.stock_report', compact('reports'));
        }

        // Handle stock report generation
        public function generateStockReport(Request $request)
        {
            // Place validation at the top of this method
            $request->validate([
                'report_name' => 'required|string|max:255',
                'report_type' => 'required|string|in:Stock In,Stock Out,Expired Stock,Current Stock',
                'date' => 'required|date_format:Y-m',
            ]);
            $reportType = $request->input('report_type');
            $reportName = $request->input('report_name');
            $month = $request->input('date');
            $user = auth()->user() ? auth()->user()->name : 'Unknown';

            // Query stock_ins for the selected month
            $stocks = DB::table('stock_ins')
                ->where('stock_in_date', 'like', $month . '%')
                ->get();

            $totalAmount = $stocks->sum('avg_cost');
            $totalRecords = $stocks->count();

            // Insert into reports table
            DB::table('reports')->insert([
                'report_type' => $reportType,
                'report_name' => $reportName,
                'date' => $month . '-01',
                'generate_by' => Auth::user()->user_name,
                'total_records' => $totalRecords,
                'total_amount' => $totalAmount,
                'create_at' => now(),
                'create_by' => Auth::user()->user_name,
            ]);

            return redirect()->route('report.stock')->with('success', 'Report generated successfully.');
        }

        // Stock report detail page
        public function stockDetail($id)
        {
            $report = DB::table('reports')->where('report_id', $id)->first();

            // Get all stock_ins for the report's month
            $month = date('m', strtotime($report->date));
            $year = date('Y', strtotime($report->date));

            $stocks = DB::table('stock_ins')
                ->join('products', 'stock_ins.product_id', '=', 'products.product_id')
                ->whereMonth('stock_ins.stock_in_date', $month)
                ->whereYear('stock_ins.stock_in_date', $year)
                ->select(
                    'stock_ins.stock_in_id',
                    'stock_ins.product_id',
                    'products.product_name',
                    'stock_ins.qty',
                    'stock_ins.cost_per_item',
                    'stock_ins.stock_in_date',
                    'stock_ins.created_at',
                    'stock_ins.created_by'
                )
                ->get();

            return view('report.stock_report_detail', compact('report', 'stocks'));
        }

        // Financial report
        public function financial()
        {
            return view('report.financial_report');
        }
    }
