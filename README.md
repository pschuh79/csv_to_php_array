# CSV to PHP Array Converter

### Version 0.0.1

Basically three separate files for converting a csv file into a php array. 

It's pretty ugly right now but it will be used as a project to learn from.

If starting with an Excel worksheet, that worksheet will need to be converted to a csv document. To do this, right click on the tab to convert and select the 'Move or Copy' option. Then select create a copy to new workbook.

Save the document as a csv file.

Once the csv is saved, copy/move file into the `/data` directory


In the `process<*>CSV.php` file, assign the file path as the value for the `$csvFile` variable. This should match the file placed in the `/data` directory.

Three console commands to run depending on the file uploaded:

- `php processPolygonSunCSV.php`
- `php processRectSunCSV.php`
- `php processHybridCSV.php`

After running the command, a file named `output<*>.php` will be generated. 

These files will have one of the following names:
- `outputRect`
- `outputSun`
- `outputHybrid`

These files are meant to be throwaways, any subsequent repeated commands will overwrite the previous output.

Upon successful execution, the script prints a "File creation success" message to the console.

If an error occurs, a generic error message will be displayed. Ensure that your CSV file is correctly formatted and located in the `/data` directory for troubleshooting.