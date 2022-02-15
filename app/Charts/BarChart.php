<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Exchange;

class BarChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $exchanges = Exchange::orderBy('created_at', 'asc')->get();
        $monthCount = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        // create a dictionary of months and their count
        foreach ($exchanges as $exchange) {
            $month = intval($exchange->created_at->format('m'));

            if(array_key_exists($month-1, $monthCount)){
                $monthCount[$month-1] ++;
            } else {
                $monthCount[$month-1] = 1;
            }
        }

        // return an array


        return [1,1,1,1,1,1,1,1,1,1,1,1];
//        return Chartisan::build()
//            // gets the created date from the database as label
//            ->labels([1,2,3,4,5,6,7,8,9,10,11,12])
////            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
//            ->dataset('Data', array_values($monthCount))
//            ;

    }
}
