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
  selectMonths: true, // Creates a dropdown to control month
  selectYears: 17 // Creates a dropdown of 15 years to control year
});
