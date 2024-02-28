<?php

/**
 * Process data from a csv file into an array usable by php
 * 
 * TODO - make more dynamic - can probably improve how comments and variables are outputted. Also find a way to make it easier to select the rows/columns that I want to extract data from.
 */

$csvFilePath = 'data/custom-cages-hybrid-pricing-2019.csv';

// read csv data into an array
$csvData = array_map('str_getcsv', file($csvFilePath));

// extract header row as keys
$header = array_shift($csvData);

// create an associative array from the csv data
$h3dataArray = [];
$h2dataArray  = [];
foreach ($csvData as $row) {
    // Ensure that there is at least two elements in the row
    if (count($row) >= 2) {
        $h3key = $row[0]; // use the first column as the key
        $h3value = (float)filter_var($row[5], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $h3dataArray[$h3key] = $h3value;

        $h2key = $row[0]; // use the first column as the key
        $h2value = (float)filter_var($row[15], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $h2dataArray[$h2key] = $h2value;
    }
}


// specify path for php output file
$outputFilePath = 'data/output.php';

// write the php code with the array data to the output file
$outputFileContent = '<?php' . PHP_EOL;
$outputFileContent .= '/*' . PHP_EOL;
$outputFileContent .= '* H3 Hood/Stand Pricing' . PHP_EOL;
$outputFileContent .= '*/' . PHP_EOL;
$outputFileContent .= '$h3HoodStandCost = ' . preg_replace('/[\n\r\s+]/', '', var_export($h3dataArray, true)) . ';' . PHP_EOL;
$outputFileContent .= '/*' . PHP_EOL;
$outputFileContent .= '* H2 Hood/Stand Pricing' . PHP_EOL;
$outputFileContent .= '*/' . PHP_EOL;
$outputFileContent .= '$h2HoodStandCost = ' . preg_replace('/[\n\r\s+]/', '', var_export($h2dataArray, true)) . ';' . PHP_EOL;
$outputFileContent .= '?>';

// write the content to the output file
file_put_contents($outputFilePath, $outputFileContent);

// check for file creation

if (file_exists($outputFilePath)) {
    echo 'File creation success';
} else {
    echo 'something got fucked up';
}
