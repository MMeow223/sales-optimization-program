<?php

namespace App\Http\Controllers;

use App\Charts\BarChart;
use App\Models\Exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMonthExchangeData(){

        $some = DB::table('exchanges')
            ->select(DB::raw('count(*) as total, month(created_at) as month'))
            ->groupBy('month')
            ->get();

        $monthCount = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($some as $s){
            $monthCount[$s->month-1] = $s->total;
        }
        return array_values($monthCount);
    }

    public function getTotalExchangeToday(){
        $some = DB::table('exchanges')
            ->select(DB::raw('count(*) as total'))
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->get();
        return $some[0]->total;
    }
    public function getTotalExchangeThisMonth(){
        $some = DB::table('exchanges')
            ->select(DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', date('Y'))
            ->whereMonth('created_at', '=', date('m'))
            ->get();
        return $some[0]->total;
    }
    public function getTotalExchangeThisYear(){
        $some = DB::table('exchanges')
            ->select(DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', date('Y'))
            ->get();
        return $some[0]->total;
    }
    public function getOutletExchangeRecords(){
        $some = DB::table('exchanges')
            ->select(DB::raw('count(*) as total, outlet_id'))
            ->groupBy('outlet_id')
            ->get();
        $outletCount = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($some as $s){
            $outletCount[$s->outlet_id-1] = $s->total;
        }
        return array_values($outletCount);
    }

    public function index() {

        $data = PagesController::getMonthExchangeData();
        $data ="[". implode(',', $data) ."]";

        $totalExchangeToday = PagesController::getTotalExchangeToday();
        $totalExchangeThisMonth = PagesController::getTotalExchangeThisMonth();
        $totalExchangeThisYear = PagesController::getTotalExchangeThisYear();
        return view("home")
            ->with("data", $data)
            ->with("totalExchangeToday", $totalExchangeToday)
            ->with("totalExchangeThisMonth", $totalExchangeThisMonth)
            ->with("totalExchangeThisYear", $totalExchangeThisYear);
            ;

    }
}
