(function(){

    
    // mostrar pantalla de captura de datos
    $('#setdata').click( () => {

        if ($('#setdata').hasClass('fw-bold')) {
            console.log('en pantalla de captura de datos');
        } else {
            $('#displaydownload').toggleClass('shadow fw-bold');
            $('#setdata').toggleClass('shadow fw-bold');
            $('#getdescargas').toggleClass('d-none');
            $('#setfields').toggleClass('d-none');
        }
        
    });

    // mostrar pantalla con grid de datos
    $('#displaydownload').click( () => {

        if ($('#displaydownload').hasClass('fw-bold')) {
            console.log('en pantalla de grid de descarga de archivos');
        } else {
            $('#setdata').toggleClass('shadow fw-bold');
            $('#displaydownload').toggleClass('shadow fw-bold');      
            $('#setfields').toggleClass('d-none');
            $('#getdescargas').toggleClass('d-none');
        }

    });


})();
