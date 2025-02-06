<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\Auth;


class AddUserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Staff::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', fn($row) => $row->name)
                ->addColumn('email', fn($row) => $row->email)
                ->addColumn('role', fn($row) => $row->role)
                ->addColumn('date', fn($row) => $row->created_at->format('d M Y'))
                ->addColumn('action', function ($row) {
                    return '
                        <div>
                            <a href="' . route('admin/destroy-users', $row->email) . '" class="delete btn btn-danger btn-sm Delete-button">Delete</a>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.adduser.users');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'role' => 'required|string|max:255',
            'dob' => 'required|date',
            'password' => 'required|min:6'
        ]);

        Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'dob' => $request->dob,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin/users')->with('success', 'User added successfully');
    }

    public function destroy($email){
        $data = Staff::where('email',$email)->first();
        $data->delete();

        return redirect()->route('admin/users')->with('success', 'User deleted successfully');
    }
}
