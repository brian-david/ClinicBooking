<?php
  function logout(){
    session_destroy();
  }
?>

<script>
  $(function(){
    $(".dropdown-trigger").dropdown({ hover: false, coverTrigger : false});
    $('.modal').modal();
    $('.fixed-action-btn').floatingActionButton();
    $('select').formSelect();
    $('.datepicker').datepicker();
  });
</script>

<!-- DROPDOWN CONTENT -->
<ul id="profile-dropdown" class="dropdown-content">
  <li><a href="../pages/userPage.php">Profile Settings</a></li>
  <li class="divider"></li>
  <li><a href="../fragments/logout.php">Logout</a></li>
</ul>

<nav class="cyan darken-3">
  <div class="nav-wrapper">
    <a href="#" class="brand-logo center">Clinic Admin</a>
    <ul id="nav-mobile" class="left hide-on-med-and-down">
      <?php if ($self == '/clinic/pages/appointments.php') { ?>
      <li class="active"><a href="appointments.php">Appointments</a></li>
        <?php } else { ?>
      <li><a href="appointments.php">Appointments</a></li>
        <?php } ?>

      <?php
        if ($self == '/clinic/pages/docs.php') { ?>
          <li class="active"><a href="docs.php">Doctors</a></li>
        <?php } else { ?>
          <li><a href="docs.php">Doctors</a></li>
        <?php } ?>

      <?php
        if ($self == '/clinic/pages/patients.php') { ?>
          <li class="active"><a href="patients.php">Patients</a></li>
        <?php } else { ?>
          <li><a href="patients.php">Patients</a></li>
        <?php } ?>

    </ul>
    <a class="dropdown-trigger brand-logo right" href="#!" data-target="profile-dropdown" style="height:64px;">
      <img src="../images/users/<?= $_SESSION['avatar'] ?>" class="responsive-img circle" style="height:56px; margin-top: 4px;">
      <i class="material-icons right">arrow_drop_down</i>
    </a>
  </div>
</nav>
