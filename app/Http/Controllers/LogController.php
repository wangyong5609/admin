<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Log;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class LogController.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:35:21am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - log';
        $logs = Log::paginate(6);
        return view('log.index',compact('logs','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - log';
        
        return view('log.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $log = new Log();

        
        $log->mission_id = $request->mission_id;

        
        $log->project = $request->project;

        
        $log->original = $request->original;

        
        $log->modification = $request->modification;

        
        
        $log->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new log has been created !!']);

        return redirect('log');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show - log';

        if($request->ajax())
        {
            return URL::to('log/'.$id);
        }

        $log = Log::findOrfail($id);
        return view('log.show',compact('title','log'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - log';
        if($request->ajax())
        {
            return URL::to('log/'. $id . '/edit');
        }

        
        $log = Log::findOrfail($id);
        return view('log.edit',compact('title','log'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $log = Log::findOrfail($id);
    	
        $log->mission_id = $request->mission_id;
        
        $log->project = $request->project;
        
        $log->original = $request->original;
        
        $log->modification = $request->modification;
        
        
        $log->save();

        return redirect('log');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::MtDeleting('Warning!!','Would you like to remove This?','/log/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$log = Log::findOrfail($id);
     	$log->delete();
        return URL::to('log');
    }
}
