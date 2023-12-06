<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresenceAdminController extends Controller
{
    //
    public function index() {
        return view('admin.presence.index');
    }

    public function getPresence(Request $request) {
        $date = $request->date;

        $presence = DB::table('presences')
        ->select('presences.*', 'fullname')
        ->join('employees', 'presences.employee_id', '=', 'employees.id_employee')
        ->where('presence_at', $date)
        ->get();

        return view('admin.presence.get-presence', compact('presence'));
    }

    public function showMap(Request $request) {
        $id = $request->id;
        
        $presence = DB::table('presences')
        ->join('employees', 'presences.employee_id', '=', 'employees.id_employee')
        ->where('id', $id)
        ->first();

        return view('admin.presence.show-map', compact('presence'));
    }

    public function report() {
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

        $employees = DB::table('employees')
        ->where('role', 'user')
        ->orderBy('fullname')
        ->get();

        return view('admin.presence.laporan', compact('months', 'employees'));
    }

    public function cetakLaporan(Request $request) {
        $idEmployee = $request->id_employee;
        $month = $request->month;
        $year = $request->year;

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

        $employee = DB::table('employees')
        ->where('id_employee', $idEmployee)
        ->first();

        $presence = DB::table('presences')
        ->where('employee_id', $idEmployee)
        ->whereRaw('MONTH(presence_at)="' . $month . '"')
        ->whereRaw('YEAR(presence_at)="' . $year . '"')
        ->orderBy('presence_at')
        ->get();

        return view('admin.presence.cetak-laporan', compact('month', 'year', 'months', 'employee', 'presence'));
    }
}