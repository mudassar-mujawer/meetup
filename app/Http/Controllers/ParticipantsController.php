<?php

namespace App\Http\Controllers;

use App\Participants;
use Illuminate\Http\Request;

class ParticipantsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 10;
        // Search for a user based on their name.
        if(!empty($request->input('name')) && !empty($request->input('locality'))) {
            $participants = Participants::where('name', 'like', '%'.$request->input('name').'%')
                                ->where('locality', 'like', '%'.$request->input('locality').'%')
                                ->paginate($limit);
        }
        else if (!empty($request->input('name'))) {
            $participants = Participants::where('name', 'like', '%'.$request->input('name').'%')->paginate($limit);
        }
        else if (!empty($request->input('locality'))) {
            $participants = Participants::where('locality', 'like', '%'.$request->input('locality').'%')->paginate($limit);
        }
        else{
            $participants = Participants::paginate($limit);
        }
        $data['participants'] = $participants;
        $data['request'] = array();
        if(!empty($request->all())) {
            foreach ($request->all() as $key => $value) {
                if(!in_array($key, array('_token','_method')) && !empty($value)){
                    $data['request'][$key] = $value;
                }
            }
        }

        
        return view('participants.index', compact('data'))->with(['page_title'=>'Participant list']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('participants.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
    $request->validate([
        'name' => 'required',
        'dob' => 'required|date|date_format:Y-m-d|before:today',
        'profession' => 'required|not_in:0',
        'locality' => 'required',
        'address' => 'required|max:50',
    ],['dob.date'=>'The dob is not a valid date.']);   

    $age = date_diff(date_create($request->dob), date_create('today'))->y;
    $participant = Participants::create(['name' => $request->name,'address' => $request->address,'DOB' => $request->dob,'profession' => $request->profession,'locality' => $request->locality,'number_of_guests' => $request->number_of_guests,'age' => $age]);
    return redirect('/participant/'.$participant->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $participants= Participants::find($id);  
        return view('participants.show',compact('participants',$participants));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $participants= Participants::find($id);  
        return view('participants.edit',compact('participants',$participants));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'name' => 'required|min:10',
        'dob' => 'required|date|date_format:Y-m-d|before:today',
        'profession' => 'required|not_in:0',
        'locality' => 'required',
        'address' => 'required|max:50',
    ],['dob.date'=>'The dob is not a valid date.']);  
    $age = date_diff(date_create($request->dob), date_create('today'))->y;
    
    $participant = Participants::find($id);  
    $participant->name =  $request->name; 
    $participant->DOB =  $request->dob; 
    $participant->age =  $age; 
    $participant->address =  $request->address; 
    $participant->profession =  $request->profession;  
    $participant->locality =  $request->locality; 
    $participant->number_of_guests =  $request->number_of_guests; 
         
        
        $participant->save();  

    return redirect('/participant/'.$participant->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $participant=Participants::find($id);  
        $participant->delete(); 
        $request->session()->flash('message', 'Successfully deleted the participant!'); 
        return redirect('/participant/list');
    }
}
