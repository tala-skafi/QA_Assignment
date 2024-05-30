<?php

namespace utils;

class TestUtils
{
    public static function getJsonData($fileName)
    {
        $jsonString = file_get_contents('C:\Users\user\Desktop\QA_Assignment\resources\/' . $fileName . '.json');
        $data = json_decode($jsonString, true);
        return $data;
    }

    public static function storeStringToFile($value, $filePath): string
    {
        // Check if the value is empty or null
        if (empty($value)) {
            throw new \InvalidArgumentException("Value cannot be empty or null.");
        }

        // Define the file path

        // Write the value to the file
        $result = file_put_contents($filePath, $value);

        // Check if writing to file was successful
        if ($result === false) {
            throw new \RuntimeException("Failed to write value to file: $filePath");
        }

        // Provide debug information
        echo "Value stored in file: $filePath";

        return $filePath;
    }

    public static function getStringFromFile($filePath): string
    {
        $result = file_get_contents($filePath);
        if ($result === false) {
            throw new \RuntimeException("Failed to write value to file: $filePath");
        }
        return $result;
    }



}