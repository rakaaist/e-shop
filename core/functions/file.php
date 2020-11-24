<?php

$array = [1, 2, 3, 4, 5, 6, 7];

/**
 * Function transforms array to string(json_encode)
 * and saves it to file ($file_name);
 * If file is saved, returns true, otherwise false;
 * $save_file === 0 means an empty file was saved
 *
 * @param array $array
 * @param $file_name
 * @return bool
 */
function array_to_file (array $array, string $file_name): bool {
    $string = json_encode($array);

    $save_file = file_put_contents($file_name, $string);

    if ($save_file === FALSE) {
        return false;
    }

    return true;
}

/**
 * Function checks whether the file exists;
 * if yes, decodes the string back to array;
 * if equals 0, means the file is empty and return an empty array;
 * if no, returns false;
 *
 * @param string $file_name
 * @return array|bool|mixed
 */
function file_to_array(string $file_name) {
    if (file_exists($file_name)) {
        $data = file_get_contents($file_name);

        if ($data !== false) {
            return json_decode($data, true) ?? [];
        }
        return [];

    }

    return false;
}
