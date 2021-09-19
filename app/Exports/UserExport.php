<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Permission;
use App\Models\Absent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromView, ShouldAutoSize
{
    public function __construct($status, $id)
    {
        $this->status     = $status;
        $this->Absent     = new Absent();
        $this->Permission = new Permission();
        $this->id         = $id;
    }

    public function view(): View
    {
        if ($this->status == 'izin') {
            $permissions = $this->Permission->getReportOneMonth($this->id);
            return view('manager.permission-export', compact('permissions'));
        } elseif ($this->status == 'absen') {
            $absent = $this->Absent->getReportOneMonth($this->id);
            return view('manager.absent-export', compact('absent'));
        }
    }

    // public function collection()
    // {
    //     if ($this->status == 'permissions') {
    //         return view('manager.permission-export', compact('permissions'));
    //     } elseif ($this->status == 'absence-report') {
    //         return view('manager.absent-export', compact('absent'));
    //     }
    // }
}
