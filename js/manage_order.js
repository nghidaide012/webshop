function deleteOrder(orderID) {

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'order_manager.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        // handle the response from the server
        start(lastBtnclicked, "");
      }
    };
    xhr.send('delete_order=' + encodeURIComponent(orderID));
  
  }
  function comOrder(orderID) {
  
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'order_manager.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        // handle the response from the server
        start(lastBtnclicked, "");
      }
    };
    xhr.send('comOrder=' + encodeURIComponent(orderID));
  }