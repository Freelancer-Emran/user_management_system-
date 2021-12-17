    
    <!-- Jquery link -->
    <script src="assets/js/jqueryPlugin/jquery-3.5.1.min.js"></script>

    <!-- bootstrap js links -->
    <script type="text/javascript" src="assets/js/bootstrap-5/bootstrap.bundle.min.js"></script>

    <!-- data tables js link -->
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>

    <!-- sweetalert2 -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="assets/sweetalert2@11/add_sweetalert2@11/sweetalert2.all.min.js"></script>

    <!-- custom script  -->
    <script type="text/javascript">
      // tooltip js
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl){
        return new bootstrap.Tooltip(tooltipTriggerEl)
      });

      // data tables js
      $(document).ready( function () {

        // add new note ajax request
        $("#addNoteBtn").click(function(e){
          if($("#add-note-form")[0].checkValidity()){
            e.preventDefault();

            $("#addNoteBtn").val("Please Wait...");

            $.ajax({
              url : 'assets/php/process.php',
              method : 'post',
              data : $("#add-note-form").serialize()+'&action=add_note',
              success : function(response){
                $("#addNoteBtn").val("Add Note");
                $("#add-note-form")[0].reset();
                $("#addNoteModal").modal('hide');

                // sweetalert2
                Swal.fire(
                  'Note added successfully!',
                  '',
                  'success'
                )
                displayAllNotes();
              }
            });
          }
        });

        // display all note ajax of an user
        function displayAllNotes(){
          $.ajax({
            url : 'assets/php/process.php',
            method : 'post',
            data : { action : 'display_notes' },
            success : function (response){
              $("#showNote").html(response);
              $('table').DataTable({
                order: [0, 'desc']
              });
            }
          });
        }

        displayAllNotes();

      });
    </script>
    
</body>
</html>