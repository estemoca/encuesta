$(document).ready(function() {

    $(function() {
        $("#salida").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        
    });
    $('#departamentos').on('change',function(){
       loadMunicipios($(this).val());       
    });
    loadEps();
    loadDepartamentos();
    
    jQuery.extend(jQuery.validator.messages,{
       required: "Este campo es obligatorio",
       number: "No es un número válido",
    });
    $('#crePaciente').on('click',function(){
       $('#crearPaciente .modal-title').text('Crear Paciente');
       $('#createPaciente').trigger("reset");               
    });
    
    $("#createPaciente").validate({       
        rules: {
           nombre: {required:true},
           apellido: {required:true},
           direccion: {required: true},
           telefono: {required:true, number:true},
           celular: {required:true, number:true},
           departamento: {required: true},
           municipio: {required: true},
           eps: {required: true},               
       },       
    });
     $("#createPaciente").submit(function(e) {
         e.preventDefault();
        if ($("#createPaciente").valid()) {
            createPaciente($(this));
        }       
     });
     $('#delPaciente').on('click',function(){
         deletePaciente( $('#modalDeletePaciente').attr('data-id'));
     });
     $('.deletePaciente').on('click',function(){
        var id = $(this).attr('data-id'); 
        $('#modalDeletePaciente').attr('data-id',id);
     });    
     $('.editPaciente').on('click',function(){
         var id = $(this).attr('data-id');
         getPaciente(id);
     });
     
});

var createPaciente= function(form){
    $.ajax({
            type: "POST",
            url: BASE_URL + "createpacienteXHR",
            dataType: "json",
            data: form.serialize(),
            success: function(data) {
                if(data){                    
                    $('#alertPaciente').fadeIn();
                    setTimeout(function(){ 
                         $('#alertPaciente').fadeOut('slow');
                         window.location.reload();
//                         $('#crearPaciente').modal('hide'); 
//                          $('#createPaciente').trigger("reset");
                    }, 2000);                                                          
                }
            },
            error: function(e) {
                console.debug(e);
            }
    });
}
var deletePaciente = function(id){
     $.ajax({
            type: "POST",
            url: BASE_URL + "deletepacienteXHR",
            dataType: "json",
            data:'id='+id,
            success: function(data) {                
                if(data){
                    $('#alertDelPaciente').fadeIn();
                     setTimeout(function(){ 
                         $('#alertDelPaciente').fadeOut('slow');
                         window.location.reload();
                    }, 2000);
                }
            },         
    });
};
var getPaciente = function(id){
    $.ajax({
            type: "POST",
            url: BASE_URL + "getpacienteXHR",
            dataType: "json",
            data:'id='+id,
            success: function(data) {  
                if(data){
                    setForm(data);
                }
            },           
    });
};


var setForm = function(form){
   $('#crearPaciente .modal-title').text('Editar Paciente');
   $('#Nombre').val(form.nombre);
   $('#Apellido').val(form.apellido);
   $('#Celular').val(form.celular);
   $('#Telefono').val(form.telefono);
   $('#Direccion').val(form.direccion);   
   $('#eps').val(form.id_eps).trigger('change');   
   getMunicipio(form.id_municipio);
};

var getMunicipio = function(id){
    $.ajax({
            type: "POST",
            url: BASE_URL + "getmunicipioXHR",
            dataType: "json",
            data:'id='+id,
            success: function(data) {  
                if(data){
                    console.info(data);
                    $('#departamentos').val(data.id_departamento).trigger('change');
                    setTimeout(function(){ 
                          $('#municipios').val(data.id).trigger('change');
                         $('#municipios').removeAttr('disabled');
                    }, 300);                                       
                }
            },           
    });
};
var loadEps = function() {
    $.ajax({
            type: "POST",
            url: BASE_URL + "loadepsXHR",
            dataType: "json",
            data: {},
            success: function(data) {                
                $.each(data, function (i, item) {
                    $('#eps').append($('<option>', {
                        value: item.id,
                        text : item.nombre
                    }));
                });
            },
            error: function(e) {
                console.debug(e);
            }
    });
};
var loadDepartamentos = function() {
    $.ajax({
            type: "POST",
            url: BASE_URL + "loaddepartamentosXHR",
            dataType: "json",
            data: {},
            success: function(data) {                
                $.each(data, function (i, item) {
                    $('#departamentos').append($('<option>', {
                        value: item.id,
                        text : item.nombre
                    }));
                });
            },
            error: function(e) {
                console.debug(e);
            }
    });
};
var loadMunicipios = function(id) {
    $.ajax({
            type: "POST",
            url: BASE_URL + "getmunicipiosbydepartamentoXHR",
            dataType: "json",
            data:'id='+id,
            success: function(data) {   
                $('#municipios').html($('<option>', {value: '',text : '--Seleccionar Municipio--'}));
                $.each(data, function (i, item) {
                    $('#municipios').append($('<option>', {
                        value: item.id,
                        text : item.nombre
                    }));
                });                
                $('#municipios').removeAttr('disabled');
            },
            error: function(e) {
                console.debug(e);
            }
            
    });
};
