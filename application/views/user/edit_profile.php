<?php include 'application/views/inc/header.php'; ?>

<section>
  
  <div class="page-header"><h1>Edit Profile <small>You can edit your profile here</small></h1></div>
  
  <div class="well well-large">
    <h2>Your Personal Details</h2>
    <?php echo form_open_multipart('user/edit_profile', array('class' => 'form-horizontal')); ?>
    <div class="control-group">
      <?php echo form_label('ID Number', 'id_number', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_id_number = array(
            'name'          => 'id_number',
            'id'            => 'id_number',
            'class'         => 'span3',
            'placeholder'   => 'Please enter your college ID number here',
            'value'         => set_value('id_number', $id_number)
            );
          echo form_input($arr_id_number);
          ?>
          <p class="help-block"><em>We know that we had asked for your ID number beforehand, but please bear with us.</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Full Name', 'fullName', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_name = array(
            'name'          => 'fullName',
            'id'            => 'fullName',
            'class'         => 'span3',
            'placeholder'   => 'Your full name here',
            'value'         => set_value('fullName', $fullName)
            );
          echo form_input($arr_name);
          ?>
          <p class="help-block"><em>Your real name comes here</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Nick', 'nickName', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_nickname = array(
            'name'          => 'nickName',
            'id'            => 'nickName',
            'class'         => 'span3',
            'placeholder'   => 'Your nick name here',
            'value'         => set_value('nickName', $nickName)
            );
          echo form_input($arr_nickname);
          ?>
          <p class="help-block"><em>What do your friends call you? Or maybe what are you called on DC?</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Date', 'date', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_date = array(
            'name'          => 'date',
            'id'            => 'date',
            'class'         => 'span1',
            'value'         => set_value('date', $date)
            );
          echo form_input($arr_date);
          ?>
          <p class="help-block"><em>Date of your birth</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Month', 'month', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_month = array(
            'January'     => 'January',
            'February'    => 'February',
            'March'       => 'March',
            'April'       => 'April',
            'May'         => 'May',
            'June'        => 'June',
            'July'        => 'July',
            'August'      => 'August',
            'September'   => 'September',
            'October'     => 'October',
            'November'    => 'November',
            'December'    => 'December'
            );
          echo form_dropdown('month', $arr_month, $month, 'class = "span3"');
          ?>
          <p class="help-block"><em>Month of your birth</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Year', 'year', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_year = array(
            'name'          => 'year',
            'id'            => 'year',
            'class'         => 'span1',
            'value'         => set_value('year', $year)
            );
          echo form_input($arr_year);
          ?>
          <p class="help-block"><em>Year of your birth</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Hostel', 'hostel', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $hostel_options = array(
            'AH1'  => 'AH1',
            'AH2'  => 'AH2',
            'AH3'  => 'AH3',
            'AH4'  => 'AH4',
            'AH5'  => 'AH5',
            'AH6'  => 'AH6',
            'AH7'  => 'AH7',
            'AH8'  => 'AH8',
            'CH1'  => 'CH1',
            'CH2'  => 'CH2',
            'CH3'  => 'CH3',
            'CH4'  => 'CH4',
            'CH5'  => 'CH5',
            'CH6'  => 'CH6'
            );
          echo form_dropdown('hostel', $hostel_options, $hostel, 'class = "span3"');
          ?>
          <p class="help-block"><em>Which hostel did you live in?</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Room Number', 'roomno', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_roomno = array(
            'name'          => 'roomno',
            'id'            => 'roomno',
            'class'         => 'span3',
            'placeholder'   => 'Your hostel room number here',
            'value'         => set_value('roomno', $roomno)
            );
          echo form_input($arr_roomno);
          ?>
          <p class="help-block"><em>The room number of your beloved room</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Address', 'address', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_address = array(
            'name'          => 'address',
            'id'            => 'address',
            'class'         => 'span3',
            'rows'          => '4',
            'placeholder'   => 'Your address here',
            'value'         => set_value('address', $address)
            );
          echo form_textarea($arr_address);
          ?>
          <p class="help-block"><em>Where do you actually stay?</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Contact Number', 'contact', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_contact = array(
            'name'          => 'contact',
            'id'            => 'contact',
            'class'         => 'span3',
            'placeholder'   => 'Your contact number here',
            'value'         => set_value('contact', $contact)
            );
          echo form_input($arr_contact);
          ?>
          <p class="help-block"><em>It would be great if we can have your number</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Email', 'email', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_email = array(
            'name'          => 'email',
            'id'            => 'email',
            'class'         => 'span3',
            'placeholder'   => 'Your email here',
            'value'         => set_value('email', $email)
            );
          echo form_input($arr_email);
          ?>
          <p class="help-block"><em>Your email address will be greatly appreciated</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Profile Image', 'profile_image', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_image = array(
            'name'          => 'profile_image',
            'id'            => 'profile_image',
            'class'         => 'span3'
            );
          echo form_upload($arr_image);
          ?>
          <p class="help-block"><em>Maximum allowed dimensions are 1024px &times; 768px</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <?php
        $arr_button = array(
          'name'  => 'submit',
          'value' => 'Update Info',
          'class' => 'btn btn-info span3'
          );
        echo form_submit($arr_button);
        ?>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
  <?php
  if ( $error != NULL )
    echo '<div class="alert alert-error">'. $error.' </div>';
  echo validation_errors();
  ?>
  
  <div class="well well-large">
    <h2>Change Your Password</h2>
    <?php echo form_open('user/change_password', array('class' => 'form-horizontal')); ?>
    <div class="control-group">
      <?php echo form_label('New Password', 'password', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_password = array(
            'name'          => 'password',
            'id'            => 'password',
            'class'         => 'span3'
            );
          echo form_password($arr_password);
          ?>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Confirm New Password', 'passconf', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_passconf = array(
            'name'          => 'passconf',
            'id'            => 'passconf',
            'class'         => 'span3'
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
          'value' => 'Update Password',
          'class' => 'btn btn-info span3'
          );
        echo form_submit($arr_button);
        ?>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
  
</section>

<?php include 'application/views/inc/footer.php'; ?>