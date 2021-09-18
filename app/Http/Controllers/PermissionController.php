<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Absent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->Permission = new Permission();
        $this->Absent = new Absent();
    }

    public function index()
    {
        $data = array(
            'permissions' => $this->Permission->getDataByUser(Auth::user()->id)
        );
        // dd($data);
        return view('user.permissions', $data);
    }

    public function sick(Request $request, $id)
    {
        $absent = Absent::where('id_user', Auth::user()->id)->orderByDesc('created_at')->first();

        $awal  = $absent->created_at;
        $akhir = now(); // waktu sekarang
        $diff  = date_diff($awal, $akhir);

        $validator = '';

        if ($diff->days > 3) {
            $validator = 'invalid';
        } elseif ($diff->days <= 3) {
            $file     = Request()->file;
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('assets/file/'), $fileName);

            $data = array(
                'id_user'     => $id,
                'type'        => Request()->type,
                'date'        => Request()->date,
                'description' => Request()->description,
                'file'        => $fileName,
                'status'      => 2,
                'created_at'  => now(),
                'updated_at'  => now()
            );
            // dd($data);
            $this->Permission->insert($data);
            $validator = 'valid';
        }











        return redirect('/permissions')->with('message', $validator);
    }

    public function paidLeave(Request $request, $id)
    {
        $data = array(
            'id_user'     => $id,
            'type'        => Request()->type,
            'date'        => Request()->date,
            'description' => Request()->description,
            'status'      => 2,
            'created_at'  => now(),
            'updated_at'  => now(),
        );
        // dd($data);

        $validator = '';
        if (Request()->date > date('Y-m-d')) {
            $this->Permission->insert($data);
            $validator = 'valid';
        } else {
            $validator = 'invalid';
        }

        return redirect('/permissions')->with('message', $validator);
    }

    public function edit(Permission $permission)
    {
        //
    }

    public function update(Request $request, Permission $permission)
    {
        //
    }

    public function destroy(Permission $permission)
    {
        //
    }
}
