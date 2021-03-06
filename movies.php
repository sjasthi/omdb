<?php

  $nav_selected = "MOVIES"; 
  $left_buttons = "YES"; 
  $left_selected = "MOVIES"; 

  include("./nav.php");
  global $db;
  
  ?>


<div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">Movies -> Movies List</h3>

    <button><a class="btn btn-sm" href="create_movie.php">Create a Movie</a></button>

<br>

        <table id="info" cellpadding="0" cellspacing="0" border="0"
            class="datatable table table-striped table-bordered datatable-style table-hover"
            width="100%" style="width: 100px;">
              <thead>
                <tr id="table-first-row">
                        <th>id</th>
                        <th>Native Name</th>
                        <th>English Name</th>
                        <th>Year </th>
                        <th> Actions </th>
                </tr>
              </thead>

              <tbody>

              <?php

$sql = "SELECT * from movies ORDER BY year_made ASC;";

$db->set_charset("utf8");

$result = $db->query($sql);
                header('Content-type: text/html; charset=utf-8');
                if(isset($_GET['create'])){
                           if($_GET["create"] == "Success"){
                               echo '<br><h3>Success! Your movie has been added!</h3>';
                           }
                       }
                  

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td>'.$row["movie_id"].'</td>
                                <td>'.$row["native_name"].' </span> </td>
                                <td>'.$row["english_name"].'</td>
                                <td>'.$row["year_made"].'</td>
                                <td><a class="btn btn-info btn-sm" href="movie_info.php?movie_id='.$row["movie_id"].'">View</a>
                                    <a class="btn btn-warning btn-sm" href="modify_movie.php?movie_id='.$row["movie_id"].'">Modify</a>
                                    <a class="btn btn-danger btn-sm" href="delete_movie.php?movie_id='.$row["movie_id"].'">Delete</a>
                                    <a class="btn btn-success btn-sm" href="add_song.php?movie_id='.$row["movie_id"].'">Add Song</a>
                                    <a class="btn btn-default btn-sm" href="create_Data.php?movie_id='.$row["movie_id"].'">Create Data</a></td>

                            </tr>';
                    }//end while
                }//end if
                else {
                    echo "0 results";
                }//end else

                 $result->close();
                ?>

              </tbody>
        </table>


        <script type="text/javascript" language="javascript">
    $(document).ready( function () {
        
        $('#info').DataTable( {
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: 'lfrtBip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );

        $('#info thead tr').clone(true).appendTo( '#info thead' );
        $('#info thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    
        var table = $('#info').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

</script>

        

 <style>
   tfoot {
     display: table-header-group;
   }
 </style>

  <?php include("./footer.php"); ?>
