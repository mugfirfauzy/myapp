<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    //
    public function index(Request $request) {
        $users = DB::table('users')
        ->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%'.$request->search.'%');
        })
        ->paginate(10);
        // $users = User::paginate(10);
        return view('pages.user.index', compact('users'));
    }

    public function create(Request $request) {
        return view('pages.user.create');
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        try {
            User::create($data);
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode != ""){ //$errorCode == '1062'
                // dd($errorCode);
                return redirect()->route('user.index')->with('error', $errorCode);
            }
        }

        return redirect()->route('user.index')->with('success', 'User successfully created.');
        // User::create($data);
        // return redirect()->route('user.index');
    }

    // public function show(Request $request) {
    //     return view('pages.user.index');
    // }
    public function edit($id) {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }
    public function update(Request $request, $id) {
        $data = $request->all();
        $user = User::findOrFail($id);
        if($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $user->password;
        }
        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User successfully edited.');
    }
    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted.');
    }


}
