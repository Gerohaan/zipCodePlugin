<?php

function input_search() {
   
    ?>
    <div class="border border-primary p-4 rounded">
    <form method="POST" action="">
        <!-- <label class="text-bold text-primary" for="zipCode">Enter Your ZIP Code:</label> -->
        <div class="input-group mb-3">
          <input required type="text" class="form-control" name="zipCode" id="zipCode" placeholder="Search zip..." aria-label="Search zip..." aria-describedby="button-addon2">
          <input class="btn btn-outline-secondary text-white bg-primary" value="Search" type="submit" id="button-addon2"></input>
        </div>
        <!-- <input type="text" name="zipCode" id="zipCode" class="form-control" required>
         <div class="mt-4">
         <input class="form-control text-white bg-primary" color="primary" type="submit" value="Search" class="btn btn-primary">
         </div>  -->
    </form>
    </div>
    <?php
}

function searhCapture() {
    global $wpdb;
    $table = "{$wpdb->prefix}listZip";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $zipCode = $_POST['zipCode'];
        // Validar los campos
        if (empty($zipCode)) {
            echo '<div class="col-4 alert alert-danger mt-2" role="alert">
            The code is empty.
          </div>';
        }else{
            $count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}listZip WHERE zip = '{$zipCode}';"));
            if($count == 0 ){
                echo '<div class="col-6 alert alert-danger mt-2" role="alert">
                There is no coverage in this ZIP CODE.
              </div>';
            }else{
            wp_redirect(home_url('/contacto'));
            echo '<div class="col-6 alert alert-success mt-2" role="alert">
                Coverage available in this ZIP CODE.
              </div>';
                
            }
        }
    }
}

function formHtml(){
  ?>
    <div class="border border-primary p-4 rounded">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label class="text-bold text-primary" for="description">Description <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="description" id="description" placeholder="Enter a description">
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="company">Company Name <span class="text-danger">*</span></label>
                <input required type="text" name="company" class="form-control" id="company" placeholder="Enter the company name">
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="product">Product <span class="text-danger">*</span></label>
                <select required class="form-control" name="product" id="product" placeholder="Enter the product name">
                    <option value="Dia">Dia</option>
                    <option value="Fiber">Fiber</option>
                    <option value="Broadband">Broadband</option>
                    <option value="SIP/PBX/Broadband services">SIP/PBX/Broadband services</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="contact">Site Contact <span class="text-danger">*</span></label>
                <input required type="text" class="form-control" name="contact" id="contact" placeholder="Enter the contact person's name">
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="dispatch">Dispatch Type <span class="text-danger">*</span></label>
                <select required class="form-control" name="dispatch" id="dispatch">
                    <option value="Site Survey">Site Survey</option>
                    <option value="Dmarc Extension">Dmarc Extension</option>
                    <option value="Test and turn up">Test and turn up</option>
                    <option value="Fiber and broadband circuit">Fiber and broadband circuit</option>
                    <option value="extension">extension</option>
                    <option value="Rack install">Rack install</option>
                    <option value="Wirless">Wirless</option>
                    <option value="SDWAN">SDWAN</option>
                    <option value="Cable run">Cable run</option>
                    <option value="Hosted phones">Hosted phones</option>
                    <option value="other">other</option>
                </select>
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="phone">Phone <span class="text-danger">*</span></label>
                <input required type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone number">
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="reference"># Reference <span class="text-danger">*</span></label>
                <input required type="text" class="form-control" name="reference" id="reference" placeholder="Enter the reference number">
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="address">Address <span class="text-danger">*</span></label>
                <input required type="text" class="form-control" name="address" id="address" placeholder="Enter your address">
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="city">City <span class="text-danger">*</span></label>
                <input required type="text" class="form-control" name="city" id="city" placeholder="Enter your city">
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="state">State <span class="text-danger">*</span></label>
                <input required type="text" class="form-control" name="state" id="state" placeholder="Enter your state">
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="zip">Zip Code <span class="text-danger">*</span></label>
                <input required type="text" class="form-control" name="zip" id="zip" placeholder="Enter your zip code">
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="dispatchDate">Dispatch Date <span class="text-danger">*</span></label>
                <input required type="date" class="form-control" name="dispatchDate" id="dispatchDate">
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="notificationEmail">Notification Email <span class="text-danger">*</span></label>
                <input required type="email" class="form-control" name="notificationEmail" id="notificationEmail" placeholder="Enter your email">
            </div>
            <div class="form-group mt-2">
                <label class="text-bold text-primary" for="fullDescription">Full Description <span class="text-danger">*</span></label>
                <textarea required class="form-control" id="fullDescription" name="fullDescription" rows="5" placeholder="Enter a full description"></textarea>
            </div>
            <div class="form-group mt-3">
                <label class="text-bold text-primary" for="attachment">Attach File</label>
                <input type="file"  accept=".jpg,.jpeg,.png,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"  class="form-control-file" name="attachment" id="attachment">
            </div>
            <div class="form-group mt-2" align="right">
              <input style="background-color: #0d6efd; color: white;" type="submit" name="submit_form" value="Submit" class="btn btn-primary"></input>
            </div>
          </form>
    </div>
  <?php
}


