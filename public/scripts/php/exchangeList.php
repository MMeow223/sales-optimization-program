<?php
    class dayObject {
        public $dateVal;
        public $exchangeCount = 0;
    }

    $month = $_GET["month"];
    $year = $_GET["year"];

    $outputList = [];
    $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    for ($i = 1; $i < $totalDays + 1; $i++) {
        $dayObject = new dayObject();
        $dayObject->dateVal = $i;
        $outputList[] = $dayObject;
    }

    $conn = mysqli_connect("localhost", "root", "", "sop");
    if (!$conn) {
        die ("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM exchanges WHERE MONTH(created_at)=$month AND YEAR(created_at)=$year ORDER BY created_at";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($outputList as $outputListObject) {
                $date = new DateTime($row["created_at"]);
                if ($outputListObject->dateVal == $date->format("j")) {
                    $outputListObject->exchangeCount++;
                }
            }
        }
    }

    mysqli_close($conn);

    $output = "";
    for ($i = 1; $i < $totalDays + 1; $i++) {
        if ($output != "") {
            $output .= ",";
        }

        $output .= '{"Day":' . $i . ',';
        $output .= '"Exchanges":' . $outputList[$i - 1]->exchangeCount . '}';
    }

    $output = '{"exchanges":[' . $output . ']}';
    echo $output;
?>