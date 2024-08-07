//cursor


document.addEventListener("DOMContentLoaded", function() {
  const textElement = document.getElementById("typed-text");
  const textToType = "Toc toc hemos llegado!!";
  const typingSpeed = 100; // Velocidad de escritura en milisegundos
  const erasingSpeed = 50; // Velocidad de borrado en milisegundos
  const delayBetweenTypingAndErasing = 2000; // Retraso antes de empezar a borrar
  const delayBetweenErasingAndTyping = 500; // Retraso antes de empezar a escribir de nuevo

  let charIndex = 0;
  let isErasing = false;

  // Establece el ancho del contenedor para el texto completo
  textElement.style.width = textToType.length + "ch";

  function type() {
    if (!isErasing && charIndex < textToType.length) {
      textElement.textContent += textToType.charAt(charIndex);
      charIndex++;
      setTimeout(type, typingSpeed);
    } else if (isErasing && charIndex > 0) {
      textElement.textContent = textToType.substring(0, charIndex - 1);
      charIndex--;
      setTimeout(type, erasingSpeed);
    } else if (!isErasing && charIndex === textToType.length) {
      setTimeout(() => {
        isErasing = true;
        type();
      }, delayBetweenTypingAndErasing);
    } else if (isErasing && charIndex === 0) {
      isErasing = false;
      setTimeout(type, delayBetweenErasingAndTyping);
    }
  }

  type();
});


//Pantalla emergente 



function abrirModal() {
var modal = document.getElementById('modal');
modal.style.display = 'block';
}

function cerrarModal() {
var modal = document.getElementById('modal');
modal.style.display = 'none';
}
//

//Limitar a cantidad de numero ingersados
function validarCantidad(input) {
if (input.value.length > 2) {
  input.value = input.value.slice(0, 2); // Acorta el valor a máximo 2 dígitos
}
}

//Codio de ventana emergente
function mostrarVentana(ventanaId) {
var ventana = document.getElementById('ventana' + ventanaId);
ventana.style.display = 'block';
}

function cerrarVentana(ventanaId) {
var ventana = document.getElementById('ventana' + ventanaId);
ventana.style.display = 'none';
const formulario = ventana.querySelector('form');
formulario.reset(); // Esto limpiará los campos del formulario
}


//Confirmar pedido y regresar la opcion y cantidad seleccionada


//Codigo de multiplicacion tortillas
var resultadoTortilla = 0;
function validarCantidadTortilla(input) {
const cantidadTortilla = input.value;
resultadoTortilla = parseFloat(cantidadTortilla, 10) * 20;

// Mostrar el resultado en el elemento con id "resultadoTortilla"
document.getElementById("resultadoTortilla").innerText = `Precio Total:$${resultadoTortilla.toFixed(2)}`;
}

function confirmarPedidoTortillas() {
const tortillaOption = document.querySelector('input[name="tortillaoption"]:checked');
const cantidadTortillas = parseFloat(document.getElementById("cantidadTortilla").value, 10);

if (!tortillaOption) {
  showCustomAlert("Debes seleccionar un tipo de tortilla.");
  return;
}

if (isNaN(cantidadTortillas) || cantidadTortillas % 0.5 !== 0 || cantidadTortillas > 100) {
  showCustomAlert("Debes ingresar una cantidad de un kilo o medio kilo.");
  return;
}

const tipoTortilla = tortillaOption.labels[0].textContent;


const seleccion = `Su pedido es: ${tipoTortilla}, Cantidad: ${cantidadTortillas} kilos, Precio total: $${resultadoTortilla}.00`;

const confirmacion = confirm(seleccion + "\n\n¿Confirmar el pedido de tortillas?");

if (confirmacion) {
  agregarAlCarrito({
    item: tipoTortilla,
    cantidad: cantidadTortillas,
    precio: resultadoTortilla.toFixed(2)
  });
  showCustomAlert("¡Pedido de tortillas confirmado correctamente!");


  document.querySelector('input[name="tortillaoption"]:checked').checked = false;
  document.getElementById("cantidadTortilla").value = "";
  document.getElementById("resultadoTortilla").innerText = "";

  // Cerrar la ventana modal si se desea
  cerrarVentana(1);
} else {
  showCustomAlert("Vuelve a intentarlo correctamente.");
}
}



//Multiplicacion de masa
var resultadoMasa = 0;
function validarCantidadMasa(input) {
const cantidadMasa = input.value;
resultadoMasa = parseFloat(cantidadMasa, 10) * 20;

// Mostrar el resultado en el elemento con id "resultadoTortilla"
document.getElementById("resultadoMasa").innerText = `Precio total:$${resultadoMasa.toFixed(2)}`;
}

