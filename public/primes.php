.
<?php

function isPrime(int $number)
{
    if ($number <= 1) {
        return false;
    }

    for ($i = 2; $i < $number; ++$i) {
        if ($number % $i === 0) {
            return false;
        }
    }

    return true;
}

function getPrimes(int $lowerLimit, int $upperLimit): array
{
    $primes = [];

    for ($i = $lowerLimit; $i <= $upperLimit; ++$i) {
        if (isPrime($i) === true) {
            $primes[] = $i;
        }
    }

    return $primes;
}

print_r(getPrimes(1, 100));