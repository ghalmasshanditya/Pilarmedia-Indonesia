<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AbsentController extends Controller
{
    public function __construct()
    {
        $this->Absent = new Absent();
        $this->Permission = new Permission();
        $this->User = new User();
    }

    public function index()
    {
        $data = array(
            'absents' => $this->Absent->getDataByUser(Auth::user()->id)
        );
        // dd($data);
        return view('user.absents', $data);
    }

    public function reportAbsence($id)
    {
        $data = array(
            'absents' => $this->Absent->getReportOneMonth($id),
            'permissions' => $this->Permission->getReportOneMonth($id)
        );
        // dd($data);
        return view('hrd.absents', $data);
    }

    public function listAbsence()
    {
        $data = array(
            'user' => $this->User->getAllEmployee()
        );
        // dd($data);
        return view('hrd.userList', $data);
    }

    public function check(Request $request, $id)
    {
        $data = array(
            'id_user'    => $id,
            'type'       => Request()->type,
            'created_at' => Request()->created_at,
            'updated_at' => Request()->created_at
        );
        // dd($data);
        $this->Absent->insert($data);

        $validator = '';
        if (Request()->type == 1) {
            if (date('H:i:s', strtotime(Request()->created_at)) > '09:00:00') {
                $validator = "Invalid";
            } else {
                $validator = "Valid";
            }
        } elseif (Request()->type == 2) {
            if (date('H:i:s', strtotime(Request()->created_at)) < '17:00:00') {
                $validator = "Invalid";
            } else {
                $validator = "Valid";
            }
        }
        return redirect('/absents')->with('message', $validator);
    }
}