//Confrimar pedido Masa
function confirmarPedidoMasa() {
const masaOption = document.querySelector('input[name="masaoption"]:checked');
const cantidadMasa = parseFloat(document.getElementById("cantidadMasa").value, 10);

if (!masaOption) {
  showCustomAlert("Debes seleccionar un tipo de masa.");
  return;
}

if (isNaN(cantidadMasa) || cantidadMasa % 0.5 !== 0 || cantidadMasa > 100) {
  showCustomAlert("Debes ingresar una cantidad de un kilo o medio kilo.");
  return;
}

const tipoMasa = masaOption.labels[0].textContent;

const seleccion = `Su pedido es: ${tipoMasa}, Cantidad: ${cantidadMasa} kilos, Precio total: $${resultadoMasa}.00`;

const confirmacion = confirm(seleccion + "\n\n¿Confirmar el pedido de Masa?");

if (confirmacion) {
  agregarAlCarrito({
    item: tipoMasa,
    cantidad: cantidadMasa,
    precio: resultadoMasa.toFixed(2)
  });
  showCustomAlert("¡Pedido de masa confirmado correctamente!");

  // Limpiar los campos del formulario
  document.querySelector('input[name="masaoption"]:checked').checked = false;
  document.getElementById("cantidadMasa").value = "";
  document.getElementById("resultadoMasa").innerText = "";

  // Cerrar la ventana modal si se desea
  cerrarVentana(3);
} else {
  showCustomAlert("Vuelve a intentarlo correctamente.");
}
}

//Multiplicacion de Garrafon
var resultadoGarrafon = 0
function validarCantidadGarrafon(input) {
const cantidadGarrafon = input.value;
resultadoGarrafon = parseFloat(cantidadGarrafon, 10) * 18;
// Mostrar el resultado en el elemento con id "resultadoTortilla"
document.getElementById("resultadoGarrafon").innerText = `Precio total:$${resultadoGarrafon.toFixed(2)}`;
}

function confirmarPedidoGarrafon() {
const garrafonOption = document.querySelector('input[name="garrafonoption"]:checked');
const cantidadGarrafon = parseFloat(document.getElementById("cantidadGarrafon").value, 10);

if (!garrafonOption) {
  showCustomAlert("Debes seleccionar un garrafón.");
  return;
}

if (isNaN(cantidadGarrafon) || cantidadGarrafon <= 0 || cantidadGarrafon > 100) {
  showCustomAlert("Debes ingresar una cantidad válida entre 1 y 100.");
  return;
}

const tipoGarrafon = garrafonOption.labels[0].textContent;

const seleccion = `Su pedido es: ${tipoGarrafon}, Cantidad: ${cantidadGarrafon} garrafones, Precio total: $${resultadoGarrafon}.00`;

const confirmacion = confirm(seleccion + "\n\n¿Confirmar el pedido de Garrafon?");

if (confirmacion) {
  agregarAlCarrito({
    item: tipoGarrafon,
    cantidad: cantidadGarrafon,
    precio: resultadoGarrafon.toFixed(2)
  });
  showCustomAlert("¡Pedido de garrafon confirmado correctamente!");

  // Limpiar los campos del formulario
  document.querySelector('input[name="garrafonoption"]:checked').checked = false;
  document.getElementById("cantidadGarrafon").value = "";
  document.getElementById("resultadoGarrafon").innerText = "";

  // Cerrar la ventana modal si se desea
  cerrarVentana(4);
} else {
  showCustomAlert("Vuelve a intentarlo correctamente.");
}
}

//Multiplicacion de Totopos
var resultadoTotopos = 0
function validarCantidadTotopos(input) {
const cantidadTotopos = input.value;
resultadoTotopos = parseInt(cantidadTotopos, 10) * 25;
// Mostrar el resultado en el elemento con id "resultadoTortilla"
document.getElementById("resultadoTotopos").innerText = `Precio total:$${resultadoTotopos.toFixed(2)}`;
}

function confirmarPedidoTotopos() {
const totoposOption = document.querySelector('input[name="totoposoption"]:checked');
const cantidadTotopos = parseInt(document.getElementById("cantidadTotopos").value, 10);

if (!totoposOption) {
  showCustomAlert("Debes seleccionar una opcion de Totopos.");
  return;
}

if (isNaN(cantidadTotopos) || cantidadTotopos <= 0 || cantidadTotopos > 100) {
  showCustomAlert("Debes ingresar una cantidad un kilo o medio kilo.");
  return;
}

const tipoTotopos = totoposOption.labels[0].textContent;

const seleccion = `Su pedido es: ${tipoTotopos}, Cantidad: ${cantidadTotopos} bolsas, Precio total: $${resultadoTotopos}.00`;

const confirmacion = confirm(seleccion + "\n\n¿Confirmar el pedido de Totopos?");

if (confirmacion) {
  agregarAlCarrito({
    item: tipoTotopos,
    cantidad: cantidadTotopos,
    precio: resultadoTotopos.toFixed(2)
  });
  showCustomAlert("¡Pedido de Totopos confirmado correctamente!");

  // Limpiar los campos del formulario
  document.querySelector('input[name="totoposoption"]:checked').checked = false;
  document.getElementById("cantidadTotopos").value = "";
  document.getElementById("resultadoTotopos").innerText = "";

  // Cerrar la ventana modal si se desea
  cerrarVentana(5);
} else {
  showCustomAlert("Vuelve a intentarlo correctamente.");
}
}

