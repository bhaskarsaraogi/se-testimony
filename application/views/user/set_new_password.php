<?php include 'application/views/inc/header.php'; ?>

<section>

  <div class="page-header"><h1>Set New Password</h1></div>
  
  <?php    
  echo form_open('user/set_new_password', array('class' => 'form-horizontal'));
  ?>
  <div class="control-group">
    <div class="controls">
      <div class="input-prepend">
        <span class="add-on"><i class="icon-key icon-large"></i></span>
        <?php        
        $arr_password = array(
          'name'          => 'password',
          'id'            => 'password',
          'class'         => 'span3',
          'placeholder'   => 'Password',
          'value'         => set_value('password')
          );
        echo form_password($arr_password);
        ?>
      </div>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <div class="input-prepend">
        <span class="add-on"><i class="icon-key icon-large"></i></span>
        <?php        
        $arr_passconf = array(
          'name'          => 'passconf',
          'id'            => 'passconf',
          'class'         => 'span3',
          'placeholder'   => 'Confirm Password',
          'value'         => set_value('passconf')
          );
        echo form_password($arr_passconf);
        ?>
      </div>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <?php
      $arr_button = array(
        'name'  => 'submit',
        'value' => 'Set New Password',
        'class' => 'btn btn-info span3'
        );
      echo form_submit($arr_button);
      ?>
    </div>
  </div>
  <?php
  echo form_close();
  if ( $error != NULL )
    echo '<div class="alert alert-error">'. $error.' </div>';
  echo validation_errors();
  ?>
</section>

<?php include 'application/views/inc/footer.php'; ?>