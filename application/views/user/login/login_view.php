<script>

</script>

<body>
	<!-- Main Content -->
    <h1>Login Page</h1>
    <?=$this->session->flashdata('message')?> 
    <form class="user" method="post" action=" <?=base_url('user/login/Auth/verify_users'); ?>">
    <!-- Email-->
        <div class="form-row pt-5 px-3">
            <div class="form-group col-md-12 px-2">
                <input type="email" name="user_email" id="email"  placeholder="Enter your email address" value="<?=set_value('user_email');?>" required>
                <?= form_error('user_email','<small class="text-danger pl-3">','</small>');?>
            </div>
        </div>
        <!-- Password and confirm password -->
        <div class="form-row pt-3 pb-3 px-3">
            <div class="form-group col-md-12 px-2">
                <input type="password" name="user_password" id="password" placeholder="Enter your password" required>
                <?= form_error('user_password','<small class="text-danger pl-3">','</small>');?>
            </div>
        </div>
        <!-- Submit button -->
        <div class="pt-1 pr-4">
            <button type="submit" class="btn btn-success">Login <i class="fas fa-check"></i></button>
        </div>
        <br>
        <br>
    </form>
</body>