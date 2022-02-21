<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Models\Exchange;
//use http\Env\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

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

    /**
     * Get the total number of exchanges recorded today
     *
     * @return mixed
     */
    public function getTotalExchangeToday()
    {

        return (DB::table('exchange_records')
            ->select(DB::raw('count(*) as total'))
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->get()
        )[0]->total;

    }

    /**
     * Get the total number of exchanges recorded this month
     *
     * @return mixed
     */
    public function getTotalExchangeThisMonth()
    {

        return (DB::table('exchange_records')
            ->select(DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', date('Y'))
            ->whereMonth('created_at', '=', date('m'))
            ->get()
        )[0]->total;

    }

    /**
     * Get the total number of exchanges recorded this year
     *
     * @return mixed
     */
    public function getTotalExchangeThisYear()
    {

        return (DB::table('exchange_records')
            ->select(DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', date('Y'))
            ->get()
        )[0]->total;

    }

    /**
     * Get the exchange data of every month in this year
     *
     * @return array
     */
    public function getMonthlyExchangeData()
    {

        $exchangeRecords = DB::table('exchange_records')
            ->where('created_at', '>=', date('Y-01-01'))
            ->select(DB::raw('count(*) as total, month(created_at) as month'))
            ->groupBy('month')
            ->get();

        $monthlyExchangeData = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($exchangeRecords as $exchangeRecord){
            $monthlyExchangeData[$exchangeRecord->month-1] = $exchangeRecord->total;
        }

        return PagesController::convertArrayToString(array_values($monthlyExchangeData));

    }


    /**
     * Get the exchange data of every week in this month
     *
     * @return array|string
     */
    public function getWeeklyExchangeData()
    {

        $exchangeRecords = DB::table('exchange_records')
            ->whereDate('created_at', '>=', date('Y-m-01'))
            ->select(DB::raw('count(*) as total, week(created_at) as week'))
            ->groupBy('week')
            ->get();

        $weeklyExchangeData = array(0, 0, 0, 0);
        $i = 0;

        foreach ($exchangeRecords as $exchangeRecord){
            $weeklyExchangeData[$i] = $exchangeRecord->total;
            $i++;
        }

//        dd(PagesController::convertArrayToString(array_values($weeklyExchangeData)));
        return PagesController::convertArrayToString(array_values($weeklyExchangeData));

    }

    /**
     * Get an array of year labels and data of past five year exchange records
     * @return array
     */
    public function getExchangeRecordsOfPastFiveYear()
    {

        $exchangeRecords = DB::table('exchange_records')
            ->where('created_at', '>=', now()->subYears(5)->year)
            ->select(DB::raw('count(*) as total, year(created_at) as year'))
            ->groupBy('year')
            ->get();

        return array(
            PagesController::getLabelsOfPastFiveYear($exchangeRecords),
            PagesController::getDataOfPastFiveYear($exchangeRecords)
        );

    }



    /**
     * Get the exchange data of past 5 years
     *
     * @param $exchangeRecords
     * @return string
     */
    public function getDataOfPastFiveYear($exchangeRecords)
    {

        $yearCount = array();
        $i = 0;

        foreach ($exchangeRecords as $exchangeRecord)
        {

            $yearCount[$i] = $exchangeRecord->total;
            $i++;

        }

        return PagesController::convertArrayToString(array_values($yearCount));

    }

    /**
     * Get the label of available past 5 years
     *
     * @param $exchangeRecords
     * @return string
     */
    public function getLabelsOfPastFiveYear($exchangeRecords)
    {

        $yearLabels = array();
        $i = 0;

        foreach ($exchangeRecords as $exchangeRecord)
        {

            $yearLabels[$i] = $exchangeRecord->year;
            $i++;

        }

        return PagesController::convertArrayToString(array_values($yearLabels));

    }

    public function getPopularBrand()
    {

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

    /**
     * Convert array to string
     * E.g: "[1,2,3,4]"
     *
     * @param $array
     * @return string
     */
    public function convertArrayToString($array)
    {
        return "[". implode(',', $array) ."]";
    }

    public function index() {

        // text box visualization
        $totalExchangeToday = PagesController::getTotalExchangeToday();
        $totalExchangeThisMonth = PagesController::getTotalExchangeThisMonth();
        $totalExchangeThisYear = PagesController::getTotalExchangeThisYear();

        // bar chart visualization
        $weeklyByMonth = PagesController::getWeeklyExchangeData();
        $monthlyByYear = PagesController::getMonthlyExchangeData();
        $exchangeRecordsOfPastFiveYear = PagesController::getExchangeRecordsOfPastFiveYear();

        // pie chart visualization
        $getPopularBrand = PagesController::getPopularBrand();

        return view("home")
            // text box visualization
            ->with("totalExchangeToday", $totalExchangeToday)
            ->with("totalExchangeThisMonth", $totalExchangeThisMonth)
            ->with("totalExchangeThisYear", $totalExchangeThisYear)

            // bar chart visualization
            ->with("exchangesInEachWeekOfThisMonth", $weeklyByMonth)
            ->with("exchangesInEachMonthOfThisYear", $monthlyByYear)
            ->with("exchangesInEachYearOfPastFiveYear",$exchangeRecordsOfPastFiveYear) // contain both label and data in form of array

            // pie chart visualization
            ->with("brandRanking", $getPopularBrand) // contain both label and data in form of array
            ;
    }
}
