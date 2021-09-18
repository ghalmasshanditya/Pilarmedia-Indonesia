<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';

    public function getDataByUser($id)
    {
        $data = DB::table($this->table)
            ->where('id_user', $id)
            ->orderByRaw('id DESC')
            ->get();
        return $data;
    }

    public function getRequested()
    {
        $data = DB::table($this->table)
            ->select('permissions.*', 'users.name as name')
            ->Join('users', 'users.id', '=', 'permissions.id_user')
            ->where('status', 2)
            ->orderByRaw('permissions.created_at ASC')
            ->get();
        return $data;
    }

    public function getReportOneMonth($id)
    {
        $data = DB::select("SELECT * FROM `permissions` WHERE MONTH(created_at) = DATE_FORMAT(now(), '%m')");
        return $data;
    }
}
