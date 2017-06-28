 $(".button-collapse").sideNav();
 $("#publicaciones").modal();
 $('select').material_select();
 $('.modal').modal();
 $('.slider').slider({
   indicators: false,
   transition: 200,
   height: 500,
   interval: 3500
 });
$('ul.tabs').tabs();

 $("#registroPoeta").submit(function(e) {
        e.preventDefault();

        jsonObj = [];
        $("input[class=fieldBD]").each(function(){
            structure = {}
            structure = $(this).val();
            jsonObj.push(structure);
        });

        $("#signup").html('<div class="loader"><div class="dot dot1"></div><div class="dot dot2"></div><div class="dot dot3"></div><div class="dot dot4"></div></div>');

        $.post("cloud/registro-poeta",{data: jsonObj}, function(result){
              var result = JSON.parse(result);
              swal("", result[1], "success")
              $("input").val("");
              $("#signup").html("Registra otro poeta!")
              // $("input[class=fieldBD]").val("");
        });
});

// VALIDACION DEL CORREO QUE NO EXISTA EN LA BASE DE DATOS
$("#registroPoeta #txt_email").focusout(function(){
    $("#txt_email").siblings("ul").remove();
    $.post("cloud/valido-email",{data: $("#txt_email").val()}, function(result){
      var result = JSON.parse(result);
          if(result[0] == 0){
             $("#txt_email").after("<ul class='parsley-errors-list filled'><li class='parsley-required'>"+result[1]+"</li></ul>");
             $("#signup").prop("disabled",true);
           }else{
             $("#signup").prop("disabled",false);
           }
    });
});

function dedicatoria(){
   $("#modal1").modal("open");

}


function followPoet(){
  $("#modalFollow").modal('open');
}

$("#frmDedicatoria").submit(function(e) {
       e.preventDefault();

       jsonObj = [];
       $("input[class=fieldBD]").each(function(){
           structure = {}
           structure = $(this).val();
           jsonObj.push(structure);
       });

       $("#enviarDedicatoria").html('<div class="loader"><div class="dot dot1"></div><div class="dot dot2"></div><div class="dot dot3"></div><div class="dot dot4"></div></div>');

       $.post("dedicoPoema",{data: jsonObj}, function(result){
             var result = JSON.parse(result);
             $("#modal1").modal("close");
             if(result[0] == 1){
               swal("", result[1], "success");
             }else{
               swal("", result[1], "error");
             }
             $("input[class=fieldBD]").val("");
             $("#enviarDedicatoria").html('Enviar Dedicatoria');

       });
});

$("#btnGlobalSearch").click(function(){
  var filter = $("#txt-search").val();
  if(filter!=""){
    document.location.href="buscar-"+filter;
  }
});

$("#txt-search").keyup(function(e) {
    if(e.keyCode == 13) {
      var filter = $("#txt-search").val();
      if(filter!=""){
        document.location.href="buscar-"+filter;
      }
    }
  });
