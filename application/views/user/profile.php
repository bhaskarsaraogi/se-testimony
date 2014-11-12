<?php include 'application/views/inc/header.php'; ?>

<?php if ($user_details) { ?>

<section>

  <div class="page-header"><h1><?php echo $user_details->name; ?> <small>User Profile</small></h1></div>

  <div class="profile well">

    <?php if ($user_details->image_thumb) { ?>
    <figure class="pull-right">
      <img class="thumbnail" src="<?php echo site_url().'uploads/'.$user_details->image_thumb; ?>" alt="<?php echo $user_details->name.'\'s Photograph' ?>" />
    </figure>
    <?php } ?>

    <dl>
      <dt>ID Number</dt>
      <dd><?php echo $user_details->id_number; ?></dd>
      <dt>Name</dt>
      <dd><?php echo $user_details->name; ?></dd>
      <dt>Nick</dt>
      <dd><?php echo $user_details->nick; ?></dd>
      <dt>Date of Birth</dt>
      <dd><?php echo $user_details->dob; ?></dd>
      <dt>Hostel</dt>
      <dd><?php echo $user_details->hostel; ?></dd>
      <dt>Room Number</dt>
      <dd><?php echo $user_details->roomno; ?></dd>
      <dt>Address</dt>
      <dd><?php echo $user_details->address; ?></dd>
      <dt>Contact Number</dt>
      <dd><?php echo $user_details->contact; ?></dd>
      <dt>Email</dt>
      <dd><?php echo $user_details->email; ?></dd>
    </dl>
    <?php if (!$add_testimonial_flag) { ?>
    <p><?php echo anchor('user/edit_profile', 'Edit Your Profile', array('class' => 'btn btn-info')); ?></p>
    <?php } ?>
  </div>

  <div id="testimonials" class="span8">
    <?php if (empty($testimonials)) { ?>
    <p>No testimonials found.</p>
    <?php
  }
  else { ?>
  <ul class="testimonial-list">
    <?php foreach ($testimonials as $testimonial) {?>
    <li class="well">
      <p><?php echo $testimonial->content; ?></p>
      <p class="written-by">&ndash;&nbsp;<?php echo anchor('user/profile/'.$testimonial->testimonial_by, $testimonial->name); ?></p>
    </li>
    <?php } ?>
  </ul>
  <?php } ?>
</div>
<?php if ($add_testimonial_flag) { ?>
<div id="add_testimonial" class="span8">
  <?php
  echo form_open('testimonials/add_testimonial/'.$to_id);
  ?>
  <div class="control-group">
    <div class="controls">
      <?php
      $arr_testimonial = array(
        'name'          => 'testimonial_content',
        'id'            => 'testimonial_contet',
        'class'         => 'span6',
        'rows'          => '6',
        'placeholder'   => 'Add your testimonial'
        );
      echo form_textarea($arr_testimonial);
      ?>
    </div>
    <div class="control-group">
      <div class="controls">
        <?php
        $arr_button = array(
          'name'  => 'submit',
          'value' => 'Add',
          'class' => 'btn btn-info span6'
          );
        echo form_submit($arr_button);
        echo form_close();
        ?>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
</section>

<?php } else { ?>
<div class="alert">
  <p>Sorry, User does not exist.</p>
  <p>Please search for someone else.</p>
  <?php echo anchor('user/dashboard', 'Return to dashboard'); ?>
</div>
<?php } ?>

<?php include 'application/views/inc/footer.php'; ?>