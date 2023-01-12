<?php



namespace App\Http\Controllers\API;



use App\Helpers\ApiFormatter;

use App\Http\Controllers\Controller;

use App\Models\AktivitasKoor;

use App\Models\Jadwal;

use Exception;

use Illuminate\Http\Request;



class AktivitasKoorController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index($id)

    {

        $jadwal = Jadwal::where('user_id', $id)->with('user')->get();
        $data = AktivitasKoor::where('jadwal_id', $jadwal[0]->id)->with('jadwal', 'jadwal.user')->orderBy('date', 'desc')->get()->toArray();
        $data2 = AktivitasKoor::where('jadwal_id', $jadwal[1]->id)->with('jadwal', 'jadwal.user')->orderBy('date', 'desc')->get()->toArray();
        $result = array_merge($data, $data2);

        if($data){
            return ApiFormatter::createApi(200, "Success", $result);
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



            $aktivitasKoor = AktivitasKoor::create([

                'jadwal_id' => $request->jadwal_id,

                'date' => $request->date,

                'time' => $request->time,

                'photo' => $request->photo,

            ]);



            $data = AktivitasKoor::where('id', '=', $aktivitasKoor->id)->get();



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

        $data = AktivitasKoor::find($id);

        $data->delete();

         if($data){

            return ApiFormatter::createApi(200, "Success", $data);

        }else{

            return ApiFormatter::createApi(400, "Failed");

        }

    }

}

