function convertWebspaceSchemaToMarkup($webDirectory) {
  
  $markup = '';
  $filesMarkup = '';

  $arrayKeys = array_keys($webDirectory);

  if (count(array_keys($webDirectory)) >  0) {

    $markup .= '<ul class="webDirectory">';

    foreach($arrayKeys as $arrayKey) {

      if ($arrayKey === 'Files') {
      
        $files = $webDirectory['Files'];

        if (count($files) > 0) {

          $filesMarkup .= '<li class="webDirectoryFile">'. implode('</li><li class="webDirectoryFile">', $files).'</li>';
        }
      }

      else {

        $markup .= '<li class="webDirectoryFolder">';
        $markup .= $arrayKey;
        $markup .= convertWebspaceSchemaToMarkup($webDirectory[$arrayKey]);
        $markup .= '</li>';
      }
    }

    $markup .= $filesMarkup;
    $markup .= '</ul>';
  }

  return $markup;
}

$webDirectory = json_decode(webspaceSchemaJSON, TRUE);
$webDirectoryMarkup = convertWebspaceSchemaToMarkup($webDirectory);
