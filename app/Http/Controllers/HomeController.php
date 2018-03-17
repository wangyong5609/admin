<?php

namespace App\Http\Controllers;

use App\Helper\Util;
use App\Staff;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Util;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->applyFilters(Staff::query());
        $staffs = $query->orderBy('status')->paginate($this->pageNumber());
        return view('home',compact('staffs'));
    }
}
