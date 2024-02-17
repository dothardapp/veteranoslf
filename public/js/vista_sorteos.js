(function () {
    function init() {
        // Llama a la función cargarDatos con el id = 1 cuando la página se carga.
        cargarDatos(1);

        var selector = document.getElementById('campeonatoSelect');

        if (selector) {
            selector.addEventListener('change', function () {
                cargarDatos(this.value);
            });
        } else {
            console.log('El elemento con ID "campeonatoSelect" no existe en el DOM.');
        }

        var btn = document.getElementById('btnajax');

        if (btn) {
            btn.addEventListener('click', function () {
                change_message();
            });
        } else {
            console.log('El elemento con ID "btnajax" no existe en el DOM.');
        }
    }

    function cargarDatos(campeonatoId) {
        axios.get('/admin/filtrar-campeonato?campeonato_id=' + campeonatoId)
            .then(function (response) {
                actualizarVistaConSorteos(response.data.sorteosPorDivisionYZona, response.data.nombreCampeonato);
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    function actualizarVistaConSorteos(data, nombreCampeonato) {
        var contenedor = document.getElementById('sorteosContenedor');
        contenedor.innerHTML = ''; // Limpia el contenedor

        // Agrupa los datos por división y zona
        const grupos = data.reduce(function (acc, sorteo) {
            const clave = sorteo.division + '-' + sorteo.zona;
            if (!acc[clave]) {
                acc[clave] = {
                    division: sorteo.division,
                    zona: sorteo.zona,
                    sorteos: []
                };
            }
            acc[clave].sorteos.push(sorteo);
            return acc;
        }, {});

        // Itera sobre cada grupo para crear las tarjetas
        Object.values(grupos).forEach(function (grupo) {
            let tarjetaHTML = '<div class="col"><div class="card h-100">';
            tarjetaHTML += `<h5 class="card-header text-center" style="color: #fff; background-color: #007bff; padding: 10px; border-radius: 5px;">DIVISIÓN "${grupo.division}"<br>${nombreCampeonato}</h5>`;
            tarjetaHTML += '<div class="card-body">';
            tarjetaHTML += `<div class="card-title text-center bg-success p-2 text-dark fw-bold bg-opacity-10">Zona ${grupo.zona}</div>`;
            tarjetaHTML += '<table class="table"><tbody>';

            grupo.sorteos.forEach(function (sorteo, index) {
                tarjetaHTML += `<tr><th scope="row">${index + 1}</th><td>${sorteo.equipo.nombre}</td></tr>`;
            });

            tarjetaHTML += '</tbody></table></div>'; // Cierra card-body
            tarjetaHTML += `<div class="card-footer"><small class="text-muted">Subido ${grupo.sorteos[0] ? new Date(grupo.sorteos[0].fecha).toLocaleDateString() : 'No hay fecha disponible'}</small></div>`;
            tarjetaHTML += '</div></div>'; // Cierra card y col

            // Añade la tarjeta al contenedor
            contenedor.innerHTML += tarjetaHTML;
        });
    }

    function change_message() {
        axios.get('/admin/mensaje')
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    // Verifica si el DOM ya está cargado
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        // El DOM ya está listo
        init();
    }
})();
