<?php

$exampleList = [
    [83, 12, 50, 93, 99],
    [79, 14, 15, 70, 1],
    [32, 68, 6, 59, 87],
    [54, 50, 86, 82, 62],
    [9, 19, 57, 88, 99],
];

$pointsList = [];
foreach ($exampleList as $indexRow => $row) {
    foreach ($row as $indexPoint => $quantityDelivery) {
        //add one to the index, by the condition of the task numbering does not start with zero, but with one.
        $pointKey = $indexRow + 1 . ("," . ($indexPoint + 1));
        $pointsList[$pointKey] = [
            'row' => $indexRow + 1,
            'column' => $indexPoint + 1,
            'quantityDelivery' => $quantityDelivery
        ];
    }
}

$pointsDistanceList = [];
foreach ($pointsList as $currentPointKey => $currentPointData) {
    $pointsDistanceList[$currentPointKey] = [];
    foreach ($pointsList as $pointKey => $pointData) {
        if ($pointKey === $currentPointKey) {
            continue;
        }
        $distanceBetweenPoints = abs($currentPointData['row'] - $pointData['row']) +
            abs($currentPointData['column'] - $pointData['column']);

        $pointsDistanceList[$currentPointKey][$pointKey] = $distanceBetweenPoints * $pointData['quantityDelivery'];
    }
    $pointsDistanceList[$currentPointKey] = array_sum($pointsDistanceList[$currentPointKey]);
}

printf('The best position for the warehouse is %s', array_keys($pointsDistanceList, min($pointsDistanceList))[0]);
