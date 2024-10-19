<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Transaksi;
use App\Models\ChartOfAccount;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Style;

class ExportProfitLoss implements FromCollection, WithStyles, ShouldAutoSize
{
    protected $months;
    protected $salary_income;
    protected $other_income;
    protected $total_income;
    protected $family_expense;
    protected $transport_expense;
    protected $meal_expense;
    protected $total_expense;
    protected $net_income;

    public function __construct($months, $salary_income, $other_income, $total_income, $family_expense, $transport_expense, $meal_expense, $total_expense, $net_income)
    {
        $this->months = $months;
        $this->salary_income = $salary_income;
        $this->other_income = $other_income;
        $this->total_income = $total_income;
        $this->family_expense = $family_expense;
        $this->transport_expense = $transport_expense;
        $this->meal_expense = $meal_expense;
        $this->total_expense = $total_expense;
        $this->net_income = $net_income;
    }

    public function collection()
    {
        $data = [];
        $data[] = array_merge(['Kategori'], $this->months);

        $data[] = array_merge(['Salary'], $this->getMonthlyData($this->salary_income));
        $data[] = array_merge(['Other Income'], $this->getMonthlyData($this->other_income));
        $data[] = array_merge(['Total Income'], $this->getMonthlyData($this->total_income));
        $data[] = array_merge(['Family Expense'], $this->getMonthlyData($this->family_expense));
        $data[] = array_merge(['Transport Expense'], $this->getMonthlyData($this->transport_expense));
        $data[] = array_merge(['Meal Expense'], $this->getMonthlyData($this->meal_expense));
        $data[] = array_merge(['Total Expense'], $this->getMonthlyData($this->total_expense));
        $data[] = array_merge(['Net Income'], $this->getMonthlyData($this->net_income));

        return new Collection($data);
    }

    public function headings(): array
    {
        return ['Kategori', ...$this->months];
    }

    protected function getMonthlyData($data)
    {
        return array_map(function ($month) use ($data) {
            return 'Rp ' . number_format($data[$month] ?? 0, 2, ',', '.');
        }, $this->months);
    }



    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet): array
    {
        $dataRowsCount = 0;
        $dataCategories = [
            'salary_income',
            'other_income',
            'total_income',
            'family_expense',
            'transport_expense',
            'meal_expense',
            'total_expense'
        ];

        foreach ($dataCategories as $category) {
            if (!empty($this->{$category})) {
                $dataRowsCount++;
            }
        }

        $lastColumn = 'A';
        foreach ($this->months as $index => $month) {
            $lastColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index + 2);
        }

        return [
            'A2:' . $lastColumn . ($dataRowsCount + 2) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ],

            'A1:' . $lastColumn . '1' => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }


}
