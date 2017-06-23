 $(".button-collapse").sideNav();
 $("#publicaciones").modal();
 $('select').material_select();
 $('.modal').modal();
 $('.slider').slider({
   indicators: false,
   transition: 200,
   height: 450,
   interval: 3500
 });

 
 $("#registroPoeta").submit(function(e) {
        e.preventDefault();

        jsonObj = [];
        $("input[class=fieldBD]").each(function(){
            structure = {}
            structure = $(this).val();
            jsonObj.push(structure);
        });

        $.post("cloud/registro-poeta",{data: jsonObj}, function(result){
              var result = JSON.parse(result);
              alert(result[1]);
              // $("input[class=fieldBD]").val("");
        });
});
