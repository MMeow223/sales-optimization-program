<?php

namespace App\Http\Controllers;

use App\Charts\BarChart;
use App\Models\Devices;
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

        $exchangeRecords = DB::table('exchange_records')
        ->where('created_at', '>=', date('Y-01-01'))
        ->select(DB::raw('count(*) as total, month(created_at) as month'))
        ->groupBy('month')
        ->get();

        $monthCount = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($exchangeRecords as $exchangeRecord){
            $monthCount[$exchangeRecord->month-1] = $exchangeRecord->total;
        }
        return array_values($monthCount);
    }

    public function getTotalExchangeRecordsToday(){

        return (DB::table('exchange_records')
            ->select(DB::raw('count(*) as total'))
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->get())[0]
            ->total;

    }

    public function getTotalExchangeRecordsThisMonth(){

        return (DB::table('exchange_records')
            ->select(DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', date('Y'))
            ->whereMonth('created_at', '=', date('m'))
            ->get())[0]
            ->total;

    }

    public function getTotalExchangeRecordsThisYear(){

        return (DB::table('exchange_records')
            ->select(DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', date('Y'))
            ->get())[0]
            ->total;

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

    public function getWeeklyExchangeData(){

        $exchangeRecords = DB::table('exchange_records')
            ->where('created_at', '>=', date('Y-m-01'))
            ->select(DB::raw('count(*) as total, week(created_at) as week'))
            ->groupBy('week')
            ->get();


        $weekCount = array(0, 0, 0, 0);
        $i = 0;
        foreach ($exchangeRecords as $exchangeRecord){
            $weekCount[$i] = $exchangeRecord->total;
            $i++;
        }
        return array_values($weekCount);
    }
    public function getYearlyExchangeData(){

        $exchangeRecords = DB::table('exchange_records')
            ->where('created_at', '>=', now()->subYears(5)->year)
            ->select(DB::raw('count(*) as total, year(created_at) as year'))
            ->groupBy('year')
            ->get();

        return $exchangeRecords;
    }

    public function getYearlyData($exchangeRecords){

        $yearCount = array();
        $i = 0;

        foreach ($exchangeRecords as $exchangeRecord){
            $yearCount[$i] = $exchangeRecord->total;
            $i++;
        }
        return array_values($yearCount);

    }

    public function getYearlyLabels($exchangeRecords){

        $yearLabels = array();
        $i = 0;

        foreach ($exchangeRecords as $exchangeRecord){
            $yearLabels[$i] = $exchangeRecord->year;
            $i++;
        }
        return array_values($yearLabels);
    }
    public function getPopularBrand(){

        // get the record from the table which is competitor brand
        $devices = Devices::where('device_brand','!=',"Ubisson")
            ->get();


        // create an empty value for each brand in the array
        $deviceTotal = array();
        foreach ($devices as $device) {
            $deviceTotal[$device->device_brand] = 0;
        }

        // assign the value(total_exchanged) to each brand
        foreach ($devices as $device) {
            $deviceTotal[$device->device_brand] += $device->total_exchanged;
        }

        arsort($deviceTotal);


        // return the keys(all competitor brand), and value(all total exchanged of each brand)
        return array(array_keys($deviceTotal),array_values($deviceTotal));
    }

    public function index() {

        $totalExchangeToday = PagesController::getTotalExchangeRecordsToday();
        $totalExchangeThisMonth = PagesController::getTotalExchangeRecordsThisMonth();
        $totalExchangeThisYear = PagesController::getTotalExchangeRecordsThisYear();


        $weeklyByMonth = PagesController::getWeeklyExchangeData();
        $weeklyByMonth ="[". implode(',', $weeklyByMonth) ."]";

        $monthlyByYear = PagesController::getMonthExchangeData();
        $monthlyByYear ="[". implode(',', $monthlyByYear) ."]";

        $yearlyOfPastFiveYear = PagesController::getYearlyExchangeData();
        $getYearlyData = PagesController::getYearlyData($yearlyOfPastFiveYear);
        $getYearlyData = "[". implode(',', $getYearlyData) ."]";
        $getYearlyLabels = PagesController::getYearlyLabels($yearlyOfPastFiveYear);
        $getYearlyLabels = "[". implode(',', $getYearlyLabels) ."]";

        $getPopularBrand = PagesController::getPopularBrand();

        return view("home")
            ->with("totalExchangeToday", $totalExchangeToday)
            ->with("totalExchangeThisMonth", $totalExchangeThisMonth)
            ->with("totalExchangeThisYear", $totalExchangeThisYear)

            ->with("weeklyByMonth", $weeklyByMonth)
            ->with("monthlyByYear", $monthlyByYear)
            ->with("yearlyOfPastFiveYear", $getYearlyData)
            ->with("yearLabels",$getYearlyLabels)

            ->with("popularBrandLabel", $getPopularBrand[0])
            ->with("popularBrandData", $getPopularBrand[1])
            ;
    }
}
