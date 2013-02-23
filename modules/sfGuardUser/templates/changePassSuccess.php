<form action="<?php echo url_for('@sf_guard_change_password') ?>" method="post">
  <table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="change password" />
</form>