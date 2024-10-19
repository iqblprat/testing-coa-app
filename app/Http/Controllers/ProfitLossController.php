<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\ChartOfAccount;
use App\Models\Kategori;
use App\Exports\ExportProfitLoss;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Auth;

class ProfitLossController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $months = $this->getTransactionMonths();

        $months = array_slice($months, -3);

        if ($month && $year) {
            $months = [$year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT)];
        }

        $salary_income = $this->calculateByCategoryAndMonth('Salary', 'income', $months);
        $other_income = $this->calculateByCategoryAndMonth('Other Income', 'income', $months);
        $family_expense = $this->calculateByCategoryAndMonth('Family Expense', 'expense', $months);
        $transport_expense = $this->calculateByCategoryAndMonth('Transport Expense', 'expense', $months);
        $meal_expense = $this->calculateByCategoryAndMonth('Meal Expense', 'expense', $months);

        $total_income = [];
        foreach ($months as $month) {
            $total_income[$month] = ($salary_income[$month] ?? 0) + ($other_income[$month] ?? 0);
        }

        $total_expense = [];
        foreach ($months as $month) {
            $total_expense[$month] = ($family_expense[$month] ?? 0) + ($transport_expense[$month] ?? 0) + ($meal_expense[$month] ?? 0);
        }

        $net_income = [];
        foreach ($months as $month) {
            $net_income[$month] = ($total_income[$month] ?? 0) - ($total_expense[$month] ?? 0);
        }

        return view('profit-loss.index', compact(
            'months',
            'salary_income', 'other_income',
            'family_expense', 'transport_expense', 'meal_expense',
            'total_income', 'total_expense', 'net_income'
        ));
    }

    private function getTransactionMonths()
    {
        $months = DB::table('tb_transaksi')
            ->select(DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as month"))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('month');

        return $months->toArray();
    }

    private function calculateByCategoryAndMonth($category, $type, $months)
    {
        $results = DB::table('tb_transaksi')
            ->join('tb_chart_of_account', 'tb_transaksi.coa_id', '=', 'tb_chart_of_account.id')
            ->join('tb_kategori_coa', 'tb_chart_of_account.kategori_id', '=', 'tb_kategori_coa.id')
            ->where('tb_kategori_coa.nama', $category)
            ->whereIn(DB::raw("DATE_FORMAT(tb_transaksi.tanggal, '%Y-%m')"), $months)
            ->groupBy(DB::raw("DATE_FORMAT(tb_transaksi.tanggal, '%Y-%m')"))
            ->select(
                DB::raw($type === 'income' ? 'SUM(tb_transaksi.credit) as total' : 'SUM(tb_transaksi.debit) as total'),
                DB::raw("DATE_FORMAT(tb_transaksi.tanggal, '%Y-%m') as month")
            )
            ->get();

        $data = [];
        foreach ($months as $month) {
            $data[$month] = $results->firstWhere('month', $month)->total ?? 0;
        }

        return $data;
    }

    public function export(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        if (empty($month) || empty($year)) {
            $months = [];
            for ($i = 5; $i >= 0; $i--) {
                $months[] = now()->subMonths($i)->format('Y-m');
            }
        } else {
            $months = [$year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT)];
        }

        $salary_income = $this->calculateByCategoryAndMonth('Salary', 'income', $months);
        $other_income = $this->calculateByCategoryAndMonth('Other Income', 'income', $months);
        $family_expense = $this->calculateByCategoryAndMonth('Family Expense', 'expense', $months);
        $transport_expense = $this->calculateByCategoryAndMonth('Transport Expense', 'expense', $months);
        $meal_expense = $this->calculateByCategoryAndMonth('Meal Expense', 'expense', $months);

        $total_income = [];
        $total_expense = [];
        $net_income = [];

        foreach ($months as $month) {
            $total_income[$month] = ($salary_income[$month] ?? 0) + ($other_income[$month] ?? 0);
            $total_expense[$month] = ($family_expense[$month] ?? 0) + ($transport_expense[$month] ?? 0) + ($meal_expense[$month] ?? 0);
            $net_income[$month] = $total_income[$month] - $total_expense[$month];
        }

        return Excel::download(new ExportProfitLoss(
            $months,
            $salary_income,
            $other_income,
            $total_income,
            $family_expense,
            $transport_expense,
            $meal_expense,
            $total_expense,
            $net_income
        ), 'laporan-profit-loss.xlsx');
    }
}
