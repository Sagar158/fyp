<?php

namespace App\Http\Controllers\EndUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EndUsers;
use Lang;
use Auth;
use Yajra\Datatables\Datatables;
use App\Http\Requests\EndUserRequest;

class EndUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = Lang::get('general.endusers');
        return view('endusers.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = Lang::get('general.create').' ' .Lang::get('general.endusers');
        return view('endusers.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EndUserRequest $request)
    {
        $userId = Auth::user()->id;
        $enduser = new EndUsers;
        $enduser->name = $request->name;
        $enduser->email = $request->email;
        $enduser->mobile = $request->mobile;
        $enduser->created_by = $userId;
        if($enduser->save())
        {
            $status = Lang::get('general.fs');
            $message = Lang::get('general.user_created_successfully');
            return redirect()->route('endusers')->with($status, $message);
        }

        return redirect()->back()->withInput()->withErrors($user->getErrors());
    }

    /**
     * Display the specified resource.
     *
     * @param  eint  $id
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
    public function edit(Request $request)
    {
        $title = Lang::get('general.edit').' ' .Lang::get('general.endusers');
        $enduser = EndUsers::findOrFail($request->userId);
        return view('endusers.edit',compact('title','enduser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EndUserRequest $request)
    {

        $userId = $request->userId;
        $enduser = EndUsers::findOrFail($userId);
        $enduser->name = $request->name;
        $enduser->email = $request->email;
        $enduser->mobile = $request->mobile;
        $enduser->updated_by = Auth::user()->id;
        if($enduser->save())
        {
            $status = Lang::get('general.fs');
            $message = Lang::get('general.user_updated_successfully');
            return redirect()->route('endusers')->with($status, $message);
        }

        return redirect()->back()->withInput()->withErrors($user->getErrors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $userId = $request->userId;
        EndUsers::destroy($userId);
        $status = Lang::get('general.fs');
        $message = Lang::get('general.user_deleted_successfully');
        return redirect()->route('endusers')->with($status, $message);

    }

    public function showUsers(Request $request)
    {
        $user = Auth::user();
        $endusers = new EndUsers;
        if($user->usertype_id == 1)
        {
            $endusers = $endusers->where('created_by', $user->id);
        }
        $endusers = $endusers->get();

        return Datatables::of($endusers)
            ->addColumn('action', function ($user) {
                $html = '
                            <div class="btn-group" role="group">
                                <button id="btnGroupVerticalDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action <i class="bx bx-caret-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="">
                                    <a class="dropdown-item" href="'.route('endusers.edit', ['userId' => $user->id]).'"><i class="bx bx-edit"></i>'.Lang::get('general.edit').'</a>
                                    <a href="'.route('endusers.destroy',['userId' => $user->id]).'" class="delete-action" title=""></a>
                                    <a class="dropdown-item delete" id=""><i class="bx bxs-trash"></i>'.Lang::get('general.delete').'</a>
                                </div>
                            </div>
                ';

                return $html;
            })
            ->make(true);
        
    }
}
