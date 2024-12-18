let ventasChart;
const fechaActual = new Date(); // Obtiene la fecha y hora actual
const añoActual = fechaActual.getFullYear();
ventas_mes_grafico(añoActual);

async function obtenerAños() {
  try {
    // Realizar una solicitud al archivo PHP
    const response = await fetch('/sistema_estefany/app/graficas/obtener_años_ventas.php'); // Cambia el nombre al archivo PHP correspondiente
    if (!response.ok) throw new Error("Error al obtener los datos");

    // Parsear la respuesta JSON
    const años = await response.json();

    // Llenar el select con los años
    const select = document.getElementById('year');
    select.innerHTML = ''; // Limpiar opciones previas
    años.forEach(año => {
      const option = document.createElement('option');
      option.value = año;
      option.textContent = año;
      select.appendChild(option);
    });
  } catch (error) {
    console.error("Error:", error);
  }
}

// Llamar a la función al cargar la página
obtenerAños();

async function obtenerCantidadClientes(){
    const response = await fetch('/sistema_estefany/app/cliente/obtener_cantidad_cliente.php'); // Cambia el nombre al archivo PHP
    if (!response.ok) throw new Error("Error al obtener los datos");
    
    const cantidad = await response.json();
    const card = document.getElementById("cantidad_cliente");
    card.textContent = cantidad;
    console.log(cantidad);
}
async function obtenerCantidadProductos(){
    const response = await fetch('/sistema_estefany/app/producto/obtener_cantidad_producto.php'); // Cambia el nombre al archivo PHP
    if (!response.ok) throw new Error("Error al obtener los datos");
    
    const cantidad = await response.json();
    const card = document.getElementById("cantidad_producto");
    card.textContent = cantidad;
    console.log(cantidad);
}
async function obtenerCantidadProveedores(){
    const response = await fetch('/sistema_estefany/app/proveedor/obtener_cantidad_proveedor.php'); // Cambia el nombre al archivo PHP
    if (!response.ok) throw new Error("Error al obtener los datos");
    
    const cantidad = await response.json();
    const card = document.getElementById("cantidad_proveedor");
    card.textContent = cantidad;
    console.log(cantidad);
}
async function obtenerCantidadVentas(){
    const response = await fetch('/sistema_estefany/app/venta/obtener_cantidad_venta.php'); // Cambia el nombre al archivo PHP
    if (!response.ok) throw new Error("Error al obtener los datos");
    
    const cantidad = await response.json();
    const card = document.getElementById("cantidad_venta");
    card.textContent = cantidad;
    console.log(cantidad);
}
obtenerCantidadClientes();
obtenerCantidadProductos();
obtenerCantidadProveedores();
obtenerCantidadVentas();
async function obtenerProductosMasVendidos() {
  try {
    const response = await fetch('/sistema_estefany/app/graficas/obtener_productos_demanda.php'); // Cambia el nombre al archivo PHP
    if (!response.ok) throw new Error("Error al obtener los datos");

    const productos = await response.json();

    // Separar los nombres de productos y las cantidades vendidas
    const nombres = productos.map(p => p.producto);
    const cantidades = productos.map(p => p.total_vendido);

    // Crear la gráfica
    const ctx = document.getElementById('pie_chart_producto_mas_vendido').getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: nombres, // Nombres de los productos
        datasets: [{
          label: 'Cantidad Vendida',
          data: cantidades, // Cantidades vendidas
          backgroundColor: [
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(99, 255, 132, 0.6)',
            'rgba(235, 54, 162, 0.6)',
            'rgba(86, 206, 255, 0.6)',
            'rgba(192, 75, 75, 0.6)',
          ],
          borderColor: 'rgba(0, 0, 0, 0.1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Top 10 Productos Más Vendidos',
            font: {
              size: 18
            }
          }
        }
      }
    });

  } catch (error) {
    console.error("Error:", error);
  }
}
async function obtenerProductosMenosVendidos() {
  try {
    const response = await fetch('/sistema_estefany/app/graficas/obtener_productos_menos_demanda.php'); // Cambia el nombre al archivo PHP
    if (!response.ok) throw new Error("Error al obtener los datos");

    const productos = await response.json();

    // Separar los nombres de productos y las cantidades vendidas
    const nombres = productos.map(p => p.producto);
    const cantidades = productos.map(p => p.total_vendido);

    // Crear la gráfica
    const ctx = document.getElementById('pie_chart_producto_menos_vendido').getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: nombres, // Nombres de los productos
        datasets: [{
          label: 'Cantidad Vendida',
          data: cantidades, // Cantidades vendidas
          backgroundColor: [
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(99, 255, 132, 0.6)',
            'rgba(235, 54, 162, 0.6)',
            'rgba(86, 206, 255, 0.6)',
            'rgba(192, 75, 75, 0.6)',
          ],
          borderColor: 'rgba(0, 0, 0, 0.1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Top 10 Productos Menos Vendidos',
            font: {
              size: 18
            }
          }
        }
      }
    });

  } catch (error) {
    console.error("Error:", error);
  }
}
obtenerProductosMasVendidos();
obtenerProductosMenosVendidos();

function ventas_mes_grafico(year) {
  $.get("/sistema_estefany/app/graficas/venta_mes.php", {
    year: year
  }).done(function(data) {
    let ventas = [];
    data = JSON.parse(data);
    data.forEach(element => {
      ventas.push(element);
    });

    console.log(ventas);
    if (ventasChart) {
      ventasChart.destroy();
    }
    const ctx = document.getElementById('myChart');
    ventasChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        datasets: [{
          label: 'Ventas',
          data: data,
          backgroundColor: [
            'rgba(255, 99, 132, 0.6)', // Rojo
            'rgba(54, 162, 235, 0.6)', // Azul
            'rgba(255, 206, 86, 0.6)', // Amarillo
            'rgba(75, 192, 192, 0.6)', // Verde
            'rgba(153, 102, 255, 0.6)', // Morado
            'rgba(255, 159, 64, 0.6)', // Naranja
            'rgba(99, 255, 132, 0.6)', // Verde Claro
            'rgba(162, 54, 235, 0.6)', // Púrpura
            'rgba(206, 255, 86, 0.6)', // Verde Lima
            'rgba(192, 75, 192, 0.6)', // Rosa
            'rgba(102, 153, 255, 0.6)', // Azul Suave
            'rgba(255, 102, 159, 0.6)' // Rosa Claro
          ],
          borderWidth: 1
        }]
      },
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Ventas por mes',
            font: {
              size: 18
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

  })

}

function actualizar_ventas_mes_graficos() {
  const year = document.getElementById('year').value;
  console.log(year);
  ventas_mes_grafico(year);
}