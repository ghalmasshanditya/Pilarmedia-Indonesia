<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absent extends Model
{
    protected $table = 'absents';
    protected $primaryKey = 'id';

    public function getDataByUser($id)
    {
        $data = DB::table($this->table)
            ->where('id_user', $id)
            ->orderByRaw('id DESC')
            ->get();
        return $data;
    }

    public function getReportOneMonth($id)
    {
        $data = DB::select("SELECT * FROM absents WHERE MONTH(created_at) = DATE_FORMAT(now(), '%m')");
        return $data;
    }
}