var resultadoPollo = 0;

function actualizarPrecio() {
const cantidadPollo = parseFloat(document.getElementById("cantidadPollo").value, 10);
const precioPollo = parseFloat(document.querySelector('input[name="pollooption"]:checked').value, 10);
resultadoPollo = cantidadPollo * precioPollo;


if (!isNaN(resultadoPollo)) {
  document.getElementById("resultadoPollo").innerText = `Precio total:$${resultadoPollo.toFixed(2)}`;
}
}



function confirmarPedidoPollo() {
const cantidadPollo = parseFloat(document.getElementById("cantidadPollo").value);
const polloSeleccionado = document.querySelector('input[name="pollooption"]:checked');
if (!polloSeleccionado) {
  showCustomAlert("Debes seleccionar una opción de pollo.");
  return;
}

if (isNaN(cantidadPollo) || cantidadPollo % 0.5 !== 0 || cantidadPollo > 100) {
  showCustomAlert("Debes ingresar una cantidad de un kilo o medio kilo.");
  return;
}

const tipoPolloLabel = document.querySelector('input[name="pollooption"]:checked + label');
const tipoPollo = tipoPolloLabel.textContent.split("-")[0].trim();

const resultadoPollo = cantidadPollo * parseFloat(polloSeleccionado.value);
const seleccion = `Su pedido es: ${tipoPollo}, Cantidad: ${cantidadPollo} kilos, Precio total: $${resultadoPollo.toFixed(2)}`;
const confirmacion = confirm(seleccion + "\n\n¿Confirmar el pedido de Pollo?");

if (confirmacion) {
  agregarAlCarrito({
    item: tipoPollo,
    cantidad: cantidadPollo,
    precio: resultadoPollo.toFixed(2)
  });

  showCustomAlert("¡Pedido de Pollo confirmado correctamente!");

  // Limpiar los campos del formulario
  document.querySelector('input[name="pollooption"]:checked').checked = false;
  document.getElementById("cantidadPollo").value = "";
  document.getElementById("resultadoPollo").innerText = "";

  cerrarVentana(2);
} else {
  showCustomAlert("Vuelve a intentarlo correctamente.");
}
}

//Funcion de ventana emergente paraconfirmar pedido

function showCustomAlert(message) {
const customAlert = document.getElementById("customAlert");
const customAlertMessage = document.getElementById("customAlertMessage");
customAlertMessage.textContent = message;
customAlert.style.display = "block";
}

function closeCustomAlert() {
const customAlert = document.getElementById("customAlert");
customAlert.style.display = "none";
}

let seleccionados = [];
function calcularSuma() {
let checkboxes = document.querySelectorAll('input[type="checkbox"]');
let suma = 0;
seleccionados = [];

checkboxes.forEach(function (checkbox) {
  let valor = parseFloat(checkbox.value);
  let cantidadInput = document.querySelector(`input[name="cantidad_${checkbox.name}"]`);
  let cantidad = parseFloat(cantidadInput.value);

  if (checkbox.checked && cantidad > 0) {
    suma += valor * cantidad;
    let etiqueta = checkbox.nextElementSibling.textContent;
    seleccionados.push({
      item: etiqueta,
      cantidad: cantidad,
      precio: (valor * cantidad).toFixed(2)
    });
  }
});

let totalElement = document.getElementById('total');
totalElement.textContent = `Total: $${suma.toFixed(2)}`;

// Agregar aquí cualquier otra lógica que dependa de los campos únicos de cantidad
}

function mostrarSeleccionados() {
calcularSuma();

if (seleccionados.length > 0) {
  let mensajePedido = "Pedido de Verduras:\n";
  let totalPedido = 0;

  seleccionados.forEach(function (item) {
    let itemInfo = `${item.item}, Cantidad: ${item.cantidad} kilos, Precio total: $${item.precio}\n`;
    mensajePedido += itemInfo;
    totalPedido += parseFloat(item.precio);
  });

  let validCantidad = seleccionados.every(item => item.cantidad % 0.5 === 0); // Verificar si todas las cantidades son múltiplos de 0.5
  if (!validCantidad) {
    showCustomAlert("Debes ingresar una cantidad de un kilo o medio kilo.");
    return;
  }

  const confirmacion = confirm(mensajePedido + `\nTotal del Pedido: $${totalPedido.toFixed(2)}\n\n¿Confirmar el pedido de verduras?`);

  if (confirmacion) {
    agregarAlCarrito(seleccionados);
    showCustomAlert("¡Pedido de Verduras confirmado correctamente!");

    cerrarVentana(6);
  } else {
    showCustomAlert("El pedido de Verduras no fue confirmado.");
  }
} else {
  showCustomAlert("No se ha seleccionado ninguna verdura o la cantidad es cero.");
}
}



function agregarAlCarrito(pedido) {
let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
carrito = carrito.concat(pedido);
localStorage.setItem('carrito', JSON.stringify(carrito));
}