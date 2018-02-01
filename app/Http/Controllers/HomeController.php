<?php

namespace App\Http\Controllers;

use App\Helper\Util;
use App\Staff;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Util;

    public function home()
    {
        $query = $this->applyFilters(Staff::query());
        $staffs = $query->orderBy('status')->paginate($this->pageNumber());
        return view('home',compact('staffs'));
    }
}
