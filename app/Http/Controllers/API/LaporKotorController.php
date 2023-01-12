<?php



namespace App\Http\Controllers\API;



use App\Helpers\ApiFormatter;

use App\Http\Controllers\Controller;

use App\Models\Jadwal;

use App\Models\LaporKotor;
use App\Models\Petugas;
use Exception;

use Illuminate\Http\Request;



class LaporKotorController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $data = LaporKotor::all();

        if($data){

            return ApiFormatter::createApi(200, "Success", $data);

        }else{

            return ApiFormatter::createApi(400, "Failed");

        }

    }



    public function getLaporanByArea($user_id)
    {
        $dataPetugas = Petugas::where('user_id', $user_id)->get();
        // $jadwal = Jadwal::where('user_id', $user_id)->get();
        $data = LaporKotor::where([['clean_area', $dataPetugas[0]->clean_area], ['status', 0], ['code', $dataPetugas[0]->code]])->get();
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

            $laporKotor = LaporKotor::create([

                'code' => $request->code,

                'clean_area' => $request->clean_area,

                'photo' => $request->photo,

                'deskripsi' => $request->deskripsi,

                'status' => 0

            ]);



            if($laporKotor){

                return ApiFormatter::createApi(200, "Success", $laporKotor);

            }else{

                return ApiFormatter::createApi(400, "Failed");

            }



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

    public function update(Request $request, $id)

    {

        try{

            LaporKotor::where('id', $id)->update([

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

