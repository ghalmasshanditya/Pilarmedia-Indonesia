<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user/profile');
    }

    public function create(Request $request, $id)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'     => 'required',
            'address'  => 'required',
            'birth'    => 'required',
            'gender'   => 'required',
            'phone'    => 'required',
        ];
        $messages = [
            'name.required'     => 'please enter the name first',
            'birth.required'    => 'please enter the birth first',
            'gender.required'   => 'please enter the gender first',
            'phone.required'    => 'please enter the phone first',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to update your profile.');
        }

        $data = array(
            'name'       => Request()->name,
            'address'    => Request()->address,
            'birth'      => Request()->birth,
            'gender'     => Request()->gender,
            'phone'      => Request()->phone,
            'updated_at' => date('Y-m-d N:i:s'),
        );
        // dd($data);
        User::where('id', Auth::user()->id)->update($data);
        // $this->Profile->updateData($data, $id);
        return redirect('profile')->with('message', 'Congratulations! Success to update your profile.');
    }

    public function updateProfile(Request $request, $id)
    {
        // die;
        $rules = [
            'profile' => 'required|max:4048|mimes:jpg,jpeg,gif,png',
        ];
        $messages = [
            'profile.required' => 'please select the file first',
            'profile.max'      => 'Maximum file 4 MB',
            'profile.mimes'    => 'Acceptable file types are JPG, JPEG, GIF, AND PNG',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all())->with('message', 'Sorry! Failed to change profile.');
        }
        // die;
        $file     = Request()->profile;
        $fileName = Auth::user()->email . '.' . $file->extension();
        $file->move(public_path('assets/dist/img/profile/'), $fileName);


        $data = array(
            'photo'       => $fileName,
            'updated_at' => date('Y-m-d N:i:s'),
        );
        // dd($data);
        User::where('id', Auth::user()->id)->update($data);
        return redirect('profile')->with('message', 'Congratulations! Success to update your profile.');
    }

    public function destroy(User $user)
    {
        //
    }
}
