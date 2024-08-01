function mostrarCarrito() {
    let carrito = JSON.parse(localStorage.getItem('carrito'));
    let carritoDiv = document.getElementById('carrito');
    carritoDiv.innerHTML = '';
    let totalCarrito = 0;

    if (carrito && carrito.length > 0) {
        carrito.forEach(function (item, index) {
            let itemInfo = `${item.item}, Cantidad: ${item.cantidad} Kg/Pza , Precio: $${item.precio}`;
            totalCarrito += parseFloat(item.precio);
            carritoDiv.innerHTML += `
            <p>${itemInfo}</p>
            <button onclick="eliminarPedido(${index})">Eliminar</button>
            <hr>`;
        });
    } else {
        carritoDiv.innerHTML = '<p>El carrito está vacío.</p>';
    }

    carritoDiv.innerHTML += `<p><strong>Total del Carrito: $${totalCarrito.toFixed(2)}</strong></p>`;
}

function eliminarPedido(index) {
let carrito = JSON.parse(localStorage.getItem('carrito'));
if (carrito && carrito.length > 0) {
    carrito.splice(index, 1);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    mostrarCarrito();
}
}
mostrarCarrito();

/*LLenado del formulario */


const btnMostrarModal = document.getElementById('mostrarModal');
const modalOverlay = document.getElementById('modalOverlay');
const modal = document.getElementById('modal');
const enviarFormularioBtn = document.getElementById('enviarFormulario');

btnMostrarModal.addEventListener('click', () => {
  modalOverlay.style.display = 'block';
  modal.style.display = 'block';
});

enviarFormularioBtn.addEventListener('click', () => {
  const formData = new FormData(document.getElementById('formulario'));
  const formValues = {};
  formData.forEach((value, key) => {
    formValues[key] = value;
  });

  console.log(formValues); // Agrega este console.log para depurar
  

  // Aquí puedes realizar una llamada AJAX para enviar los datos al backend o hacer lo que necesites
  console.log('Datos del formulario:', formValues);

  
  
});

function closeForm() {
  modalOverlay.style.display = 'none';
  modal.style.display = 'none';
}



function limiteTelefono(input) {
    const maxDigits = 10;
    if (input.value.length > maxDigits) {
      input.value = input.value.slice(0, maxDigits);
    }
  }

  function limiteNoInt(input) {
    const maxDigits = 3;
    if (input.value.length > maxDigits) {
      input.value = input.value.slice(0, maxDigits);
    }
  }

function limiteNoExt(input) {
    const maxDigits = 3;
    if (input.value.length > maxDigits) {
      input.value = input.value.slice(0, maxDigits);
    }
  }
  function limiteDepartamento(input) {
    const maxDigits = 3;
    if (input.value.length > maxDigits) {
      input.value = input.value.slice(0, maxDigits);
    }
  }
  function limiteCP(input) {
    const maxDigits = 5;
    if (input.value.length > maxDigits) {
      input.value = input.value.slice(0, maxDigits);
    }
  }


function GuardarBaseDatos() {
    let carrito = JSON.parse(localStorage.getItem('carrito'));
    if (!carrito || carrito.length === 0) {
        alert('El carrito está vacío. Agrega elementos antes de enviar el pedido.');
        return; // Detener el proceso si el carrito está vacío
    }
    if (carrito && carrito.length > 0) {
        let formularioData = new FormData(document.getElementById('formulario'));

    // Verificar si hay campos requeridos vacíos en el formulario
    let camposFaltantes = [];
    if (!formularioData.get('nombre')) camposFaltantes.push('nombre');
    if (!formularioData.get('apellido')) camposFaltantes.push('apellido');
    if (!formularioData.get('telefono')) camposFaltantes.push('telefono');
    if (!formularioData.get('calle')) camposFaltantes.push('calle');
    if (!formularioData.get('noCalleInterior')) camposFaltantes.push('noCalleInterior');
    if (!formularioData.get('noCalleExterior')) camposFaltantes.push('noCalleExterior');
    if (!formularioData.get('departamento')) camposFaltantes.push('departamento');
    if (!formularioData.get('colonia')) camposFaltantes.push('colonia');
    if (!formularioData.get('cp')) camposFaltantes.push('cp');
    if (!formularioData.get('indicaciones')) camposFaltantes.push('indicaciones');
    if (!formularioData.get('formaPago')) camposFaltantes.push('formaPago');

    // Agregar más campos según sea necesario...

    if (camposFaltantes.length > 0) {
        // Agregar la clase "error-field" a los campos faltantes para resaltarlos en rojo
        

        alert('Completa todos los campos requeridos en el formulario antes de enviar el pedido.');
        camposFaltantes.forEach(fieldName => {
            document.getElementById(fieldName).classList.add('error-field');
        });
        return; // Detener el proceso si hay campos faltantes en el formulario
    }

    

        // Capturar los datos del formulario
        let datosFormulario = {
            nombre: formularioData.get('nombre'),
            apellido: formularioData.get('apellido'),
            telefono: formularioData.get('telefono'), // Agregar el campo de teléfono
            calle: formularioData.get('calle'),
            noCalleInterior: formularioData.get('noCalleInterior'),
            noCalleExterior: formularioData.get('noCalleExterior'),
            departamento: formularioData.get('departamento'),
            colonia: formularioData.get('colonia'),
            cp: formularioData.get('cp'),
            indicaciones: formularioData.get('indicaciones'),
            formaPago: formularioData.get('formaPago')
        };

        // Agregar los datos del formulario al pedido
        let pedido = {
            carrito: carrito,
            datosFormulario: datosFormulario
        };

        // Enviar el pedido al servidor para guardar en la base de datos
        fetch('guardar_carrito_en_bd.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(pedido)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            localStorage.removeItem('carrito');
	          closeForm();
            mostrarCarrito();
            alert('Pedido y datos de envío guardados correctamente.');
            // Limpia el formulario después de un envío exitoso
            document.getElementById('formulario').reset();
             // Redirecciona a la página principal después de un envío exitoso
    window.location.href = 'index.html'; 
            
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al guardar el pedido');
        });
    }
}






