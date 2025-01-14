<?php

# Copyright 2020, Ludwig V. <https://github.com/ludwig-v>

# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.

# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License at <http://www.gnu.org/licenses/> for
# more details.

# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.

$dictionary = array(213,180,229,144,169,65,109,35,94,241,76,246,245,191,92,164,83,244,14,46,133,228,251,80,221,130,34,95,220,98,9,190,153,235,51,78,79,223,211,222,218,158,128,254,114,234,236,140,129,66,101,186,122,139,138,136,175,195,159,100,240,72,53,226,97,42,178,160,6,75,58,103,99,117,61,45,238,137,18,230,31,88,203,37,232,23,82,253,193,219,212,132,118,111,24,93,196,205,231,207,252,7,225,243,41,123,60,91,107,170,11,77,163,184,165,49,112,38,161,198,15,172,200,188,208,249,242,189,141,121,151,142,8,233,73,146,181,74,36,239,110,135,28,171,182,87,0,96,192,134,12,90,185,86,162,84,20,59,10,56,120,62,26,206,255,55,3,187,250,148,247,68,113,52,179,104,173,155,156,27,145,1,174,5,224,209,152,143,2,48,150,124,215,201,147,217,126,70,194,47,106,237,13,39,44,81,210,22,71,32,167,4,57,21,33,214,154,176,127,116,199,50,43,227,204,25,16,157,63,248,125,105,168,197,40,54,30,64,177,166,69,202,17,149,216,67,102,115,183,29,85,108,131,119,89,19);

if (isset($argv) AND isset($argv[1])) {
    if (strpos($argv[1], '.img') !== false AND is_file($argv[1])) {
        $pointer = fopen($argv[1], 'rb');
        $pointer_ = fopen(str_replace('.img', '', $argv[1]).'.tar.gz', 'wb');

        while (!feof($pointer)) {
            $data = fread($pointer, (1024 * 512));

            for ($i = 0; $i < strlen($data); $i++) {
                $data[$i] = chr($dictionary[ord($data[$i])]);
            }

            fwrite($pointer_, $data);
        }

        fclose($pointer);
        fclose($pointer_);
        
        echo str_replace('.img', '', $argv[1]).'.tar.gz'.": READY\r\n";
    } else {
        echo "File ".$argv[1]." does not exist !\r\n";
    }
} else {
    echo "Usage: php U2W_Decrypt.php filename.img\r\n";
}

?>