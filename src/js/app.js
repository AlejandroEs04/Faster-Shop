document.addEventListener('DOMContentLoaded', function() {
  updateProductList();
});

$(document).ready(function(){
  // Obtener estados
  $.ajax({
    type: "POST",
    url: "procesar-estados",
    data: { estados : "Mexico" } 
  }).done(function(data){
    $("#jmr_contacto_estado").html(data);
  });

  // Obtener municipios
  $("#jmr_contacto_estado").change(function(){
  var estado = $("#jmr_contacto_estado option:selected").val();
  $.ajax({
  type: "POST",
  url: "procesar-estados",
  data: { municipios : estado } 
  }).done(function(data){
  $("#jmr_contacto_municipio").html(data);
  });
  });
});

// Obtener referencias a los elementos HTML
const searchInput = document.getElementById('search-input')
const searchResults = document.getElementById('search-results');

// Agregar un evento de escucha al input de búsqueda
searchInput.addEventListener('input', function() {
  const searchText = searchInput.value.toLowerCase(); // Obtener el texto ingresado en minúsculas

  console.log(searchText)

  // Limpiar los resultados anteriores
  searchResults.innerHTML = '';

  // Realizar la búsqueda y mostrar los resultados en tiempo real
  const results = realizarBusqueda(searchText);
  console.log(results)
  results.forEach(function(result) {
    const li = document.createElement('li');
    li.textContent = result;
    searchResults.appendChild(li);
  });
});

// Función para realizar la búsqueda (aquí puedes agregar tu lógica personalizada)
// Función para realizar la búsqueda y obtener resultados de la base de datos
function realizarBusqueda(texto) {
    // Realizar una solicitud AJAX al servidor
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'busqueda.php?texto=' + encodeURIComponent(texto), true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Procesar la respuesta del servidor
        const results = JSON.parse(xhr.responseText);
        // Mostrar los resultados en tiempo real
        results.forEach(function(result) {
        const li = document.createElement('li');
        li.textContent = result;
        searchResults.appendChild(li);
      });
    }
  };
  xhr.send();
}

// Barra de filtros
function updateProductList() {
  // Obtener los valores seleccionados de los filtros
  var category = document.getElementById("category-filter").value;
  var price = document.getElementById("price-filter").value;
  var proveedores = document.getElementById("proveedores-filter").value;

  // Hacer una solicitud AJAX para obtener los productos filtrados
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "/?category=" + category + "&price=" + price + "&proveedores=" + proveedores, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Actualizar el contenido de la lista de productos
      document.getElementById("body").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}

function search_barra() {
  let input = document.getElementById('searchbar').value
  input=input.toLowerCase();
  let x = document.getElementsByClassName('id');
  let y = document.getElementsByClassName('no');
    
  for (i = 0; i < x.length; i++) { 
      if (!y[i].innerHTML.toLowerCase().includes(input) && !x[i].innerHTML.toLowerCase().includes(input)) {
          y[i].style.display="none";
      }else {
          y[i].style.display="";
      }
  }
}

/** Botones PAYPAL */
paypal.Buttons({
  // Order is created on the server and the order id is returned
  createOrder() {
    return fetch("/my-server/create-paypal-order", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      // use the "body" param to optionally pass additional order information
      // like product skus and quantities
      body: JSON.stringify({
        cart: [
          {
            sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
            quantity: "YOUR_PRODUCT_QUANTITY",
          },
        ],
      }),
    })
    .then((response) => response.json())
    .then((order) => order.id);
  },
  // Finalize the transaction on the server after payer approval
  onApprove(data) {
    return fetch("/my-server/capture-paypal-order", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        orderID: data.orderID
      })
    })
    .then((response) => response.json())
    .then((orderData) => {
      // Successful capture! For dev/demo purposes:
      console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
      const transaction = orderData.purchase_units[0].payments.captures[0];
      alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
      // When ready to go live, remove the alert and show a success message within this page. For example:
      // const element = document.getElementById('paypal-button-container');
      // element.innerHTML = '<h3>Thank you for your payment!</h3>';
      // Or go to another URL:  window.location.href = 'thank_you.html';
    });
  }
}).render('#paypal-button-container');