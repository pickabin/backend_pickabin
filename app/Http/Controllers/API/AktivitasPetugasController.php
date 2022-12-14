<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\AktivitasPetugas;
use App\Models\Jadwal;
use App\Models\Petugas;
use Exception;
use Illuminate\Http\Request;

class AktivitasPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $jadwal = Jadwal::where('user_id', $id)->with('user')->get();
        $data = AktivitasPetugas::where('jadwal_id', $jadwal[0]->id)->with('jadwal', 'jadwal.user')->orderBy('date', 'desc')->get()->toArray();
        $data2 = AktivitasPetugas::where('jadwal_id', $jadwal[1]->id)->with('jadwal', 'jadwal.user')->orderBy('date', 'desc')->get()->toArray();
        $result = array_merge($data, $data2);

        if($data){
            return ApiFormatter::createApi(200, "Success", $result);
        }else{
            return ApiFormatter::createApi(400, "Failed");
        }
    }
    
    public function notif()
    {
      $jadwal = Jadwal::with('user')->get();
      $data = AktivitasPetugas::with('jadwal', 'jadwal.user')->orderBy('date', 'desc')->get();
        if($data){
            return ApiFormatter::createApi(200, "Success", $data);
        }else{
            return ApiFormatter::createApi(400, "Failed");
        }
    }
    
    public function getByCode($code){
        $petugas = Petugas::where('code',$code)->with('user')->with('aktivitasPetugas')->get();
        if($petugas){
            return ApiFormatter::createApi(200, "Success", $petugas);
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
            $request->validate([
                'jadwal_id' => 'required',
                'date' => 'required',
                'time' => 'required',
                'photo' => 'required',
            ]);

            $aktivitasPetugas = AktivitasPetugas::create([
                'jadwal_id' => $request->jadwal_id,
                'date' => $request->date,
                'time' => $request->time,
                'photo' => $request->photo,
            ]);

            $data = AktivitasPetugas::where('id', '=', $aktivitasPetugas->id)->get();

            if($data){
                return ApiFormatter::createApi(200, "Success", $data);
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
            $updatedData = $request->all();
            AktivitasPetugas::where('id', $id)->update(['status' => 2]);
            $data = AktivitasPetugas::where('id', $id)->update($updatedData);     
            if($data){
                return ApiFormatter::createApi(200, "Success", $data);
            }else{
                return ApiFormatter::createApi(400, "Failed");
            }
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
        $data = AktivitasPetugas::find($id);
        $data->delete();
         if($data){
            return ApiFormatter::createApi(200, "Success", $data);
        }else{
            return ApiFormatter::createApi(400, "Failed");
        }
    }

    public function aktivitasConfirmed($id)
    {
        try{
            AktivitasPetugas::where('id', $id)->update([
                'status' => 1
            ]);       
            return ApiFormatter::createApi(200, "Success");
        }catch(Exception $error){
            return ApiFormatter::createApi(400, "Failed", $error);
        }
    }

    public function aktivitasDeclined($id)
    {
        try{
            AktivitasPetugas::where('id', $id)->update([
                'status' => 2
            ]);       
            return ApiFormatter::createApi(200, "Success");
        }catch(Exception $error){
            return ApiFormatter::createApi(400, "Failed", $error);
        }
    }
}
