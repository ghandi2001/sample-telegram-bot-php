<?php

/**
 * function to check string starting (with given substring)
 */
function startsWith(string $startString, string $string): bool
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

/**
 * function to download file
 * @return bool
 */
function download_file($url, $path, $chunk_size): bool
{
    // disabled time limit
    set_time_limit(0);
    try {
        // open file for read
        $file_handle = fopen($url, 'rb');
        if (!!$file_handle) {
            // open file for write
            $output_handle = fopen($path, 'wb');
            while (!feof($file_handle)) {
                // read a chunk from file
                $chunk = fread($file_handle, $chunk_size);
                // write a readed chunk in outlet file
                fwrite($output_handle, $chunk);
            }

            // close files
            fclose($output_handle);
            fclose($file_handle);
            return true;
        }
    } catch (Exception $e) { }
    return false;
}