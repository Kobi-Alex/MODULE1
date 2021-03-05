<?php

    //Return new solid text
    //
    function camelCased(string $input)
    {
        for($i = 0; $i < strlen($input); $i++){
            if( $input[$i] == '_'){
                $input[$i+1] = strtoupper($input[$i+1]);
            }
        }
        $input = str_replace('_','',$input);
        return $input;
    }

    //Return mirror formatted more bite text
    //
    function mirrorMultibyteString(string $input) 
    {
        $array = explode(' ', $input);
        foreach ($array as $key => $value) {
            $array[$key] = implode('', array_reverse(mb_str_split($value, 1)));
        }
        return implode(' ', $array);
    }

    //Return double line solid text
    //
    function doubleLineString(string $line)
    {
        $new_line = '';

        if($line[0] != $line[strlen($line)-1])
            $new_line = "The " .ucfirst($line);
        else{
            $substroke = substr($line, 1);
            $new_line = "$line$substroke";
        }
        return ucfirst($new_line);
    }