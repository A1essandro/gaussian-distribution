<?php

namespace Random;

use SplFixedArray;

/**
 * Class GaussDistribution
 * Marsaglia polar method is a modification of the Box–Muller method algorithm
 *
 * @see     https://en.wikipedia.org/wiki/Normal_distribution
 * @package Random
 */
class GaussDistribution
{

    private $calculatedValue = null;
    private $expectedValue;
    private $standardDeviation;

    function __construct($expectedValue, $standardDeviation)
    {
        $this->expectedValue = $expectedValue;
        $this->standardDeviation = $standardDeviation;
    }

    function getRandom()
    {
        if ($this->calculatedValue !== null) {
            $res = $this->calculatedValue;
            $this->calculatedValue = null;

            return $res;
        }

        $pre = $this->getRandomPair();
        $this->calculatedValue = $pre[0];

        return $pre[1];
    }

    public function getRandomPair()
    {
        do {
            $u = $this->getRandomFloat();
            $v = $this->getRandomFloat();
            $s = pow($u, 2) * pow($v, 2);
        } while ($s == 0);

        $r = sqrt(-2 * log($s) / $s);

        $result = new SplFixedArray(2);
        $result[0] = $r * $u * $this->standardDeviation + $this->expectedValue;
        $result[1] = $r * $v * $this->standardDeviation + $this->expectedValue;

        return $result;
    }

    public function clear()
    {
        $this->calculatedValue = null;
    }

    private function getRandomFloat()
    {
        return 2 * mt_rand() / mt_getrandmax() - 1;
    }

}