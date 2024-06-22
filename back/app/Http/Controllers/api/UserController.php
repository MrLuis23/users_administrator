<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return jsonResponse(
            status: 200,
            data: User::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'email'         => 'required|email:rfc,dns|unique:users',
        'password'      => 'required',
        'first_name'    => 'required|max:100',
        'last_name'     => 'required|max:100',
        'phone_number'  => 'required|min:10|max:10|digits_between:10,10',
        ]);

        try { 
            DB::beginTransaction();
            $user = User::create([
                'email' => $request->email,
                'password' =>  bcrypt($request->password),
                'first_name' =>  $request->first_name,
                'last_name' =>  $request->last_name,
                'phone_number' =>  $request->phone_number,
            ]);

            DB::commit();
            $user->save();
            
            return jsonResponse(data: $user, status: 201);
        } catch (\Exception $e) {
            DB::rollback();
            return jsonResponse(
                status: 500,
                message: 'There was an error while processing your request: ' . $e->getMessage(),
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::find($id);
            if($user){
                return jsonResponse(
                    status: 200,
                    data: $user
                );
            }else{
                return jsonResponse(
                    status: 500,
                    message: 'There was an error while processing your request: User not found.'
                );
            }
        } catch (\Exception $e) {
            return jsonResponse(
                status: 500,
                message: 'There was an error while processing your request: ' . $e->getMessage()
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'email'         => 'sometimes|required|email:rfc,dns|unique:users',
                'password'      => 'sometimes|required',
                'first_name'    => 'sometimes|required|max:100',
                'last_name'     => 'sometimes|required|max:100',
                'phone_number'  => 'sometimes|required|min:10|max:10|digits_between:10,10',
            ]);
                
            User::where('id', $id)
                ->update($request->toArray());

            DB::commit();
            return jsonResponse(
                status: 200,
                data: User::find($id)
            );
        } catch (\Exception $e) {
            DB::rollback();
            
            return jsonResponse(
                status: 500,
                message: 'There was an error while processing your request: ' . $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
                
            $user = User::find($id);
            if($user){
                $user->delete();
                DB::commit();
                return jsonResponse(
                    status: 200,
                    message: 'User deleted succesfully.'
                );
            }else{
                
                DB::rollback();
                return jsonResponse(
                    status: 500,
                    message: 'There was an error while processing your request: User not found.'
                );
            }
        } catch (\Exception $e) {
            DB::rollback();
            return jsonResponse(
                status: 500,
                message: 'There was an error while processing your request: ' . $e->getMessage()
            );
        }
    }
}
