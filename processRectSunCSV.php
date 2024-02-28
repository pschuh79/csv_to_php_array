<?php

$csvFile = 'data/Book2.csv';

// read csv data into an array
$csvData = $csvFile;

/**
 * I want a function that will take the row that has the heading names and adds it to the array comment
 * 
 * example - $suncatcherRectanglePricing[0][0]  = would output 12-12-12 (height-length-depth)
 */

 function commentsFromCSVCreator($csvData): string {

    return 'a comment string';
}

// Open the CSV file for reading
if (($handle = fopen($csvFile, "r")) !== false) {
    // Initialize an empty array to hold the pricing data
    $suncatcherRectanglePricing = [];

    // Initialize counter to keep track of the number of rows processed
    $rowCount = 0;

    // Loop through each line of the CSV file
    while (($data = fgetcsv($handle, 0, ",")) !== false) {
        // Increment the row counter
        $rowCount++;

        // skip the first three rows
        if ($rowCount <= 1) {
            continue;
        }

        // remove unwanted elements
        unset($data[4], $data[10]);
        // Populate array
        $suncatcherRectanglePricing[] = $data;
    }

    // Close the CSV file
    fclose($handle);



    // specify path for php output file
    $outputFilePath = 'data/outputRect.php';

    // write the php code with the array data to the output file
    $outputFileContent = '<?php' . PHP_EOL;
    $outputFileContent .= '/*' . PHP_EOL;
    $outputFileContent .= '* Suncatcher rectangle pricing' . PHP_EOL;
    $outputFileContent .= '*/' . PHP_EOL;
    $outputFileContent .= '$suncatcherRectanglePricing = array(' . "\n";
    foreach ($suncatcherRectanglePricing as $pricing) {
        // make first element a string
        $pricing[0] = "'" . $pricing[0] . "'";
        $outputFileContent .= ' array(' . implode(', ', $pricing) . '),' . "\n";
    }
    $outputFileContent .= ');' . "\n";
    $outputFileContent .= '?>';

    // write the content to the output file
    file_put_contents($outputFilePath, $outputFileContent);

    // check for file creation

    if (file_exists($outputFilePath)) {
        echo 'File creation success' . PHP_EOL;
    } else {
        echo 'something got fucked up' . PHP_EOL;
    }
}
