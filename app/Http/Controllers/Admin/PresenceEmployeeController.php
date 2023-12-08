<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresenceEmployeeController extends Controller
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

    public function rekap() {
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

        return view('admin.presence.rekap-presence', compact('months'));
    }

    public function cetakRekap(Request $request) {
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

        $rekapPresence = DB::table('presences')
        ->selectRaw('presences.employee_id, fullname,
            MAX(IF(DAY(presence_at) = 1,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_1,
            MAX(IF(DAY(presence_at) = 2,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_2,
            MAX(IF(DAY(presence_at) = 3,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_3,
            MAX(IF(DAY(presence_at) = 4,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_4,
            MAX(IF(DAY(presence_at) = 5,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_5,
            MAX(IF(DAY(presence_at) = 6,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_6,
            MAX(IF(DAY(presence_at) = 7,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_7,
            MAX(IF(DAY(presence_at) = 8,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_8,
            MAX(IF(DAY(presence_at) = 9,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_9,
            MAX(IF(DAY(presence_at) = 10,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_10,
            MAX(IF(DAY(presence_at) = 11,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_11,
            MAX(IF(DAY(presence_at) = 12,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_12,
            MAX(IF(DAY(presence_at) = 13,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_13,
            MAX(IF(DAY(presence_at) = 14,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_14,
            MAX(IF(DAY(presence_at) = 15,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_15,
            MAX(IF(DAY(presence_at) = 16,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_16,
            MAX(IF(DAY(presence_at) = 17,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_17,
            MAX(IF(DAY(presence_at) = 18,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_18,
            MAX(IF(DAY(presence_at) = 19,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_19,
            MAX(IF(DAY(presence_at) = 20,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_20,
            MAX(IF(DAY(presence_at) = 21,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_21,
            MAX(IF(DAY(presence_at) = 22,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_22,
            MAX(IF(DAY(presence_at) = 23,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_23,
            MAX(IF(DAY(presence_at) = 24,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_24,
            MAX(IF(DAY(presence_at) = 25,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_25,
            MAX(IF(DAY(presence_at) = 26,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_26,
            MAX(IF(DAY(presence_at) = 27,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_27,
            MAX(IF(DAY(presence_at) = 28,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_28,
            MAX(IF(DAY(presence_at) = 29,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_29,
            MAX(IF(DAY(presence_at) = 30,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_30,
            MAX(IF(DAY(presence_at) = 31,CONCAT(check_in, "-", IFNULL(check_out, "00:00:00")),"")) as tgl_31,')
        ->join('employees', 'presences.employee_id', '=', 'employees.id_employee')
        ->whereRaw('MONTH(presence_at)="' . $month . '"')
        ->whereRaw('YEAR(presence_at)="' . $year . '"')
        ->groupByRaw('presences.employee_id, fullname')
        ->get();

        return view('admin.presence.cetak-rekap-presence', compact('month', 'year', 'months', 'rekapPresence'));
    }
}
