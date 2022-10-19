<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        if ($data) {
            return ApiFormatter::createApi(200, "Success", $data);
        } else {
            return ApiFormatter::createApi(400, "Failed");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'uid' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = User::create([
                'uid' => $request->uid,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $data = User::where('id', '=', $user->id)->get();

            if ($data) {
                return ApiFormatter::createApi(200, "Success", $data);
            } else {
                return ApiFormatter::createApi(400, "Failed");
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, "Failed", $error);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::where('id', '=', $id)->get();
        if ($data) {
            return ApiFormatter::createApi(200, "Success", $data);
        } else {
            return ApiFormatter::createApi(400, "Failed");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $updatedData = $request->all();
            User::where('id', $id)->update($updatedData);
            return ApiFormatter::createApi(200, "Success");
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, "Failed", $error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