// Shortcode function para el formulario de búsqueda
function search_zip_shortcode($atts) {
  ob_start(); // Iniciar el almacenamiento en búfer de salida

  // Verificar si se envió el formulario de búsqueda
  if (isset($_POST['zipCode'])) {
      $zip_code = sanitize_text_field($_POST['zipCode']);

      // Realizar la búsqueda en la base de datos
      $result = search_zip_code($zip_code);

      // Verificar si se encontró el código ZIP
      if ($result) {
          // Mostrar el formulario con los campos especificados
         
          echo '<div class="col-6 alert alert-success mt-2" role="alert">
              Coverage available in this ZIP CODE.
            </div>';
            input_search();
            echo "<br>";
            formHtml();
      } else {
          
          echo '<div class="col-6 alert alert-danger mt-2" role="alert">
          There is no coverage in this ZIP CODE.
        </div>';
        input_search();
      }
  } else {
      // Mostrar el formulario de búsqueda
      input_search();
  }
  if (isset($_POST['submit_form'])){
    $description = sanitize_text_field($_POST['description']);
    $company = sanitize_text_field($_POST['company']);
    $product = sanitize_text_field($_POST['product']);
    $contact = sanitize_text_field($_POST['contact']);
    $dispatch = sanitize_text_field($_POST['dispatch']);
    $phone = sanitize_text_field($_POST['phone']);
    $reference = sanitize_text_field($_POST['reference']);
    $address = sanitize_text_field($_POST['address']);
    $city = sanitize_text_field($_POST['city']);
    $state = sanitize_text_field($_POST['state']);
    $zip = sanitize_text_field($_POST['zip']);
    $dispatchDate = sanitize_text_field($_POST['dispatchDate']);
    $notificationEmail = sanitize_email($_POST['notificationEmail']);
    $fullDescription = sanitize_textarea_field($_POST['fullDescription']);
    $attachment = $_FILES['attachment'];

    $to = 'gero.delfin@gmail.com';
    $subject = 'Request Dispatch';
    $body = "description: $description\n";
    $body .= "company: $company\n";
    $body .= "product: $product\n";
    $body .= "contact: $contact\n";
    $body .= "dispatch: $dispatch\n";
    $body .= "phone: $phone\n";
    $body .= "reference: $reference\n";
    $body .= "address: $address\n";
    $body .= "city: $city\n";
    $body .= "state: $state\n";
    $body .= "zip: $zip\n";
    $body .= "dispatchDate: $dispatchDate\n";
    $body .= "notificationEmail: $notificationEmail\n";
    $body .= "fullDescription: $fullDescription\n";
    // Adjuntar el archivo
    if (isset($attachment) && $attachment['error'] == 0) {
       /*  $file_path = $attachment['tmp_name'];
        $file_name = basename($attachment['name']);
        $file_type = $attachment['type'];

        $attachments = array($file_path); */

        $uploads_dir = wp_upload_dir();
        $target_dir = $uploads_dir['path'];
        $nombre_archivo = uniqid() . '_' . $_FILES['attachment']['name'];
        $target_path = $target_dir . '/' . $nombre_archivo;
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_path)) {
            $attachments = array($target_path);
            // Agregar el archivo adjunto al correo
            add_filter('wp_mail_content_type', 'set_html_content_type');
            $sent = wp_mail($to, $subject, $body, '', $attachments);
            remove_filter('wp_mail_content_type', 'set_html_content_type');
        }else{
            '<div class="col-6 alert alert-danger mt-2" role="alert">
                Error moving file.
            </div>';
        }
    } else {
        // Enviar el correo sin adjunto
        $sent = wp_mail($to, $subject, $body);
    }
   
    if ($sent) {
        echo '<div class="col-6 alert alert-success mt-2" role="alert">
        ¡The request has been sent successfully!
              </div>';
    } else {
        echo '<div class="col-6 alert alert-danger mt-2" role="alert">
                There was an error submitting the request. Please try again.
          </div>';
    }
  }

  return ob_get_clean(); // Devolver el contenido del búfer de salida
}

// Función para buscar el código ZIP en la base de datos
function search_zip_code($zip_code) {
  global $wpdb;
  $table = "{$wpdb->prefix}listZip";

  $count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}listZip WHERE zip = '{$zip_code}';"));
  if($count == 1 ){
      return true;
  }else{
      return false;
  }
}
        
   
?>