<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Request as Req;
use App\Parking_space;
use DB;
use Illuminate\Support\Facades\Response;
use Session;

class Parking_spaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $parking_spaces = Parking_space::all();

        return view('crud.parking_spaces.index', compact('parking_spaces'));

    }
    public function detailsIndex()
    {
       $landDetails_id = Req::get ( 'landDetails_id' );
       $parking_spaces = DB::table('parking_spaces')->where('id',$landDetails_id)->get();

        return view('crud.parking_spaces.index', compact('parking_spaces'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('crud.parking_spaces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'name'=>'required',
            'address'=>'required',
            'description'=>'required'
        ]);

        $parking_space = new Parking_space([
            'landowner_id' => Session::get('landownerid'),
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'description' => $request->get('description'),
            
            //'open_on' => $request->get('open_on'),

             'poya' => $request->get('opentime1'),
             'public' => $request->get('opentime2'),
             'bank' => $request->get('opentime3'),
            // 'reservation_status' => $request->get('reservation_status'),
        ]);

        $parking_space->save();
        return redirect()->route('loginlandowner');
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
         $parking_space = Parking_space::find($id);
        return view('crud.parking_spaces.edit', compact('parking_space'));
    }
    public function editIndex()
    {
         $landEdit_id = Req::get ( 'landEdit_id' );
         $parking_space = Parking_space::find($landEdit_id);
        return view('crud.parking_spaces.edit', compact('parking_space'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'first_name'=>'required',
    //         'last_name'=>'required',
    //         'email'=>'required'
    //     ]);
    //
    //     $parking_space = Parking_space::find($id);
    //     $parking_space->first_name =  $request->get('first_name');
    //     $parking_space->last_name = $request->get('last_name');
    //     $parking_space->email = $request->get('email');
    //     $parking_space->job_title = $request->get('job_title');
    //     $parking_space->city = $request->get('city');
    //     $parking_space->country = $request->get('country');
    //     $parking_space->save();
    //
    //     return redirect('/parking_spaces')->with('success', 'Parking_space updated!');
    // }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'description'=>'required'
        ]);

        $parking_space = Parking_space::find($id);
        $parking_space->name =  $request->get('name');
        $parking_space->address = $request->get('address');
        $parking_space->longitude = $request->longitude;
        $parking_space->latitude = $request->latitude;
        $parking_space->description = $request->get('description');
        $parking_space->reservation_status_on = $request->get('reservation_status');
        $parking_space->poya = $request->get('opentime1');
        $parking_space->public = $request->get('opentime2');
        $parking_space->bank = $request->get('opentime3');
        // $parking_space->city = $request->get('city');
        // $parking_space->country = $request->get('country');
        $parking_space->save();

        return redirect()->route('loginlandowner')->with('success', 'Parking_space updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteIndex()
    {
        $id = Req::get('landDelete_id');
        $parking_space = Parking_space::find($id);
        $parking_space->delete();

        return redirect()->route('loginlandowner')->with('success', 'Parking_space deleted!');
    }

    public function verify()
    {
        $id = Req::get('land_id');
        $parking_space = Parking_space::find($id);
        $parking_space->verified = '1';
        $parking_space->admin_id = Session::get('adminid');
        $parking_space->save();

        return redirect()->route('loginadmin');
    }

    public function search(Request $request){
        if($request->ajax()){
            $output='';
            $parking_spaces =DB::table('parking_spaces')->where('name','LIKE','%'.$request->q.'%')->orWhere('address','LIKE','%'.$request->q.'%')->get();
            if($parking_spaces){
                foreach($parking_spaces as $parking_space){
                    $output .= '<tr>
                    <th scope="row">'.$parking_space->id.'</th>
                    <td>'.DB::table('landowners')->where('id',$parking_space->landowner_id)->value('first_name').'</td>
                    <td>'.$parking_space->name.'</td>
                    <td>'.$parking_space->address.'</td>
                    <td>'.($parking_space->verified=='1'?'Yes':'No')
                    .'<td>';
                    if($parking_space->verified!='1'){
                      $output .= '<a href="/verifyland?land_id={{$parking_space->id}}">
                        <button class="btn btn-outline-success" type="submit">Verify</button> 
                      </a>';
                    }
                    $output .= '</td>
                  </td>
                    <td>'.DB::table('admins')->where('id',$parking_space->admin_id)->value('first_name').'</td>
                    <td>';
                    if($parking_space->latitude && $parking_space->longitude){
                        $output .= '<a href="http://maps.google.com/maps?q='.$parking_space->latitude.','.$parking_space->longitude.'&ll='.$parking_space->latitude.','.$parking_space->longitude.'&z=17"  target="_blank">
                                    <button class="btn btn-outline-success">View</button>
                                    </a>';
                    }
                    $output .= '</td>
                                </tr>';
                    }

                return Response($output);
            }
        }
    }

    public function searchfordriver(Request $request){
        if($request->ajax()){
            $output='';
            $parking_spaces =DB::table('parking_spaces')->where('name','LIKE','%'.$request->q.'%')->orWhere('address','LIKE','%'.$request->q.'%')->get();
            if($parking_spaces){
                foreach($parking_spaces as $parking_space){
                    $output .= '<tr>
                    <th scope="row">'.$parking_space->id.'</th>
                    <td>'.$parking_space->name.'</td>
                    <td>'.$parking_space->address.'</td>
                    <td>'.DB::table('landowners')->where('id',$parking_space->landowner_id)->value('first_name').'</td>
                    <td>'.($parking_space->verified=='1'?'Yes':'No');
                    $output .= '<td>';
                    if($parking_space->latitude && $parking_space->longitude){
                    $output .= '<a href="http://maps.google.com/maps?q='.$parking_space->latitude.','.$parking_space->longitude.'&ll='.$parking_space->latitude.','.$parking_space->longitude.'&z=17"  target="_blank">
                        <button class="btn btn-success">View</button>
                    </a>';
                    }
                    $output .= '</td>';
                }

                return Response($output);
            }
        }
    }
}
