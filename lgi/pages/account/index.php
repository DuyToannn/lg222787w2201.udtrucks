<a class="view-tab <?php if(!isset($_GET['view'])) echo 'active'; ?>" href="?page=account">Nhật ký hoạt động</a>
<a class="view-tab <?php if(isset($_GET['view']) && $_GET['view'] == "profile") echo 'active'; ?>" href="?page=account&view=profile">Thông tin cá nhân</a>
<a class="view-tab <?php if(isset($_GET['view']) && $_GET['view'] == "password") echo 'active'; ?>" href="?page=account&view=password">Đổi mật khẩu</a>
<?php if(isset($_GET['view']) && $_GET['view'] == "profile") require_once(__DIR__.'/profile.php');
else if(isset($_GET['view']) && $_GET['view'] == "password") require_once(__DIR__.'/password.php'); 
else { ?>

<?php } ?>