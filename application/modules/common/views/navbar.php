

<nav class="navbar navbar-expand-lg navbar-light bg-light header-sticky">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url(); ?>"><span>Theme</span> Sells</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fa fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>projects">Popular Themes</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>contact">Contact Us</a>
        </li>
		  <?php if($this->session->flashdata('cart_message')) { ?>
			  <div class="alert alert-success">
				  <?php echo $this->session->flashdata('cart_message'); ?>
			  </div>
		  <?php } ?>
		<?php
		$is_loggedIn = null;
		if ($this->session->userdata("userLoginData"))
		{
			$is_loggedIn = $this->session->userdata("userLoginData");
		}
			if ($is_loggedIn == null){
		?>
         <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>auth/login">Login</a>
        </li>

         <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>auth/signup">Sign Up</a>
        </li>
		<?php }
			else
			{
			?>
		  <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>user">Profile</a>
		  </li>

		  <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>auth/logout">Log Out</a>
		  </li>
		  <?php } ?>
        </div>
      </div>
    </nav>
