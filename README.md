# Read-iPhone-health-export-data-by-PHP


1) How to Get the Raw Export of Your Apple Health Data

Unlike Google Fit, iPhone's Health data is not automatically synced to the cloud or available on an Apple website. And you cannot view your Apple health data on a website or pull the data from an API.

In fact, Apple doesn’t have access to this data unless you provide it directly to them in an export. This means that if you lose or break your phone, then you’ll also lose your health data. So, if your data is important, then you should invest in regular backup of your full data to iCloud or at least regularly export your health data export.

In order to get the raw export, go into the “Apple Health” app, tap on your user icon and then select “Export Health Data.”

This export process may take a few minutes, and, once completed, you should then have a filed called “export.zip”. You can share the file with yourself via AirDrop, Email or any other method.

2) XML Format of Your Apple Health Data

Once you unzip the raw export from Apple Health, you’ll notice a few things.
First, you’ll discover two files: export.xml and export_cda.xml.

In looking at export.xml file, you might be surprised how big they are. Your iPhone is collecting and tracking a lot of information. For example, in my case, the zipped export was 9 MB, and unzipped the files were well over 200 MB. The amount of data here creates some challenges in processing and using it, but it also means there is a lot of data to be used too.

As a side note, this Apple Health data is actually not the raw sensor data. Your watch or phone is interpreting sensor data and then aggregating it into the stored results.

3) Read Apple Health XML with PHP

<?php

$xml=simplexml_load_file("export.xml") or die("Error: Cannot create object");

foreach ($xml->children() as $i) {
  if($i->getName() == "Record")
  {
    echo "<br/>";
    switch ($i['type']) {
      case "HKQuantityTypeIdentifierBodyMass":
        echo "Weight=" .$i['value'] . ' ' . $i['unit'] . " Date=" . substr($i['creationDate'],0,19);
        break;
      case "HKQuantityTypeIdentifierHeartRate":
        echo "HeartRate=" .$i['value'] . ' ' . $i['unit'] . " Date=" . substr($i['creationDate'],0,19);
        break;
      case "HKQuantityTypeIdentifierStepCount":
        echo "StepCount=" .$i['value'] . ' ' . $i['unit'] . " Date=" . substr($i['creationDate'],0,19);
        break;
      case "HKQuantityTypeIdentifierDistanceWalkingRunning":
        echo "WalkingRunning=" .$i['value'] . ' ' . $i['unit'] . " Date=" . substr($i['creationDate'],0,19);
        break;
      case "HKQuantityTypeIdentifierBasalEnergyBurned":
        echo "EnergyBurned=" .$i['value'] . ' ' . $i['unit'] . " Date=" . substr($i['creationDate'],0,19);
        break;
    }
  }
}

?>


This process may take several minutes to run depending on the size of your Apple Health.

Two important things to note about this data. 
First, the timestamps are in UTC time and haven’t been adjusted to a local timezone. 
Second, if you both wear an apple watch and carry your phone, then you’ll have some overlapping or duplicate data.
