
<?php include("header.php");?>

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<!-- Bootstrap -->
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>
body { background-color:#fafafa; font-family:'Open Sans';}
.container { margin:150px auto;}
    .treegrid-indent {
        width: 0px;
        height: 16px;
        display: inline-block;
        position: relative;
    }

    .treegrid-expander {
        width: 0px;
        height: 16px;
        display: inline-block;
        position: relative;
        left:-17px;
        cursor: pointer;
    }
</style>

<?php 
$sql = "SELECT * FROM st_group ORDER BY gid";
$result = dbQuery($sql);

?>

<div class="container">
  <table id="tree-table" class="table table-hover table-bordered">
    <thead>
        <th>#</th>
        <th>Test</th>
    </thead>
    <tbody>
        <?php  
     
            while ($row1 = dbFetchArray($result)) {?>
                <tr data-id ="1" data-parent="0" data-level="1">
                    <td data-column="name"><?=$row1['gnumber'];?></td>
                    <td><?=$row1['gname'];?></td>
                </tr>
            <?php  
                $sql2 = "SELECT * FROM st_class WHERE gid = $row1[gid]";
                $result2 = dbQuery($sql2);
                $numrow = dbNumRows($result2);

                if($numrow != 0){
                    while ($row2 = dbFetchArray($result2)) {?>
                      <tr data-id="2" data-parent="1" data-level="2">
                        <td data-column="name"><?=$row2['cnumber'];?></td>
                        <td><?=$row2['cname'];?></td>
                     </tr> 

                    <?php    
                 
                   
                    }  //end while
                }   //end if
            }  // end while
            ?>
      </tbody>
  </table>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<script src="js/javascript.js"></script>

</body>
</html>