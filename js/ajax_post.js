function deleteProduct(productId) {

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'product_list.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // handle the response from the server
    }
  };
  xhr.send('delete_pro=' + encodeURIComponent(productId));
  start(lastBtnclicked, "");
}
function deactivateProduct(productId) {

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'product_list.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // handle the response from the server
    }
  };
  xhr.send('de-activate=' + encodeURIComponent(productId));
  start(lastBtnclicked, "");
}
function Activate(productId) {

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'product_list.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // handle the response from the server
    }
  };
  xhr.send('activate=' + encodeURIComponent(productId));
  start(lastBtnclicked, "");
}
function deleteCategory(CategoryId) {

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'categories_list.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // handle the response from the server
    }
  };
  xhr.send('delete_ca=' + encodeURIComponent(CategoryId));
  start(lastBtnclicked, "");
}
function deleteCustomer(CustomerId) {

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'customer_list.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // handle the response from the server
    }
  };
  xhr.send('delete_cus=' + encodeURIComponent(CustomerId));
  start(lastBtnclicked, "");
}
