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