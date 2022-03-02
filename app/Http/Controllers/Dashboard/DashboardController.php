<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\EndUsers;
use App\Models\Events;
use Illuminate\Http\Request;
use Lang;
use Auth;
use App\Models\Users;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = Lang::get('general.dashboard');
        $user = Auth::user();
        $userId = $user->id;
        $totalUsers = Users::count();
        $totalEndUsers = EndUsers::count();
        $totalEvents = Events::count();

        $events = Events::select('id','from','to','title');
        if($user->usertype_id != 1)
        {
            $events = $events->where('created_by', $userId);
        }
        $events = $events->get();
        $data = [];
        if(!empty($events))
        {
            foreach($events as $key => $event)
            {
                $data[$key]['title'] = $event->title;
                $data[$key]['start'] = date("Y-m-d",strtotime($event->from));
                $data[$key]['to'] = date("Y-m-d",strtotime($event->to));
                // $data[$key]['to'] = 'Sat Jan 01 2022 05:00:00 GMT+0500 (Pakistan Standard Time)';

                // $data[$key]['start'] = date('Y-m-d',strtotime($event->from));
                // $data[$key]['end'] = date('Y-m-d',strtotime($event->to));
                $data[$key]['id'] = $event->id;
                $data[$key]['allDay'] = true;
                $data[$key]['editable'] = true;
                $data[$key]['eventDurationEditable'] = true;
            }
        }






        return view('dashboard',compact('title','totalUsers','totalEndUsers','totalEvents'))->with(['events'=>$data]);
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
}
