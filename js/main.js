let userDetailsCache = new Map();

let linkElements = document.getElementsByTagName('a');
for (key in linkElements) {
  // skip loop if the property is from prototype
  if (!linkElements.hasOwnProperty(key)) continue;

  let element = linkElements[key];
  element.onclick = function(e) {
    e.preventDefault();

    let previousAddedRow = document.getElementById('addedRow');
    if (previousAddedRow) previousAddedRow.remove();

    let tableRowElement = e.target.parentNode.parentNode;
    let userID = e.target.getAttribute('data-id');
    if (userDetailsCache.has(userID)) {
      tableRowElement.parentNode.insertBefore(userDetailsCache.get(userID), tableRowElement.nextSibling);
      return;
    }

    let error = false;

    fetch('https://jsonplaceholder.typicode.com/users/' + e.target.getAttribute('data-id'))
      .then(response => {
        if (!response.ok) {
          error = true;
        }
        return response;
      })
      .then(response => response.json())
      .then(data => {
        let addedRow = document.createElement('tr');
        addedRow.id = 'addedRow';
        let addedCell = document.createElement('td');
        addedCell.colSpan = '3';
        addedRow.appendChild(addedCell);

        tableRowElement.parentNode.insertBefore(addedRow, tableRowElement.nextSibling);

        if (error) {
          addedCell.appendChild(document.createTextNode('API call failed, try again'));
          return;
        }

        let span = document.createElement('span');
        let textnode = document.createTextNode('E-mail: ' + data.email);
        span.appendChild(textnode);
        addedCell.appendChild(span);
        addedCell.appendChild(document.createElement('br'));
        
        span = document.createElement('span');
        textnode = document.createTextNode(' Website: ' + data.website);
        span.appendChild(textnode);
        addedCell.appendChild(span);
        addedCell.appendChild(document.createElement('br'));

        span = document.createElement('span');
        textnode = document.createTextNode(' Company: ' + data.company.name);
        span.appendChild(textnode);
        addedCell.appendChild(span);
        addedCell.appendChild(document.createElement('br'));

        userDetailsCache.set(userID, addedRow);
      });
  } 
}