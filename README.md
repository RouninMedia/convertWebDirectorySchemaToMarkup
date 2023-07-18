# convertWebDirectorySchemaToMarkup()
Converts a web directory schema (expressed as JSON, a JS Object or as a PHP Array) into HTML Markup.

## Javascript: `convertWebspaceSchemaToMarkup()`
```js

const convertWebspaceToMarkup = (webDirectory) => {

  let markup = '';
  let filesMarkup = '';

  const objectKeys = Object.keys(webDirectory);

  if (Object.keys(webDirectory).length >  0) {

    markup += '<ul class="webDirectory">';

    objectKeys.forEach((objectKey) => {

      if (objectKey === 'Files') {

        let files = webDirectory['Files'];

        if (files.length > 0) {

          filesMarkup += `<li class="webDirectoryFile">${files.join('</li><li class="webDirectoryFile">')}</li>`;
        }
      }

      else {

        markup += `<li class="webDirectoryFolder">`;
        markup += objectKey;
        markup +=  convertWebspaceSchemaToMarkup(webDirectory[objectKey]);
        markup += `</li>`;
      }
    });

    markup += filesMarkup;
    markup += '</ul>';
  }
  
  return markup;
}

```

_____

## PHP: `convertWebspaceSchemaToMarkup($webDirectory)`
```php

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

```
