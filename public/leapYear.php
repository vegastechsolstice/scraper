<?php

function isLeapYear(int $year): bool
{
    if ($year % 4 !== 0) {  //Leap years must be every 4th year
        return false;
    } elseif ($year % 100 !== 0) {
        return true;
    } elseif ($year % 400 !== 0) {  //2000 was a special year
        return false;
    }

    return true;
}

function getFirstNonLeapYear(array $years): ?int
{
    foreach ($years as $year) {
        if (isLeapYear($year) === false) {
            return $year;
        }
    }

    return null;
}

echo getFirstNonLeapYear([1896, 1900, 1904]) ?? 'All provided years are leap years';
echo getFirstNonLeapYear([1996, 2000, 2004]) ?? 'All provided years are leap years';
