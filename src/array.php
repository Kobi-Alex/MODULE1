<?php

    /**
     * @param $input
     * @return array
     */
    function repeatArrayValues(array $input)
    {
        $new_arr = array();
        foreach($input as $value){
            if(abs($value) <= 1) array_push($new_arr, $value);
            else{
                for ($i = 0; $i < abs($value); $i++)
                    array_push($new_arr, $value); 
            }
        }
        return  $new_arr;
    }

    /**
     * @param $input
     * @return $uniqueItem
     */
    function getUniqueValue(array $input)
    {
        if ($input != null){
            $minValue = min(array_count_values($input));
            foreach(array_count_values($input) as $index => $value){
                if($value == $minValue && $value == 1){
                    return $index;
                }
            }
        }
        return 0;
    }

    /**
     * @param $input
     * @return array
     */
    function groupByTag(array $input)
    {
        $result = array();
        foreach ($input as $value)
        {
            foreach ($value['tags'] as $item)
            {
                if(array_key_exists($item, $result))
                {
                    $result[$item][]=$value['name'];
                    sort($result[$item], SORT_NATURAL | SORT_FLAG_CASE);
                }else
                    $result[$item] = [$value['name']];
            }
        }
        ksort($result, SORT_NATURAL | SORT_FLAG_CASE);
        return $result;
    }