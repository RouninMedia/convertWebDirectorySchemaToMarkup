# markupWebspace()
Takes a JSON model of a web directory and converts it first into a JS Object or PHP Array and then into HTML Markup. 

## CSS

```css
.webDirectory {
  margin-bottom: 18px;
  padding-left: 30px;
  white-space: nowrap;
}

.webDirectoryFolder {
  margin-top: 12px;
  font-weight: 900;
  list-style-type: \'\01F4C1\000020\';
}

.webDirectoryFile {
  font-weight: 400;
  list-style-type: \'\01F4C4\000020\';
}

.webDirectoryFolder::marker {
  font-size: 1.4em;
}

@media only screen and (max-width: 800px) {

  .webDirectory {
    padding-left: 20px;
  }
}
```

______


## Javascript: `markupWebspace()`
```js

const convertWebspaceSchemaToMarkup = (webDirectory) => {

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

let webDirectory = JSON.parse(webspaceSchemaJSON);
let webDirectoryMarkup = convertWebspaceSchemaToMarkup(webDirectory);

```

_____


## PHP: `markupWebspace($webDirectory)`
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

$webDirectory = json_decode(webspaceSchemaJSON, TRUE);
$webDirectoryMarkup = convertWebspaceSchemaToMarkup($webDirectory);

```
