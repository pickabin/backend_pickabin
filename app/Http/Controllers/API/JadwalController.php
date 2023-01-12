<?php



namespace App\Http\Controllers\API;



use App\Helpers\ApiFormatter;

use App\Http\Controllers\Controller;

use App\Models\AktivitasKoor;

use App\Models\AktivitasPetugas;

use App\Models\Jadwal;

use App\Models\KoorGedung;

use Exception;

use Carbon\Carbon;

use Illuminate\Http\Request;



class JadwalController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index($id)

    {

        $datas = Jadwal::where('user_id', $id)->get();

        if ($datas) {

            foreach ($datas as $data) {

                if (($data->status == 1) && ($data->updated_at->format('m/d/Y') != Carbon::now()->format('m/d/Y'))) {

                    Jadwal::where('id', $data->id)->update([

                        'status' => 0

                    ]);

                }

            }

            $datas = Jadwal::where('user_id', $id)->with('user')->get();

            return ApiFormatter::createApi(200, "Success", $datas);

        } else {

            return ApiFormatter::createApi(400, "Failed");

        }

    }

    

    public function getAll()

    {

        $datas = Jadwal::all();

        if($datas){

            return ApiFormatter::createApi(200, "Success", $datas);

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

        //

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

        try {

            Jadwal::where('id', $id)->update([

                'status' => 1

            ]);

            $data = Jadwal::where('id', $id)->get();

            $getKoor = KoorGedung::where('user_id', $data[0]->user_id)->count();

            if ($getKoor != 0) {

                $dataKoor = KoorGedung::where('user_id', $data[0]->user_id)->get();

                AktivitasKoor::create([

                    'jadwal_id' => $id,

                    'koor_gedung_id' => $dataKoor[0]->id,

                    'date' =>  Carbon::now(),

                    'time' =>  Carbon::now(),

                    'photo' => $request->photo

                ]);

            } else {

                AktivitasPetugas::create([

                    'jadwal_id' => $id,

                    'petugas_id' => $data[0]->petugas_id,

                    'date' =>  Carbon::now(),

                    'time' =>  Carbon::now(),

                    'photo' => $request->photo

                ]);

            }

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

    public function getStatus()
    {
        try{
            $listDone = []; 
            $dataJadwal = []; 
            $datas = KoorGedung::select('code')->distinct()->get();       
            $result = $datas->count();
            for($i = 0; $i < $result; $i++){
                $listDone[] = array(''.$datas[$i]->code => Jadwal::where('code', $datas[$i]->code)->where('status', 1)->count());
                $dataJadwal[] = array(''.$datas[$i]->code => Jadwal::where('code', $datas[$i]->code)->count());
            }
            $done = call_user_func_array('array_merge', $listDone);
            $data = call_user_func_array('array_merge', $dataJadwal);

            // return ApiFormatter::createApi(200, "Success",  ['data' => $data, 'done' => $done]);
            return ApiFormatter::createApi(200, "Success",  ['done' => $done]);
        }catch(Exception $error){
            return ApiFormatter::createApi(400, "Failed", $error);
        }
    }

}

