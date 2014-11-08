<?php include 'application/views/inc/header.php'; ?>

<section>

  <div class="page-header"><h1>Dashboard <small>Welcome, <?php echo ($user_details->name)?$user_details->name:$this->session->userdata('user_name'); ?></small></h1></div>

  <?php
  echo form_open('user/search', array('class' => 'form-search'));
  ?>
  <div class="alert">
    <p>Please <?php echo anchor('main/info', 'read this', array('target' => '_blank')) ?> before you start using the application.</p>
  </div>
  <div class="input-append">
    <?php
    $arr_search = array(
      'name'          => 'query',
      'id'            => 'query',
      'class'         => 'input-medium',
      'placeholder'   => 'Looking for someone'
      );
    echo form_input($arr_search);
    $arr_button = array(
      'name'      => 'search',
      'type'      => 'submit',
      'class'     => 'btn',
      'content'   => 'Search'
      );
    echo form_button($arr_button);
    ?>
  </div>
  <?php
  echo form_close();
  ?>

  <?php if (!$guest_account_flag): ?>
  <div id="testimonial-approval">
    <h2>Testimonials for approval</h2>
    <?php if (empty($testimonials)): ?>
    <p>No testimonials waiting to be approved by you.</p>
    <?php
    else: ?>
    <ul class="testimonial-list">
      <?php foreach ($testimonials as $testimonial): ?>
      <li class="well well-small">
        <p>
          <?php echo $testimonial->content; ?> <em>by <?php echo anchor('user/profile/'.$testimonial->testimonial_by, $testimonial->name); ?></em>
        </p>
        <div class="btn-group">
          <?php echo anchor('testimonials/make_public/'.$testimonial->idtestimonials, '<i class="icon-eye-open icon-large"></i>', array('class' => 'btn')); ?>
          <?php echo anchor('testimonials/make_private/'.$testimonial->idtestimonials, '<i class="icon-eye-close icon-large"></i>', array('class' => 'btn')); ?>
          <?php echo anchor('testimonials/delete_testimonial/'.$testimonial->idtestimonials, '<i class="icon-trash icon-large"></i>', array('class' => 'btn')); ?>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>

  <div class="row">
    <div class="span6">
      <div class="well">
        <h2>Download Your Testimonials</h2>
        <?php echo anchor('user/export', 'Download', array('class' => 'btn btn-success', 'target' => '_blank')) ?>
      </div>
    </div>

    <div class="span6">
      <div class="well">
        <div>
          <h2>Profile Completeness</h2>
          <?php
          $flag = 0;
          if (!is_null($user_details->id_number))
            $flag++;
          if (!is_null($user_details->name))
            $flag++;
          if (!is_null($user_details->nick))
            $flag++;
          if (!is_null($user_details->dob))
            $flag++;
          if (!is_null($user_details->hostel))
            $flag++;
          if (!is_null($user_details->roomno))
            $flag++;
          if (!is_null($user_details->address))
            $flag++;
          if (!is_null($user_details->contact))
            $flag++;
          if (!is_null($user_details->email))
            $flag++;
          if (!is_null($user_details->image_name))
            $flag++;
          ?>
          <div class="progress progress-striped <?php if ($flag < 5) echo 'progress-warning'; else if ($flag < 10) echo 'progress-info'; else echo 'progress-success'; ?> active">
            <div class="bar" style="width: <?php echo ($flag*10).'%;'; ?>;"></div>
          </div>
          <ul>
            <li><i class="<?php if (!is_null($user_details->id_number)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>ID Number</li>
            <li><i class="<?php if (!is_null($user_details->name)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Name</li>
            <li><i class="<?php if (!is_null($user_details->nick)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Nick</li>
            <li><i class="<?php if (!is_null($user_details->dob)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Date of Birth</li>
            <li><i class="<?php if (!is_null($user_details->hostel)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Hostel</li>
            <li><i class="<?php if (!is_null($user_details->roomno)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Room Number</li>
            <li><i class="<?php if (!is_null($user_details->address)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Address</li>
            <li><i class="<?php if (!is_null($user_details->contact)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Contact</li>
            <li><i class="<?php if (!is_null($user_details->email)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Email</li>
            <li><i class="<?php if (!is_null($user_details->image_name)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Profile Image</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $('#testimonials').load('<?php echo site_url().'testimonials/testimonial_approval/'.$user_details->iduser_details; ?>');
});
</script>

<?php endif; ?>

</section>

<?php include 'application/views/inc/footer.php'; ?>