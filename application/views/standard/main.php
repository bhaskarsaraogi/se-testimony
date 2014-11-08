<?php include 'application/views/inc/header.php'; ?>

<section>

  <div class="hero-unit">
    <div class="page-header"><h1>Melange</h1></div>
    <p>This is the testimonial server for <strong><?php echo $this->session->userdata('site_name'); ?></strong>.</p>
    <p>A total of <strong><?php echo $testimonial_count; ?></strong> testimonials have been written by <strong><?php echo $user_count; ?></strong> users!</p>
  </div>

</section>

<?php include 'application/views/inc/footer.php'; ?>