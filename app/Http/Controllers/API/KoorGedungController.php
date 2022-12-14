<?php



namespace App\Http\Controllers\API;



use App\Helpers\ApiFormatter;

use App\Http\Controllers\Controller;

use App\Models\Jadwal;

use App\Models\KoorGedung;

use App\Models\Petugas;

use App\Models\User;

use Exception;

use Illuminate\Http\Request;



class KoorGedungController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $data = KoorGedung::with('user')->get();

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

            KoorGedung::create([

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

        $data = KoorGedung::where('id', '=', $id)->get();

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

    public function update(Request $request, $user_id)

    {

        try{

            $updatedData = $request->all();

            KoorGedung::where('user_id', $user_id)->update($updatedData);

            Jadwal::create([

                'user_id' => $user_id,

                'code' => $request->code,

                'clean_area' => $request->clean_area,

                'keterangan' => 'Pagi',

                'status' => 0

            ]);

            Jadwal::create([

                'user_id' => $user_id,

                'code' => $request->code,

                'clean_area' => $request->clean_area,

                'keterangan' => 'Siang',

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



    public function getKoorByUid($uid)

    {

        $dataTemp = User::where('uid', $uid)->get();

        $data = KoorGedung::where('user_id', $dataTemp[0]->id)->with('user')->get();

        if($data){

            return ApiFormatter::createApi(200, "Success", $data);

        }else{

            return ApiFormatter::createApi(400, "Failed");

        }

    }



    public function getStatusPetugas($id)

    {

        try{

            $dataKoor = KoorGedung::where('user_id', $id)->get();

            $dataPetugas = Petugas::where('code', $dataKoor[0]->code)->count();

            $petugasDone = Petugas::where('code', $dataKoor[0]->code)->whereHas('jadwal', function($q){

                $q->where('status', '=', '1');

            })->with('user')->count();

            

            return ApiFormatter::createApi(200, "Success", ['petugas' => $dataPetugas, 'listDone' => $petugasDone]);

        }catch(Exception $error){

            return ApiFormatter::createApi(400, "Failed", $error);

        }

    }

    

    public function jumlahPetugas(){

        try{

             $dataPetugas = Petugas::all()->count();

             return ApiFormatter::createApi(200, "Success", $dataPetugas);

        }catch(Exception $error){

            return ApiFormatter::createApi(400, "Failed", $error);

        }

    }



    public function updateCode(Request $request, $user_id)

    {

        try{

            $updatedData = $request->all();

            KoorGedung::where('user_id', $user_id)->update($updatedData);

            $data = Jadwal::where('user_id', $user_id)->update([

                'clean_area' => $request->clean_area,

                'status' => 0

            ]); 

            return ApiFormatter::createApi(200, "Success", $data);

        }catch(Exception $error){

            return ApiFormatter::createApi(400, "Failed", $error);

        }

    }

}