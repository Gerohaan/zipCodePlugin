<?php 
global $wpdb;


$table = "{$wpdb->prefix}listZip";


if(isset($_POST['btnSend'])){
   
if(empty($_POST['zipCode'])){
    echo '<div class="col-4 alert alert-danger mt-2" role="alert">
    The code is required.
  </div>';
}else{
$zipCode = $_POST['zipCode'];
$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}listZip WHERE zip = '{$zipCode}';")); 
if($count > 0 ){
    echo '<div class="col-6 alert alert-danger mt-2" role="alert">
    The code you are trying to register is already in the database.
  </div>';
}else{
    $data = [
        'id' => null,
        'zip' => $zipCode
      ];
      $response =  $wpdb->insert($table,$data);
    
}
}
}

if(isset($_POST['delete'])){
    $id = $_POST['zipID'];
    $wpdb->delete( $table, array( 'id' => $id ) );
}


$query = "SELECT * FROM {$wpdb->prefix}listZip";
$zipCodeList = $wpdb->get_results($query, ARRAY_A); 
if(empty($zipCodeList)){
    $zipCodeList = array();
}
?>
<div class="wrap">
<?php 
//echo "<h1 class='wp-heading-inline'>".get_admin_page_title()."</h1>";
echo "<h1 class='wp-heading-inline'>Zip code list</h1>"
?>
<a id="btnNew" class="page-title-action">Add</a>
<br><br><br>
<span class="error invalid-feedback"> <?php if(isset($_POST['btnSend']) && empty($_POST['name']) ) echo "Nombre es requerido";?></span>
<table class="wp-list-table widefat fixed striped pages">
    <thead>
        <th> Zip Code</th>
        <th align="right"></th>
    </thead>
    <tbody id="the-list">
        <?php foreach ($zipCodeList as $key => $value) { ?>
        <tr>
            <td><?php echo $value['zip'] ?> </td>
            <td align="right">
            <form action="" method="POST">
            <input type="hidden" name="zipID" value="<?php echo $value['id'] ?>">
            <button type="submit" class="btn btn-danger btn-sm" id="delete" name="delete">Delete</button>
            </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>


<!-- Modal Create -->
<div class="modal fade" id="modalNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter zip code</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="modal-body">
    <form method="post"  name="formZip" id="formZip">
        <div class="form-group">
            <label for="name" class="txt_negrita">Zip Code</label>
            <input value="<?php if (!empty($_POST["zipCode"])) {echo $name; }else {echo "";}?>" require type="text" class="form-control" name="zipCode" id="zipCode" aria-describedby="zipCodeHelp">
            <small id="zipCodeHelp" class="form-text text-muted"></small>
        </div>
        <!-- Mensajes de Validación -->
        <div class="msg mt-3 mb-3"></div>
        <div align="right">
            <button type="submit" class="btn btn-primary" id="btnSend" name="btnSend">Send</button>
        </div>
    </form>
    </div>
  </div>
</div>
<!-- Modal -->

