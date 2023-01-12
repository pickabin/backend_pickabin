<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\KoorGedung;
use App\Models\LaporAcara;
use App\Models\Petugas;
use Exception;
use Illuminate\Http\Request;

class LaporAcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $dataPetugas = Petugas::where('user_id', $id)->get();
        $dataKoor = KoorGedung::where('user_id', $id)->get();
        if($dataPetugas->count() != 0 ){
            $data = LaporAcara::where([['code', $dataPetugas[0]->code], ['status', 0]])->orderBy('date', 'desc')->get();
        }else if($dataKoor->count() != 0){
            $data = LaporAcara::where([['code', $dataKoor[0]->code], ['status', 0]])->orderBy('date', 'desc')->get();
        }
        
        if($data){
            return ApiFormatter::createApi(200, "Success", $data);
        }else{
            return ApiFormatter::createApi(400, "Failed");
        }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLaporanAcara($id)
    {
        $dataPetugas = Petugas::where('user_id', $id)->get();
        $dataKoor = KoorGedung::where('user_id', $id)->get();
        if($dataPetugas->count() != 0 ){
            $data = LaporAcara::where('code', $dataPetugas[0]->code)->orderBy('date', 'desc')->get();
        }else if($dataKoor->count() != 0){
            $data = LaporAcara::where('code', $dataKoor[0]->code)->orderBy('date', 'desc')->get();
        }
        
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
        try{
            $laporAcara = LaporAcara::create([
                'code' => $request->code,
                'tempat' => $request->tempat,
                'title' => $request->title,
                'date' => $request->date,
                'time' => $request->time,
                'description' => $request->description,
                'status' => 0
            ]);

            if($laporAcara){
                return ApiFormatter::createApi(200, "Success", $laporAcara);
            }else{
                return ApiFormatter::createApi(400, "Failed");
            }

        }catch(Exception $error){
            return ApiFormatter::createApi(400, "Failed");
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
    public function update(Request $request, $id)
    {
        try{
            LaporAcara::where('id', $id)->update([
                'status' => 1
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
}
