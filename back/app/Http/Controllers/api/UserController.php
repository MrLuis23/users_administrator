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
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'email' => 'required|email:rfc,dns|unique:users',
                'password' => 'required',
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'phone_number' => 'required|min:10|max:10|digits_between:10,10',
            ]);
                
            $user = User::create([
                'email' => $request->email,
                'password' =>  bcrypt($request->password),
                'first_name' =>  $request->first_name,
                'last_name' =>  $request->last_name,
                'phone_number' =>  $request->phone_number,
            ]);

            DB::commit();
            $user->save();
            
            return response()->json([$user], 201);
        } catch (\Exception $e) {
            DB::rollback();
            $content = array(
                'success' => false,
                'message' => 'There was an error while processing your request: ' .
                    $e->getMessage()
            );
            return response($content)->setStatusCode(500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
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
            return response()->json([User::find($id)], 201);
        } catch (\Exception $e) {
            DB::rollback();
            $content = array(
                'success' => false,
                'message' => 'There was an error while processing your request: ' .
                    $e->getMessage()
            );
            return response($content)->setStatusCode(500);
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
                return response()->json([User::find($id)], 201);
            }else{
                
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $content = array(
                'success' => false,
                'message' => 'There was an error while processing your request: ' .
                    $e->getMessage()
            );
            return response($content)->setStatusCode(500);
        }
    }
}
