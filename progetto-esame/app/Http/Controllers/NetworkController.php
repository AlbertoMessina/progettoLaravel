<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\Clients;
class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $queryBuilder = Workout::join('clients', 'clients.user_id', '=', 'workouts.client_id')->select('clients.user_id','clients.name','clients.surname','clients.url');
        $queryBuilder->where('workouts.public', '1' )->where('workouts.client_id', '!=' ,$id)->groupBy('clients.user_id');
        $publicUsers = $queryBuilder->get();
        return view('network' ,  ['publicUsers' => $publicUsers]);
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

    public function getPublicResource($id){
        $queryBuilder = WORKOUT::WHERE('client_id', $id)->WHERE('public', '1');
        $workouts = $queryBuilder->get();
        return response()->json(array('success' => true , 'workouts' => $workouts), 200);
       
    }
}
