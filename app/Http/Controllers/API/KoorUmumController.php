<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\KoorUmum;
use Exception;
use Illuminate\Http\Request;

class KoorUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KoorUmum::all();
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
            $request->validate([
                'user_id' => 'required',
            ]);

            $KoorUmum = KoorUmum::create([
                'user_id' => $request->user_id,
            ]);

            $data = KoorUmum::where('id', '=', $KoorUmum->id)->get();

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
        $data = KoorUmum::where('id', '=', $id)->get();
        if($data){
            return ApiFormatter::createApi(200, "Success", $data);
        }else{
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
        //
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
