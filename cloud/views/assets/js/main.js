 var ctrlDown = false, ctrlKey = 17, cmdKey = 91, vKey = 86, cKey = 67;

 $(".button-collapse").sideNav();
 $("#publicaciones").modal();
 $('.tooltipped').tooltip({delay: 50});
 $('#dataGrid').DataTable({
      "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                  }
 });

 $("#btncomentarios").click(function(){
   $("#frmcomentario").submit();
 })
 // VALIDACION PARA INICIO DE SESION A TRAVES DEL FORMULARIO DE INKSIDE
 $("#frmlogin").submit(function(e) {
    e.preventDefault();
    if ($(this).parsley().isValid()) {
        var email = $("#txt_email").val();
        var pass  = $("#txt_password").val();
        $.post("iniciar-sesion",{email:email, pass:pass}, function(result){

          if(result == 0){
            $.sweetModal({
            	content: "El usuario no se encuentra registrado en Inkside o lo ha realizado a traves de una red social",
            	icon: $.sweetModal.ICON_ERROR
            });
          }else if(result == 1){
            $.sweetModal({
            	content: "La contraseña no es la correcta, por favor verifique nuevamente",
            	icon: $.sweetModal.ICON_ERROR
            });
          }else{
            document.location.href="../cloud/dashboard";
          }
        });
    }
});


 // REGISTRAR POETAS A TRAVES DEL FORMULARIO DE INKSIDE
 $("#registroPoeta").submit(function(e) {
    e.preventDefault();
    if ($(this).parsley().isValid()) {
      jsonObj = [];
      $("input").each(function(){

          structure = {}
          structure = $(this).val();

          jsonObj.push(structure);
      });

      $("#signup").html('<div class="loader"><div class="dot dot1"></div><div class="dot dot2"></div><div class="dot dot3"></div><div class="dot dot4"></div></div>');
      $.post("registro-poeta",{data: jsonObj}, function(result){
            var result = JSON.parse(result);
            $.sweetModal({
            	content: result[1],
            	icon: $.sweetModal.ICON_SUCCESS
            });
            $("input").val("");
            $("#signup").html("Registra otro poeta!")
            $("label").toggleClass("active");
      });
    }
});

// VALIDACION DEL CORREO QUE NO EXISTA EN LA BASE DE DATOS
$("#registroPoeta #txt_email").focusout(function(){
    $("#txt_email").siblings("ul").remove();
    $.post("valido-email",{data: $("#txt_email").val()}, function(result){
      var result = JSON.parse(result);
          if(result[0] == 0){
             $("#txt_email").siblings("label").after("<ul class='parsley-errors-list filled'><li class='parsley-required'>"+result[1]+"</li></ul>");
             $("#signup").prop("disabled",true);
           }else{
             $("#signup").prop("disabled",false);
           }
    });
});

// CONTROL CTRL+V DESHABILITADO

$(document).keydown(function(e) {
    if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
    }).keyup(function(e) {
    if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = false;
});

$("#txt_password").keydown(function(e) {
    if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey)) return false;
});

$("#txt_clave_confirm").keydown(function(e) {
    if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey)) return false;
});

///fecha nacimiento

$('.datepicker').pickadate({
  selectMonths: true,
  selectYears: 70,
  max: 10,
  format: 'yyyy-mm-dd',
  labelMonthNext: 'Mes Siguient',
  labelMonthPrev: 'Mes Anterior',
  labelMonthSelect: 'Seleccione un Mes',
  labelYearSelect: 'Seleccione un Año',
  monthsFull: [ 'Enero', 'Febrerp', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Dieciembre' ],
  monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
  weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
  weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
  weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
  today: 'Hoy',
  clear: 'Limpiar',
  close: 'Cerrar'
});

function add_poet(micodigo, poet_codigo){
  $.post("index.php?c=seguidores&a=seguirPoeta",{micodigo:micodigo, poet_codigo:poet_codigo},function(){
      $("#"+poet_codigo).slideUp();
  })
}

function dedicaPoema(codigopoema,codigopoeta){
  $.sweetModal.prompt('Deseas dedicar este poema?, escribe el correo del destinatario', null, null, function(val) {
  $.post("index.php?c=envios&a=dedicatoria",{pub_codigo: codigopoema, poet_codigo: codigopoeta, email: val}, function(confirm){
      $.sweetModal(confirm);
  })

  });
}
// COMBOS DEPENDIENTES

// Carga Departamento
$("#txt-pais").change(function(){
  var pais = $(this).val();

  $("#txt-departamento").prop("disabled", false);
  $.post("cargar-departamento",{idPais:pais}, function(data){
      $("#txt-departamento").html(data);
  });

  $("#txt-ciudad").val($('#txt-ciudad > option:first').val());
  $("#txt-ciudad").prop("disabled", true);

})

// Carga Ciudad
$("#txt-departamento").change(function(){
  var dpto = $(this).val();

  $("#txt-ciudad").prop("disabled", false);
  $.post("cargar-ciudad",{idDpto:dpto}, function(data){
      $("#txt-ciudad").html(data);
  });
})


$(document).ready(function() {
  $('select').material_select();
  // TEXT AREA ENRIQUECIDO CON HTML
  $("#txt_contenido").jqte();

  $("#resultadoBusqueda").html('');
});

function loadToast(message){
 Materialize.toast(message, 4000);

}
// Like o Unlike publicacion
function addLikes(id,action,total) {

   $.post("index.php?c=likes&a=likePublicacion",{pub_codigo : id, accion: action}, function(e){

    if(e == 'like'){
      total = parseInt(total) + 1;
      $("#like-"+id).html('<a  href="javascript:void(0)" onClick="addLikes(\''+id+'\',\'unlike\','+total+')" data-position="top" data-delay="50" data-tooltip="A '+total+' personas les ha gustado este poema"> <i class="fa fa-heart"></i> '+ total +' </a>');
    }else{

      total = parseInt(total) - 1;
      $("#like-"+id).html('<a  href="javascript:void(0)" onClick="addLikes(\''+id+'\',\'like\','+total+')" data-position="top" data-delay="50" data-tooltip="A '+total+' personas les ha gustado este poema"> <i class="fa fa-heart-o"></i> '+ total +'</a>');
    }
  });
}

// Buscador Autocompletar
function buscar() {
    var textoBusqueda = $("input#busqueda").val();
    if (textoBusqueda != "") {
        $.post("index.php?c=publicaciones&a=Buscador", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
        });
    } else {
        ("#resultadoBusqueda").html('');
	};
};

$(document).ready(function(){
   $('.collapsible').collapsible();
 });

 function cambiarEstado(mensaje_codigo){
   $.post("index.php?c=correo&a=correoLeido", {mensaje_id: mensaje_codigo});
 }

 // function buscarCorreo(){
 //     $("#txt_destinatario").autocomplete({
 //
 //     source: "index.php?c=correo&a=buscarCorreo",
 //     minLength: 2,
 //         select: function(event, ui) {
 //         event.preventDefault();
 //         $('#txt_destinatario').val(ui.item.txt_destinatario);
 //         $('#txt_email_para').val(ui.item.txt_email_para);
 //       }
 //   });
 // }
