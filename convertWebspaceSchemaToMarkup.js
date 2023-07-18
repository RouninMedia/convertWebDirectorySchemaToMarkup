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
