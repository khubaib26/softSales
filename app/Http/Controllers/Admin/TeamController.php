<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('role_or_permission:Team access|Team create|Team edit|Team delete', ['only' => ['index','show']]);
         $this->middleware('role_or_permission:Team create', ['only' => ['create','store']]);
         $this->middleware('role_or_permission:Team edit', ['only' => ['edit','update']]);
         $this->middleware('role_or_permission:Team delete', ['only' => ['destroy']]);
    } 

    public function index()
    {
        $teams = Team::all();
        return view('setting.team.index',['teams'=>$teams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('active','1')->whereNotIn('id', [1])->get();
        return view('setting.team.new',['users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation 
        $request->validate([
            'name'=>'required',
            'team_lead_id' =>'required',
        ]);

        //dd($request);

        $team = Team::create([
            'name'=>$request->name,
            'team_lead_id'=>$request->team_lead_id,
            'publish' =>$request->publish
        ]);
        return redirect()->back()->withSuccess('Team created !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        $users = User::where('active','1')->whereNotIn('id', [1])->get();
        return view('setting.team.edit',['team'=>$team, 'users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        // validation 
        $validated = $request->validate([
            'name'=>'required',
            'team_lead_id' =>'required',
            'publish' => 'required'
        ]);

        $team->update($validated);
        return redirect()->back()->withSuccess('Team updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->back()->withSuccess('Team deleted !!!');
    }
}
