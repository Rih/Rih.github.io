<?php
  $file_name = "Services.xml";
  $root_element = "users";
  $row_element = "user";

  // Create the DOMDocument and the root node
  $dom = new DOMDocument('1.0', 'utf-8');
  $rootNode = $dom->appendChild($dom->createElement($root_element));

  // Loop the DB results
  foreach ($services as $row) {
    $rootNode->appendChild($dom->createTextNode("\n\t"));
    // Create a row node
    $rowNode = $rootNode->appendChild($dom->createElement($row_element));

    // Loop the columns
    foreach ($row as $col => $val) {

      // Create the column node and add the value in a CDATA section
      $rowNode->appendChild($dom->createElement($col))
              ->appendChild($dom->createCDATASection($val));
      $rowNode->appendChild($dom->createTextNode("\n\t\t"));
    }

  }

  // Output as string
  echo $dom->saveXML();
  $output = $dom->saveXML();

    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
    header("Content-Transfer-Encoding: binary;\n");
    header("Content-Disposition: attachment; filename=\"".urlencode(basename($file_name))."\";\n");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Description: File Transfer");
    header("Content-Length: ".strlen($output).";\n");
    ob_end_flush();
    exit;
?>
