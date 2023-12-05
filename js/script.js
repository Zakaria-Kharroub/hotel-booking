document.querySelectorAll('.status-text').forEach(function(statusElement) {
    var status = statusElement.textContent.trim();
  
    if (status === 'Available') {
      statusElement.style.backgroundColor = 'green';
    } else if (status === 'Occupied') {
      statusElement.style.backgroundColor = 'yellow';
    } else if (status === 'Under Maintenance') {
      statusElement.style.backgroundColor = 'red';
    }
  });