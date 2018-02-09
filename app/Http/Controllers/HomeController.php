<?php

namespace App\Http\Controllers;

use App\Dict;
use App\Helper\Util;
use App\Mission;
use App\Staff;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Util;

    public function home()
    {
        $query = $this->applyFilters(Mission::query()->with('staff'));
        $missions = $query->where('status',Dict::where('code','doing')->first()->id)
            ->whereNotNull('staff_id')
            ->where('show',true)
            ->paginate($this->pageNumber());

        return view('home',compact('missions'));
    }
}
