function addToCart(productId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "order_items.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        order();
      }
    };
    xhr.send("addPro=" + encodeURIComponent(productId));
}
function DeleteItemCart(productId, orderID) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "order_items.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        order();
      }
    };
  

    var formData = new URLSearchParams();
    formData.append("delProductId", productId);
    formData.append("delOrderID", orderID);
    xhr.send(formData);
  }
  function IncreaseItemCart(productId, orderID) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "order_items.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        order();
      }
    };
  
    var formData = new URLSearchParams();
    formData.append("enProductId", productId);
    formData.append("enOrderID", orderID);
    xhr.send(formData);
  }
  function DecreaseItemCart(productId, orderID) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "order_items.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        order();
      }
    };
  
    var formData = new URLSearchParams();
    formData.append("deProductId", productId);
    formData.append("deOrderID", orderID);
    xhr.send(formData);
  }

  function completeOrder(orderID, total)
  {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "order_items.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        order();
      }
    };

    var formData = new URLSearchParams();
    formData.append("total", total);
    formData.append("comOrder", orderID);
    xhr.send(formData);
  }