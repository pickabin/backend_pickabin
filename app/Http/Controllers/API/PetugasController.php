<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Petugas;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code)
    {
        $data = Petugas::where('code', $code)->with('user')->get();
        if($data){
            return ApiFormatter::createApi(200, "Success", $data);
        }else{
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
        $data = User::where('uid', '=', $request->uid)->get();
        try{
            Petugas::create([
                'user_id' => $data[0]->id,
            ]);
            return ApiFormatter::createApi(200, "Success");
        }catch(Exception $error){
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
        //
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
    public function update(Request $request, $user_id)
    {
        try{
            $updatedData = $request->all();
            Petugas::where('user_id', $user_id)->update($updatedData);
            Jadwal::create([
                'user_id' => $user_id,
                'clean_area' => $request->clean_area,
                'status' => 0
            ]);
            return ApiFormatter::createApi(200, "Success");
        }catch(Exception $error){
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

    public function fetchPetugas()
    {
        $data = Petugas::with('user')->get();
        if($data){
            return ApiFormatter::createApi(200, "Success", $data);
        }else{
            return ApiFormatter::createApi(400, "Failed");
        }
    }

    public function getPetugasByUid($uid)
    {
        $dataTemp = User::where('uid', $uid)->get();
        $data = Petugas::where('user_id', $dataTemp[0]->id)->get();
        if($data){
            return ApiFormatter::createApi(200, "Success", $data);
        }else{
            return ApiFormatter::createApi(400, "Failed");
        }
    }
}
