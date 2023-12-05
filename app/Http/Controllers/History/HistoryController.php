<?php

namespace App\Http\Controllers\History;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    //
    public function index() {
        $months = [
            "",
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];
        return view('history.index', compact('months'));
    }

    public function search(Request $request) {
        $idEmployee = Auth::guard('employee')->user()->id_employee;

        $month = $request->month;
        $year = $request->year;

        $history = DB::table('presences')
        ->whereRaw('MONTH(presence_at)="'. $month . '"')
        ->whereRaw('YEAR(presence_at)="' . $year . '"')
        ->where('employee_id', $idEmployee)
        ->orderBy('presence_at')
        ->get();

        return view('history.show', compact('history'));
    }
}
