

  <?php include_once("website/views/include/scop-footer.php"); ?>
  <script type="text/javascript" src="website/views/assets/js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="website/views/assets/materialize/js/materialize.min.js"></script>
  <script type="text/javascript" src="website/views/assets/js/parsley/dist/parsley.min.js"></script>
  <script type="text/javascript" src="website/views/assets/js/parsley/dist/i18n/es.js"></script>
  <script type="text/javascript" src="website/views/assets/js/main.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
       $('select').material_select();
       $('.modal').modal();
       $('.slider').slider({
         indicators: false,
         transition: 200,
         height: 450,
         interval: 3500
       });
    });
  </script>
  </body>
</html>
