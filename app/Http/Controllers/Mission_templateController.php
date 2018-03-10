<?php

namespace App\Http\Controllers;

use App\Dict;
use App\Enums\DictTypes;
use App\Helper\Util;
use App\Mission;
use App\Post;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mission_template;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class Mission_templateController.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:34:32am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Mission_templateController extends Controller
{
    use Util;
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->applyFilters(Mission::query());
        $templates = $query->where('is_template',true)->paginate($this->pageNumber());
        return view('mission_template.index',compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = '创建新模板';
        $posts = Post::get();
        return view('mission_template.create',compact('title','posts','arithmetic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mission_template = new Mission();

        
        $mission_template->name = $request->name;

        
        $mission_template->post_id = $request->post_id;

        
        $mission_template->description = $request->description;

        
        $mission_template->upper = $request->upper;

        
        $mission_template->sustain = $request->sustain;

        
        $mission_template->is_template = true;

        
        
        $mission_template->save();
        $templates = Mission::where('is_template',true)->paginate($this->pageNumber());
        return redirect('mission_template');
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
        $title = 'Show - mission_template';

        if($request->ajax())
        {
            return URL::to('mission_template/'.$id);
        }

        $mission_template = Mission_template::findOrfail($id);
        return view('mission_template.show',compact('title','mission_template'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - mission_template';
        if($request->ajax())
        {
            return URL::to('mission_template/'. $id . '/edit');
        }

        $posts = Post::get();
        $template = Mission::findOrfail($id);
        return view('mission_template.edit',compact('title','template' ,'posts','arithmetic' ));
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
        $mission_template = Mission::findOrfail($id);

        $mission_template->fill($request->intersect(app(Mission::class)->getFillable()));
        
        
        $mission_template->save();

        return redirect('mission_template');
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
        $msg = Ajaxis::MtDeleting('Warning!!','Would you like to remove This?','/mission_template/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }


    public function destroy($id)
    {
     	$mission_template = Mission::findOrfail($id);
     	$mission_template->delete();
        return redirect('mission_template');
    }
}
