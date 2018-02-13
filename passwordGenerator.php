<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 13.02.2018
 * Time: 12:54
 */


/*
 * •	input variable length
•	use 3 random groups from 4 total: [a-z][A-Z][0-9][!@#$%^&]
e.g. “Wa51Sbas” or “be$qR#ZP” or “%XS^2Q3!”
•	in random order
•	as more secure as you can
•	estimate complexity of the algorithm (in comments)
•	write unit tests


 */

class passwordGenerator
{
    public function getGroupChar($chars)
    {
        return ($chars[rand(0, strlen($chars)-1)]);
    }

    public function generatorPassword($length)
    {

        $newPassword = '';
        if (is_int($length) && $length > 2)
        {
            $withoutGroup = rand(1,4);
            $groupUsed = [false, false, false];
            $randomChars = [];
            if ($withoutGroup != 1)
            {
                $randomChars[] = 'abcdefghijklmnopqrstuvwxyz';
            }
            if ($withoutGroup != 2)
            {
                $randomChars[] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }
            if ($withoutGroup != 3)
            {
                $randomChars[] = '0123456789';
            }
            if ($withoutGroup != 4)
            {
                $randomChars[] = '!@#$%^&';
            }

            $randomValues = [
                strlen($randomChars[0]),
                strlen($randomChars[0]) + strlen($randomChars[1]),
                strlen($randomChars[0]) + strlen($randomChars[1]) + strlen($randomChars[2]),
            ];
            $randomValues[$withoutGroup] = 0;

            $randomMax = strlen($randomChars[0]) + strlen($randomChars[1]) + strlen($randomChars[2]);

            $charGroupsToUse = 3;
            for ($i = $length; $i > 0; $i--)
            {
                $random = rand(1,$randomMax);

                if (($charGroupsToUse == $i && !$groupUsed[0]) || ($random <= $randomValues[0] && $charGroupsToUse < $i))
                {
                    $groupNumber = 0;
                }
                elseif (($charGroupsToUse == $i && !$groupUsed[1]) || ($random <= $randomValues[0] && $charGroupsToUse < $i))
                {
                    $groupNumber = 1;
                }
                else
                {
                    $groupNumber = 2;
                }

                $newPassword .= $this->getGroupChar($randomChars[$groupNumber]);
                if (!$groupUsed[$groupNumber])
                {
                    $charGroupsToUse--;
                }
                $groupUsed[$groupNumber] = true;
            }
            return $newPassword;
        } else {
            return false;
        }
    }
}