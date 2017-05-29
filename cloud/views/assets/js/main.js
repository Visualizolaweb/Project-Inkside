var ctrlDown = false, ctrlKey = 17, cmdKey = 91, vKey = 86, cKey = 67;

 $(".button-collapse").sideNav();
 $("#publicaciones").modal();


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
            	icon: $.sweetModal.ICON_SUCCESS
            });
          }else if(result == 1){
            $.sweetModal({
            	content: "La contraseña no es la correcta, por favor verifique nuevamente",
            	icon: $.sweetModal.ICON_SUCCESS
            });
          }else{
            document.location.href="../app/dashboard.php";
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
