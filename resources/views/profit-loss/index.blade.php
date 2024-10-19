@extends('layouts.app')

@section('content')

<h2 class="mt-3"><i class="fa-solid fa-file-alt"></i> <b>Laporan Profit/Loss</b></h2>
<hr>

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('profit-loss.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <select name="month" class="form-control">
                    <option value="" disabled selected>Pilih Bulan</option>
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" {{ request('month') == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endfor
                </select>
                <select name="year" class="form-control">
                    <option value="" disabled selected>Pilih Tahun</option>
                    @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <form action="{{ route('profit-loss.export') }}" method="GET">
            <input type="hidden" name="month" value="{{ request('month') }}">
            <input type="hidden" name="year" value="{{ request('year') }}">
            <button type="submit" class="btn btn-outline-success mb-3 float-end">
                <i class="fa-solid fa-file-excel"></i> Cetak Excel Laporan
            </button>
        </form>
        <a href="{{ route('profit-loss.index') }}" class="btn btn-outline-secondary mb-3 float-start me-2">
            <i class="fa-solid fa-broom"></i> Clear Filter
        </a>
    </div>
</div>

@if (empty($salary_income) && empty($other_income) && empty($family_expense) && empty($transport_expense) && empty($meal_expense))
    <div class="alert alert-info text-center">Data tidak tersedia.</div>
@else
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Kategori</th>
                @foreach($months as $month)
                    <th>{{ $month }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Salary</td>
                @foreach($months as $month)
                    <td>Rp. {{ number_format($salary_income[$month] ?? 0, 2, ',', '.') }}</td>
                @endforeach
            </tr>

            <tr>
                <td>Other Income</td>
                @foreach($months as $month)
                    <td>Rp. {{ number_format($other_income[$month] ?? 0, 2, ',', '.') }}</td>
                @endforeach
            </tr>

            <tr>
                <td><b>Total Income</b></td>
                @foreach($months as $month)
                    <td><b>Rp. {{ number_format($total_income[$month] ?? 0, 2, ',', '.') }}</b></td>
                @endforeach
            </tr>

            <tr>
                <td>Family Expense</td>
                @foreach($months as $month)
                    <td>Rp. {{ number_format($family_expense[$month] ?? 0, 2, ',', '.') }}</td>
                @endforeach
            </tr>

            <tr>
                <td>Transport Expense</td>
                @foreach($months as $month)
                    <td>Rp. {{ number_format($transport_expense[$month] ?? 0, 2, ',', '.') }}</td>
                @endforeach
            </tr>

            <tr>
                <td>Meal Expense</td>
                @foreach($months as $month)
                    <td>Rp. {{ number_format($meal_expense[$month] ?? 0, 2, ',', '.') }}</td>
                @endforeach
            </tr>

            <tr>
                <td><b>Total Expense</b></td>
                @foreach($months as $month)
                    <td><b>Rp. {{ number_format($total_expense[$month] ?? 0, 2, ',', '.') }}</b></td>
                @endforeach
            </tr>

            <tr>
                <td><b>Net Income</b></td>
                @foreach($months as $month)
                    <td><b>Rp. {{ number_format($net_income[$month] ?? 0, 2, ',', '.') }}</b></td>
                @endforeach
            </tr>
        </tbody>
    </table>
@endif

@endsection
