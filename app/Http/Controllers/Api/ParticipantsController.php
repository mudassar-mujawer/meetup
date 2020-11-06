<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Participants;
use App\Exceptions\ApiException;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $limit = 1;

        //Validate incoming request
        $validator = Validator::make(
        $input,
        ['p'       => 'bail|numeric|min:0'
        ],
        [
        'p.numeric' => 'Invalid page number',
        ]
        );

        $input['p'] = (isset($input['p'])) ? (int) $input['p'] : 1;

          
        $offset = ($input['p'] - 1) * $limit; //offset
        $formattedData['offset'] = $offset;

        $inputParams = [];
        $inputParams['limit'] = $limit;
        $inputParams['offset'] = $offset;
        if(!empty($request->input('name')) && !empty($request->input('locality'))) {
            $participants = Participants::where('name', 'like', '%'.$request->input('name').'%')
                                ->where('locality', 'like', '%'.$request->input('locality').'%')
                                ->offset($offset)->imit($limit)->get();;
        }
        else if (!empty($request->input('name'))) {
            $participants = Participants::where('name', 'like', '%'.$request->input('name').'%')
                            ->offset($offset)->limit($limit)->get();;
        }
        else if (!empty($request->input('locality'))) {
            $participants = Participants::where('locality', 'like', '%'.$request->input('locality').'%')->offset($offset)->limit($limit)->get();
        }
        else{
            $participants = Participants::offset($offset)->limit($limit)->get();
        }

        foreach($participants as $participant){
            $participantFormat = [];

            $participantFormat['name'] = $participant->name;
            $participantFormat['age'] = $participant->age;
            $participantFormat['DOB'] = $participant->DOB;
            $participantFormat['profession'] = $participant->profession;
            $participantFormat['locality'] = $participant->locality;
            $participantFormat['number_of_guests'] = $participant->number_of_guests;
            $participantFormat['address'] = $participant->address;
            $formattedData['participants'][] = $participantFormat;
        }

        $formattedData['page'] = $input['p'];
        $formattedData['limit'] = $limit;


        if (!$validator->fails()) {
            if (!empty($formattedData['participants'])) {
                $responseData = $formattedData;
            } else {
                return response()->json(['message' => 'Not Found!'], 404);
            }
        } else {
            $errorsMessages = $validator->errors()->all();
            return response()->json(['message' => $errorsMessages], 400);
        }

        return response()->json($responseData, 200);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
        $input,
        [
        'name' => 'required',
        'dob' => 'required|date|date_format:Y-m-d|before:today',
        'profession' => 'required|in:Employed,Student',
        'number_of_guests' => 'required|in:0,1,2',
        'locality' => 'required',
        'address' => 'required|max:50',],
        ['dob.date'=>'The dob is not a valid date.']
        );


    

        if (!$validator->fails()) {
            $age = date_diff(date_create($request->dob), date_create('today'))->y;
    $participant = Participants::create(['name' => $request->name,'address' => $request->address,'DOB' => $request->dob,'profession' => $request->profession,'locality' => $request->locality,'number_of_guests' => $request->number_of_guests,'age' => $age]);
    return response()->json(['message' => "inserted successfully!!!" ], 200);
        } else {
            $errorsMessages = $validator->errors()->all();
            return response()->json(['message' => $errorsMessages], 400);
        }
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
        $input,
        [
        'id' => 'required|numeric',    
        'name' => 'required',
        'dob' => 'required|date|date_format:Y-m-d|before:today',
        'profession' => 'required|in:Employed,Student',
        'number_of_guests' => 'required|in:0,1,2',
        'locality' => 'required',
        'address' => 'required|max:50',],
        ['dob.date'=>'The dob is not a valid date.']
        );


    

        if (!$validator->fails()) {
           $age = date_diff(date_create($request->dob), date_create('today'))->y;
    
    $participant = Participants::find($request->id);  
    $participant->name =  $request->name; 
    $participant->DOB =  $request->dob; 
    $participant->age =  $age; 
    $participant->address =  $request->address; 
    $participant->profession =  $request->profession;  
    $participant->locality =  $request->locality; 
    $participant->number_of_guests =  $request->number_of_guests; 
         
        
        $participant->save();  

    return response()->json(['message' => "update successfully!!!" ], 200);
        } else {
            $errorsMessages = $validator->errors()->all();
            return response()->json(['message' => $errorsMessages], 400);
        }
    }

    
}
