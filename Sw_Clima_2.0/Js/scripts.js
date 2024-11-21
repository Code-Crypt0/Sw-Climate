document.getElementById("weather-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar el envío del formulario

    // Obtener los valores ingresados
    const temperatura = parseFloat(document.getElementById("temperatura").value);
    const humedad = parseFloat(document.getElementById("humedad").value);
    const presion = parseFloat(document.getElementById("presion").value);
    const viento = parseFloat(document.getElementById("viento").value);
    const precipitacion = parseFloat(document.getElementById("precipitacion").value);

    // Validar campos
    if (isNaN(temperatura) || isNaN(humedad) || isNaN(presion) || isNaN(viento) || isNaN(precipitacion)) {
        alert("Por favor, complete todos los campos.");
        return;
    }

    // Cálculo del índice de calor
    let indiceCalor = null;
    if (temperatura > 27) {
        indiceCalor = -42.379 + 2.04901523 * temperatura + 10.14333127 * humedad
            - 0.22475541 * temperatura * humedad - 0.00122874 * Math.pow(temperatura, 2)
            - 0.00085282 * Math.pow(humedad, 2) + 0.00000199 * Math.pow(temperatura, 2) * humedad
            + 0.00000001 * temperatura * Math.pow(humedad, 2) - 0.00000001 * Math.pow(temperatura, 2) * Math.pow(humedad, 2);
    }

    // Lógica mejorada para determinar el pronóstico
    let pronostico = "";
    let gif = "";

    // Condiciones para nieve
    if (temperatura <= 0 && precipitacion > 0) {
        pronostico = "Se espera nieve.";
        gif = "Img/nieve.gif";
    }
    // Condiciones para lluvia
    else if (precipitacion > 0) {
        if (humedad > 80) {
            pronostico = "Se espera lluvia intensa.";
            gif = "Img/Lluvia.gif";
        } else if (humedad > 60) {
            pronostico = "Se espera lluvia moderada.";
            gif = "Img/Lluvia.gif";
        } else {
            pronostico = "Se espera lluvia ligera.";
            gif = "Img/llovizna.gif";
        }
    }
    // Condiciones para nublado
    else if (humedad > 70) {
        if (temperatura < 15) {
            pronostico = "El día estará nublado y fresco.";
            gif = "Img/noche-nublada.gif";
        } else {
            pronostico = "El día estará nublado.";
            gif = "Img/nublado.gif";
        }
    }
    // Condiciones cálidas y húmedas
    else if (indiceCalor && indiceCalor > 40) {
        pronostico = `El día estará soleado y cálido con un índice de calor de ${Math.round(indiceCalor)}°C.`;
        gif = "Img/Sol-2.gif";
    }
    // Condiciones soleadas
    else if (temperatura > 20 && humedad <= 60 && viento < 5) {
        pronostico = "El día estará soleado y cálido.";
        gif = "Img/Sol-2.gif";
    }
    // Condiciones despejadas con viento
    else if (temperatura > 20 && humedad <= 70 && viento >= 5) {
        pronostico = "El día estará despejado con viento moderado.";
        gif = "Img/viento.gif";
    } 
    // Condiciones frías y secas
    else if (temperatura < 15 && humedad < 50) {
        pronostico = "El día estará frío y seco.";
        gif = "Img/noche.gif";
    } 
    // Tendencia de presión atmosférica
    else if (presion < 1013) {
        pronostico += " La presión atmosférica está baja, lo que puede indicar mal tiempo.";
    } else if (presion > 1020) {
        pronostico += " La presión atmosférica está alta, lo que sugiere un clima estable.";
    }
    
    // Otras condiciones generales
    else {
        pronostico = "El día tendrá condiciones variables.";
        gif = "Img/nubes.gif";
    }

    // Mostrar el resultado en la página
    document.getElementById("resultado").innerHTML = `<h2>Pronóstico:</h2><p>${pronostico}</p>`;
    document.getElementById("gif-container").innerHTML = `<img src="${gif}" alt="Pronóstico">`;

    // Obtener la fecha y hora actual
    const fechaHora = new Date().toLocaleString();

    // Crear una nueva fila en la tabla con los datos ingresados y el pronóstico
    const newRow = document.createElement('tr');
    
    newRow.innerHTML = `
        <td>${temperatura.toFixed(1)}</td>
        <td>${humedad.toFixed(1)}</td>
        <td>${presion.toFixed(1)}</td>
        <td>${viento.toFixed(1)}</td>
        <td>${precipitacion.toFixed(1)}</td>
        <td>${pronostico}</td>
        <td>${fechaHora}</td>
    `;
    
    // Agregar la nueva fila al cuerpo de la tabla
    document.getElementById("data-body").appendChild(newRow);

    // Activar el botón de eliminar
    document.getElementById("eliminar-btn").disabled = false;
});

// Función para eliminar los datos de la tabla y limpiar los campos
document.getElementById("eliminar-btn").addEventListener("click", function() {
    const dataBody = document.getElementById("data-body");
    while (dataBody.firstChild) {
        dataBody.removeChild(dataBody.firstChild);
    }
    document.getElementById("resultado").innerHTML = ''; // Limpiar el resultado
    document.getElementById("gif-container").innerHTML = ''; // Limpiar el gif
    this.disabled = true; // Desactivar el botón de eliminar

    // Limpiar los campos de entrada
    document.getElementById("weather-form").reset();
});
