 $(".button-collapse").sideNav();
 $("#publicaciones").modal();

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
