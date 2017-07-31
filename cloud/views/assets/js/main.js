$(window).load(function() {
   $('.preloader').fadeOut('slow');
    $('body').css({'overflow':'visible'});
 })

 var ctrlDown = false, ctrlKey = 17, cmdKey = 91, vKey = 86, cKey = 67;

 $(".button-collapse").sideNav();
 $('.collapsible').collapsible();
 $("#publicaciones").modal();
 $("#recordar").modal();
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

function seguir_poeta(micodigo, poet_codigo){
  $.post("index.php?c=seguidores&a=seguirPoeta",{micodigo:micodigo, poet_codigo:poet_codigo},function(){

      $(".btnseguirpoeta").addClass("blue-grey lighten-3");
      $(".btnseguirpoeta").html("Dejar de Seguir");
      $(".btnseguirpoeta").attr('onclick',"nosigo('"+micodigo+"','"+poet_codigo+"')");
  })
}

function nosigo(micodigo, poet_codigo){
   $.post("index.php?c=seguidores&a=noseguirPoeta",{micodigo:micodigo, poet_codigo:poet_codigo},function(){

      $(".btnseguirpoeta").removeClass("blue-grey lighten-3");
      $(".btnseguirpoeta").addClass(" teal accent-4");
      $(".btnseguirpoeta").html("+ Seguir Poeta");
      $(".btnseguirpoeta").attr('onclick',"seguir_poeta('"+micodigo+"','"+poet_codigo+"')");
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
  $("#txt_contenido").jqte({
      b:false,
      color:false,
      fsize: false,
      formats: false,
      i: false,
      u: false,
      p: false,
      remove: false,
      source: false,
      sub: false,
      strike: false,
      sup: false,
      outdent: false,
      indent: false,
      rule: false
  });

  $("#btnBuscarFiltro").click(function(){
    $("#frmBuscar").submit();
  });

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

$(document).ready(function(){
   $('.collapsible').collapsible();
   $('.tooltipped').tooltip({delay: 50});
   $('ul.tabs').tabs();
 });

 function cambiarEstado(mensaje_codigo){
   $.post("index.php?c=correo&a=correoLeido", {mensaje_id: mensaje_codigo},function(data){
        $("#"+mensaje_codigo+" .unread").removeClass("unread");
        $("#"+mensaje_codigo+" i").removeClass("fa-envelope-o");
        $("#"+mensaje_codigo+" i").addClass("fa-envelope-open-o");
   });
 }


 $('#uploadImage').modal({
    dismissible: true,
    opacity: .8,
    startingTop: '5%',
    endingTop: '5%'
 });

 $uploadCrop = $('#wrap-upload').croppie({
     enableExif: true,
     viewport: {
         width: 180,
         height: 180
     },
     boundary: {
         width: 240,
         height: 240
     }
 });

 $('#upload').on('change', function () {
   var reader = new FileReader();
     reader.onload = function (e) {
       $uploadCrop.croppie('bind', {
         url: e.target.result
       }).then(function(){
         console.log('jQuery bind complete');
       });

     }
     reader.readAsDataURL(this.files[0]);
 });

 $('.upload-result').on('click', function (ev) {


   var file = $("#upload").val();

   if(file != ""){
   $uploadCrop.croppie('result', {
     type: 'canvas',
     size: 'viewport'
   }).then(function (resp) {

     $.ajax({
       url: "index.php?c=poetas&a=updateAvatar",
       type: "POST",
       data: {"image":resp, "code":$("#poetCodigo").val()},
       success: function (data) {
         html = '<img src="' + resp + '" />';
         $('.modal').modal('close');
         $("#wrap-result").html(html);
         $("header .profile img").attr("src",resp);
       }
     });
   });
 }
 });
