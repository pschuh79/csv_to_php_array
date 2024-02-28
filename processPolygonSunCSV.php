<?php
/**
 * Processes the polygon suncatcher pricing csv into a php array that can be 
 * used by the Suncatcher configurator
 */


$csvFile = 'data/Book5.csv';

// read csv data into an array
$csvData = $csvFile;

// Open the CSV file for reading
if (($handle = fopen($csvFile, "r")) !== false) {
    // Initialize an empty array to hold the pricing data
    $suncatcherPolygonPricing = [];

    // Initialize counter to keep track of the number of rows processed
    $rowCount = 0;

    // Loop through each line of the CSV file
    while (($data = fgetcsv($handle, 0, ",")) !== false) {
        // Increment the row counter
        $rowCount++;

        // skip the first three rows. Exludes the column headings in the csv. 
        if ($rowCount <= 3) {
            continue;
        }

        // remove unwanted elements (columns in the csv file)
        //unset($data[1], $data[2]);
        // Append data to array
        $suncatcherPolygonPricing[] = $data;
    }

    // Close the CSV file
    fclose($handle);



    // specify path for php output file
    $outputFilePath = 'data/outputPoly.php';

    // write the php code with the array data to the output file
    $outputFileContent = '<?php' . PHP_EOL;
    $outputFileContent .= '/*' . PHP_EOL;
    $outputFileContent .= '* Suncatcher polygon pricing' . PHP_EOL;
    $outputFileContent .= '*/' . PHP_EOL;
    $outputFileContent .= '$suncatcherPolygonPricing = array(' . "\n";
    foreach ($suncatcherPolygonPricing as $pricing) {
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
        echo 'Something happened. What did you do?' . PHP_EOL;
    }
}
