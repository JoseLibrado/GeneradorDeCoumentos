(()=>{
     
    $('#confirmacion').click(() => {

        completeConfirmacion('2','');

        $.ajax({
                url:'../pagina/php/valanceador.php' ,
                type: 'POST',
                async: true,
                datatype: 'JSON',
                data: {
                    version: $('#version').val(),
                    folio: $('#folio').val(),
                    area: $('#area').val(),
                    sistema: $('#sistema').val(),
                    modulo: $('#modulo').val(),
                    opcion: $('#opcion').val(),
                    nomFolio: $('#nfolio').val(),
                    nomUsuario: $('#nusuaruio').val(),
                    nomTester: $('#ntester').val(),
                },
                success: (data) => {                              
                    res = JSON.parse(data);
                    for (const iterator of res.datos) {
                        console.log(iterator.plantilla,iterator.respuesta);                        
                    }
                    $('#editardatos').removeAttr('disabled');
                    completeConfirmacion(res.datos[0].respuesta,'');
                    presentarDocumentos(res.datos);
                },
                error: (err) => {
                    console.log(err.status);
                    completeConfirmacion(err.status,err.status + ' ' + err.statusText + ', ' + 'contactar al correo jose.soto@aforecoppel.com');
                },
        });

        // $('#modals').addClass('d-none');
        console.log('cierre d emodal');
    });

    
    //llamado de modal en pantalla de generador de archivos
    $('#garchivos').click( () => {
        $('#modals').removeClass('d-none');
        let bandera = confirmacionDatos();
        if ( bandera )
        {
            $('#confirmacion').attr('disabled','true');            
        }
        else
        {
            $('#confirmacion').removeAttr('disabled');          
        }
    });
    
        //cierre de modal para editar datos
    $('#editardatos').click(() => {
        $('#modals').addClass('d-none');
        console.log('cierre d emodal');
    });

    // llamado de modal en pantalla de descarga de archivos
    $('#darchivos').click( () => {
        $('#modals').removeClass('d-none');
        completeConfirmacion('2','');        
        /*

        -->generacion de documentos
            si se generaron.
                completeConfirmacion('2','');        
            si no.
                mostrar mensaje de error de generacion
          
         */
        
    });

    $('#limpiar').click( () => {
        limpiarCampos();
    });

    //llenado de datos en modal con informacion capturada
    const confirmacionDatos = ()=> 
    {
        let banderaDatosFaltantes = false;

        presentarDatosCapturadosModal();
        $('#modalconfirmacion').html('');
        let objDatos = 
        {
            version: $('#version').val(),
            folio: $('#folio').val(),
            area: $('#area').val(),
            sistema: $('#sistema').val(),
            modulo: $('#modulo').val(),
            opcion: $('#opcion').val(),
            nomFolio: $('#nfolio').val(),
            nomUsuario: $('#nusuaruio').val(),
            nomTester: $('#ntester').val(),
        }
        let arreglovalores = Object.values(objDatos);
        let arreglokey = ['Version','Folio','Area','Sistema','Modulo','Opcion','Nombre Folio','Nombre Usuario','Nombre Tester'];
        

        for (let i=0;i < arreglovalores.length;i++) {

            if (arreglovalores[i] != '')
            {
                $('#modalconfirmacion').append(`<tr class="row fw-bold text-center">
                                <td class="col-6 text-dark text-opacity-50">${arreglokey[i]}</td>  
                                <td class="col">${arreglovalores[i]}</td>
                                </tr>`);
            } 
            else if(arreglovalores[i] == '' || arreglovalores[i] == undefined)
            {
                $('#modalconfirmacion').append(`<tr class="row fw-bold text-center">
                                <td class="col-6 text-dark text-opacity-50">${arreglokey[i]}</td>  
                                <td class="col text-warning">INGRESAR INFORMACIÓN</td>
                                </tr>`);    
                banderaDatosFaltantes = true;
            }
        }
        if (banderaDatosFaltantes) 
        {
            // $('#alertmodal').removeClass('text-warning'); 
            $('#alertmodal').text('Falta llenar campos'); 
            $('#alertmodal').addClass('text-warning');            
        }
        else
        {
            // $('#alertmodal').removeClass('text-danger');
            $('#alertmodal').text('Los datos capturados son correctos?...'); 
            $('#alertmodal').addClass('text-warning');   

        }
        return banderaDatosFaltantes;
        
    }

    const completeConfirmacion = (idmensaje,msg) => {
        let imagen = '';
        let mensaje = '';        
        switch(idmensaje){
            case '1':
                // imagen = 'confirmacion.png';
                imagen = 'confirmacion_2.png';
                mensaje = 'Cerrar y dirigirse a la penstaña <mark>Descarga</mark>';
                break;
            case '-1':
                imagen = 'rechazo_2.png';
                mensaje = 'Hubo un problema al generar los documentos';
                break;
            case '2':
                imagen = 'reloj.png';
                mensaje = 'Trabajando ...';
                $('#editardatos').attr('disabled','true');
                break;
            case '3':
                imagen = 'confirmacion_2.png';
                mensaje = 'Documentos descargados con exito.';
                break;
            default:
                mensaje = `<span class="fs-1">${msg}</span>`;
                imagen = '404_2.png';
                break;            
        }       
        $('.card-body').html('');
        $('.card-body').html(`<div class="p-2 row justify-content-center">
        <img src='../pagina/assets/img/${imagen}' class='col-7'>
        </div>
        <h4 class="card-subtitle mb-2 text-muted col text-center">${mensaje}</h4>
        `);
        $('#confirmacion').addClass('d-none');
        $('#editardatos').text('Cerrar');

        $('#version').prop('disabled','true');
        $('#folio').prop('disabled','true');
        $('#area').prop('disabled','true');
        $('#sistema').prop('disabled','true');
        $('#modulo').prop('disabled','true');
        $('#opcion').prop('disabled','true');
        $('#nfolio').prop('disabled','true');
        $('#nusuaruio').prop('disabled','true');
        $('#ntester').prop('disabled','true');
                
        $('#garchivos').attr('disabled','true'); 

    }

    const limpiarCampos = () => 
    {

        $('#version').val('');
        $('#folio').val('');
        $('#area').val('');
        $('#sistema').val('');
        $('#modulo').val('');
        $('#opcion').val('');
        $('#nfolio').val('');
        $('#nusuaruio').val('');
        $('#ntester').val('');

        $('#version').removeAttr('disabled');
        $('#folio').removeAttr('disabled');
        $('#area').removeAttr('disabled');
        $('#sistema').removeAttr('disabled');
        $('#modulo').removeAttr('disabled');
        $('#opcion').removeAttr('disabled');
        $('#nfolio').removeAttr('disabled');
        $('#nusuaruio').removeAttr('disabled');
        $('#ntester').removeAttr('disabled');

        presentarDatosCapturadosModal();
        $('#garchivos').removeAttr('disabled');
    }

    const presentarDatosCapturadosModal = () => 
    {
        $('.card-body').html('');
        $('.card-body').html(`<div class="row table-documents">
                                <table class="row table table-borderless">
                                    <tbody id="modalconfirmacion"></tbody>
                                </table>
                            </div>
                            <h2 class="card-title mt-4 text-center"><span id="alertmodal"></span></h2>`);

        $('#confirmacion').removeClass('d-none');
        $('#editardatos').text('Editar');
    }

    /// pagina de descarga

    const presentarDocumentos = (arrDocumentos) => {
        $('#imprdocumentos').html('');
        for (const iterator of arrDocumentos) {

            $('#imprdocumentos').append(`<tr class="row border-bottom">
                                            <td class="col">${iterator.plantilla}</td>
                                            <td class="col">${iterator.mensaje}</td>
                                        </tr>`);                            
            
        }
        
    }

    //funciones deprecadas    
    const objeto = (paramobj,elemento) => {
        elemento.html('');
        let arreglokey = ['Version','Folio','Area','Sistema','Modulo','Opcion','Nombre Folio','Nombre Usuario','Nombre Tester'];
        let arreglovalores = Object.values(paramobj);

        for (let i=0;i < arreglovalores.length;i++) {

            if (arreglovalores[i] != '')
            {
                elemento.append(`<tr class="row fw-bold">
                                <td class="col-6 text-dark text-opacity-75">${arreglokey[i]}</td>  
                                <td class="col">${arreglovalores[i]}</td>
                                </tr>`);
            }
        }
    }

})();