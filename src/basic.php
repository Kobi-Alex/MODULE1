<?php
  
  
  // Return quarter of hour or 'InvalidArgumentException'
  //
  function getMinuteQuarter($minute)
  {
      if ($minute > 60 || $minute < 0) 
            throw new InvalidArgumentException('InvalidArgumentException');
      else {
            if ($minute > 0 && $minute <= 15)        return 'first';
            else if ($minute > 15 && $minute <= 30)  return 'second';
            else if ($minute > 30 && $minute <= 45)  return 'third';
            else                                     return "fourth";
        }
    }

  // Checking leap year and return true or false or 'InvalidArgumentException'
  //
  function checkLeapYear($year)
  {
      if ($year < 1900 || !is_numeric($year)) 
          throw new InvalidArgumentException('InvalidArgumentException');
      else {
          if($year % 4 != 0 || $year % 400 != 0 && $year % 100 == 0) return false;
          else return true;
        }
    }

  //Checking number and return true or false or 'InvalidArgumentException'
  function checkNumber($number)
  {
      if (strlen($number) != 6) 
          throw new InvalidArgumentException('InvalidArgumentException');
      else {
          $result = 0;
          for($i = 0; $i < 6; $i++, $number /= 10){
              if ($i < 3) $result -= $number % 10;
              else $result += $number % 10;
            }
  
          if ($result == 0) return true;
          else              return false;
        }
    }
?>