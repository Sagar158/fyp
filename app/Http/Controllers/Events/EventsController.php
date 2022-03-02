<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lang;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Datatables\Datatables;
use App\Models\Events;
use App\Models\Promotions;
use App\Http\Requests\EventRequest;
use Auth;
use Spatie\GoogleCalendar\Event;
use Illuminate\Support\Carbon;
use App\Models\EndUsers;
use App\Models\Users;
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use SoftDeletes;
    public function index()
    {
        $title = Lang::get('general.events');
        return view('events.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = Lang::get('general.create_event');
        $promotions = Promotions::select('id','name')->get();
        return view('events.create',compact('title','promotions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $event = new Events();
        $event->promo_id = $request->promo_id;
        $event->title = $request->title;
        $event->from = $request->from;
        $event->to = $request->to;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->created_by = $userId;
        if($event->save())
        {
            if($request->promo_id == 1 && $user->usertype_id != 3)
            {
                $endUsers = Users::select('email')->where('created_by', $userId)->get();
            }
            else
            {
                $endUsers = EndUsers::select('email')->get();
            }

            $users = [];
            if(!empty($endUsers))
            {
                foreach($endUsers as $user)
                {
                    $users[] = $user->email;
                }
            }

            $from = date('Y-m-d',strtotime($request->from));
            $to = date('Y-m-d',strtotime($request->to));

            $args = [$from, $to, strip_tags($request->description), $request->title,$request->location,$users];
            $args = base64_encode(json_encode($args));

            $script = public_path().'\python\sendInvitation.py '.escapeshellarg(json_encode($args));

            $command = escapeshellcmd('python '.$script);
            $output = shell_exec($command);
            $event = Events::findOrFail($event->id);
            $event->google_event_id = $output;
            $event->save();

            $status = Lang::get('general.fs');
            $message = Lang::get('general.event_created_successfully');
            return redirect()->route('event')->with($status, $message);
        }

        return redirect()->back()->withInput()->withErrors($event->getErrors());
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
    public function edit(Request $request)
    {
        $title = Lang::get('general.edit_event');
        $eventId = $request->eventId;
        $event = Events::findOrFail($eventId);
        $promotions = Promotions::select('id','name')->get();
        return view('events.edit',compact('title','promotions','event'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request)
    {
        $userId = Auth::user()->id;
        $eventId = $request->eventId;
        $event = Events::findOrFail($eventId);
        $event->promo_id = $request->promo_id;
        $event->title = $request->title;
        $event->from = $request->from;
        $event->to = $request->to;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->updated_by = $userId;
        if($event->save())
        {
            $status = Lang::get('general.fs');
            $message = Lang::get('general.event_updated_successfully');
            return redirect()->route('event')->with($status, $message);
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
        $eventId = $request->eventId;
        Events::destroy($eventId);
        $status = Lang::get('general.fs');
        $message = Lang::get('general.event_deleted_successfully');
        return redirect()->route('event')->with($status, $message);
    }
    public function showEvents(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $events = Events::with(['promotion']);
        if($user->usertype_id != 1)
        {
            $events = $events->where('created_by', $userId);
        }
        $events = $events->get();

        return Datatables::of($events)
            ->addColumn('promo',function($event){
                return $event->promotion->name;
            })
            ->addColumn('action', function ($event) {
                $html = '
                            <div class="btn-group" role="group">
                                <button id="btnGroupVerticalDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action <i class="bx bx-caret-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="">
                                    <a class="dropdown-item" href="'.route('event.edit', ['eventId' => $event->id]).'"><i class="bx bx-edit"></i>'.Lang::get('general.edit').'</a>
                                    <a href="'.route('event.destroy',['eventId' => $event->id]).'" class="delete-action" title=""></a>
                                    <a class="dropdown-item delete" id=""><i class="bx bxs-trash"></i>'.Lang::get('general.delete').'</a>
                                </div>
                            </div>
                        ';

                return $html;
            })
            ->make(true);
    }


    public function calendar()
    {
        $user = Auth::user();
        $userId = $user->id;
        $title = Lang::get('general.events_calendar');
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
            // $data = json_encode($data,true);

        return view('calendar.index',compact('title'))->with(['events'=>$data]);
    }

    public function calendarRecall()
    {
        $arg1 = date('Y-m-d H:i:s');
        $arg2 = date('Y-m-d H:i:s',strtotime(' +1 day'));



        $arg = [
                'start_time' => date('Y-m-d H:i:s'),
                'end_time' => date('Y-m-d H:i:s',strtotime(' +1 day')),
                // 'description' =>
               ];

        $arg = json_encode($arg);
        // $arg = implode(',',$arg);

        $script = public_path().'\python\sendInvitation.py '.$arg;

        $command = escapeshellcmd('python '.$script);
        $output = shell_exec($command);
        echo $output;
        // echo shell_exec('python '.$script);
    }

}
