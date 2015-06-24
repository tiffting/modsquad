<?php
  $modResponses = "data/modResponses.js";
  $jsonData = $_POST['data'];

  if (is_writable($modResponses)) {
    if (!$handle = fopen($modResponses, 'a')) {
      echo 'Cannot open file ($modResponses).';
      exit;
    }
    if (isset($_POST['data'])) {
      if (fwrite($handle, $jsonData) === FALSE) {
        echo 'Cannot write to file ($modResponses).';
        exit;
      }
      else {
        fwrite($handle, ",\n");
      }
    }
    echo 'Success! Wrote ($jsonData) to file ($modResponses).';
    fclose($handle);
  }
  else {
    echo 'The file $modResponses is not writable.';
  }

?>