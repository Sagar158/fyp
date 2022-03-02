<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Usertype;
use App\Http\Requests\UserRequest;
use Lang;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Datatables\Datatables;
use Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use SoftDeletes;

    public function index()
    {
        $title = Lang::get('general.users');
        $users = Users::with('usertypes')->orderBy('id','desc')->get();
        return view('users.index',compact('title','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = Lang::get('general.create_users');
        $userType = Usertype::get();
        return view('users.create',compact('title','userType'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $userId = Auth::user()->id;
        $user = new Users;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->usertype_id = $request->usertype_id;
        $user->password = bcrypt($request->password);
        $user->created_by = $userId;
        if($user->save())
        {
            $status = Lang::get('general.fs');
            $message = Lang::get('general.user_created_successfully');
            return redirect()->route('users')->with($status, $message);
        }

        return redirect()->back()->withInput()->withErrors($user->getErrors());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $title = Lang::get('general.show_user');
        $userId = $request->userId;
        $user = Users::with('usertypes')->find($userId);
        return view('users.show',compact('title','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $title = Lang::get('general.edit_user');
        $userId = $request->userId;
        $user = Users::find($userId);
        $userType = Usertype::get();
        return view('users.edit',compact('title','user','userType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        $userId = $request->userId;
        $user = Users::find($userId);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->usertype_id = $request->usertype_id;
        if(!empty($request->password))
        $user->updated_by = Auth::user()->id;
        $user->password = bcrypt($request->password);
        if($user->save())
        {
            $status = Lang::get('general.fs');
            $message = Lang::get('general.user_updated_successfully');
            return redirect()->route('users')->with($status, $message);
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
        Users::destroy($userId);
        $status = Lang::get('general.fs');
        $message = Lang::get('general.user_deleted_successfully');
        return redirect()->route('users')->with($status, $message);
    }

    public function showUsers(Request $request)
    {
        $users = Users::with('usertypes');

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                $html = '
                            <div class="btn-group" role="group">
                                <button id="btnGroupVerticalDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action <i class="bx bx-caret-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="">
                                    <a class="dropdown-item" href="'.route('users.show', ['userId' => $user->id]).'"><i class="bx bx-show-alt"></i> '.Lang::get('general.show').'</a>
                                    <a class="dropdown-item" href="'.route('users.edit', ['userId' => $user->id]).'"><i class="bx bx-edit"></i>'.Lang::get('general.edit').'</a>
                                    <a href="'.route('users.destroy',['userId' => $user->id]).'" class="delete-action" title=""></a>
                                    <a class="dropdown-item delete" id=""><i class="bx bxs-trash"></i>'.Lang::get('general.delete').'</a>
                                </div>
                            </div>
                ';

                return $html;
            })
            ->make(true);
    }

}
