<?php

/**
 * sfGuardUser form.
 *
 * @package    form
 * @subpackage sf_guard_user
 * @version    SVN: $Id: sfGuardUserForm.class.php 24560 2009-11-30 11:05:31Z fabien $
 */
class PluginsfGuardUserForm extends PluginsfGuardUserAdminForm
{
  public function configure()
  {
    parent::configure();

    unset(
      $this['last_login'],
      $this['created_at'],
      $this['salt'],
      $this['algorithm'],
      $this['is_active'],
      $this['is_super_admin'],
      $this['sf_guard_user_group_list'],
      $this['sf_guard_user_permission_list']
    );
  }
}
