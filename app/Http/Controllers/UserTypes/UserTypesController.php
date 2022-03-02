<?php

namespace App\Http\Controllers\UserTypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lang;
use Auth;
use App\Models\Usertype;
use Yajra\Datatables\Datatables;
use App\Models\Roles;
class UserTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = Lang::get('general.usertype');
        return view('usertypes.index',compact('title'));
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
    public function update(Request $request)
    {
        $userTypeId = $request->userTypeId;
        $roles = Roles::where('userTypeId', $userTypeId)->first();
        $roles->view_users = $request->view_users;
        $roles->create_users = $request->create_users;
        $roles->edit_users = $request->edit_users;
        $roles->delete_users = $request->delete_users;
        $roles->view_events = $request->view_events;
        $roles->create_events = $request->create_events;
        $roles->edit_events = $request->edit_events;
        $roles->delete_events = $request->delete_events;
        $roles->view_endusers = $request->view_endusers;
        $roles->create_endusers = $request->create_endusers;
        $roles->edit_endusers = $request->edit_endusers;
        $roles->delete_endusers = $request->delete_endusers;
        $roles->save();

        $status = Lang::get('general.fs');
        $message = Lang::get('general.roles_updated_successfully');
        return redirect()->route('usertypes')->with($status, $message);

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
    public function showUserType(Request $request)
    {
        $user = Auth::user();
        $usertype = Usertype::get();

        return Datatables::of($usertype)
            ->addColumn('action', function ($type) {
                $html = '
                            <div class="btn-group" role="group">
                                <button id="btnGroupVerticalDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action <i class="bx bx-caret-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="">
                                    <a class="dropdown-item" href="'.route('usertypes.roles', ['userTypeId' => $type->id]).'"><i class="bx bx-lock-open-alt"></i>'.Lang::get('general.roles').'</a>
                                </div>
                            </div>
                ';

                return $html;
            })
            ->make(true);
        
    }


    public function roles(Request $request)
    {
        $userTypeId = $request->userTypeId;
        $title = Lang::get('general.roles');
        $roles = Roles::where('usertypeId', $userTypeId)->first();

        $result[0]['link_name'] = 'users';
        $result[0]['permissions'] = array(
                                            '0'=>array('name'=>'view_users','value'=>$roles->view_users),
                                            '1'=>array('name'=>'create_users','value'=>$roles->create_users),
                                            '2'=>array('name'=>'edit_users','value'=>$roles->edit_users),
                                            '3'=>array('name'=>'delete_users','value'=>$roles->delete_users)
                                            );  

        $result[1]['link_name'] = 'events';
        $result[1]['permissions'] = array(
                                            '0'=>array('name'=>'view_events','value'=>$roles->view_events),
                                            '1'=>array('name'=>'create_events','value'=>$roles->create_events),
                                            '2'=>array('name'=>'edit_events','value'=>$roles->edit_events),
                                            '3'=>array('name'=>'delete_events','value'=>$roles->delete_events)
                                            );      
    

                                            
        $result[2]['link_name'] = 'endusers';
        $result[2]['permissions'] = array(
                                            '0'=>array('name'=>'view_endusers','value'=>$roles->view_endusers),
                                            '1'=>array('name'=>'create_endusers','value'=>$roles->create_endusers),
                                            '2'=>array('name'=>'edit_endusers','value'=>$roles->edit_endusers),
                                            '3'=>array('name'=>'delete_endusers','value'=>$roles->delete_endusers)
                                            );                                              
    
        return view('users.roles.edit',compact('roles','title','result','userTypeId'));
    }
}
