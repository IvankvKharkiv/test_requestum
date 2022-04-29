<?php

declare(strict_types=1);

/**
 * @param $input
 *
 * @return mixed
 *
 * @todo implement function
 */
function merge($input)
{
    if (!$input) {
        return $input;
    }

    $arrTimestamps = array_map('toTimestamp', $input);

    foreach ($arrTimestamps as $item) {
        $arrKeyVal[$item[0]] = $item[1];
    }

    // if order did not matter we would not need this
    $arrBeforeSort = $arrKeyVal;

    ksort($arrKeyVal);

    foreach ($arrKeyVal as $key => $value) {
        $arrArray[] = [$key, $value];
    }

    for ($i = 0; $i < (count($arrArray) - 1); $i++) {
        //Look into this if statement and read comments at the end of this file
        if ($arrArray[$i + 1][0] <= $arrArray[$i][1] && $arrArray[$i + 1][1] <= $arrArray[$i][1]) {
            unset($arrArray[$i + 1]);
            $arrArray = array_values($arrArray);
            $i--;
            continue;
        }
        if ($arrArray[$i + 1][0] <= $arrArray[$i][1]) {
            $arrArray[$i] = [$arrArray[$i][0], $arrArray[$i + 1][1]];
            unset($arrArray[$i + 1]);
            $arrArray = array_values($arrArray);
            $i--;
        }
    }

    // if order did not matter we would not need this
    foreach ($arrArray as $item) {
        $keys[] = $item[0];
        $arrBeforeSort[$item[0]] = $item[1];
    }

    // if order did not matter we would not need this
    foreach ($arrBeforeSort as $key => $value) {
        if (in_array($key, $keys)) {
            $result[] = [$key, $value];
        }
    }

    return array_map('toDate', $result);
}

function toTimestamp($arr)
{
    $date1 = new \DateTime($arr[0]);
    $date2 = new \DateTime($arr[1]);

    return [$date1->getTimestamp(), $date2->getTimestamp()];
}

function toDate($arr)
{
    return [date('Y-m-d H:i:s', $arr[0]), date('Y-m-d H:i:s', $arr[1])];
}


/*
Without if statement on line 35 tests which you provided will succeed and the array below will fail.
Add array below to your test cases.
$testArr = [
    ['2021-03-24 12:00:00', '2021-03-24 15:00:00'],
    ['2021-03-23 12:00:00', '2021-03-23 15:00:00'],
    ['2021-03-23 13:00:00', '2021-03-23 14:00:00'],
    ['2021-03-23 12:00:00', '2021-03-23 16:00:00'],
];*/

