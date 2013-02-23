<?php

/**
 * sfGuardUser form for admin.
 *
 * @package    form
 * @subpackage sf_guard_user
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 13000 2008-11-14 10:44:57Z noel $
 */
class PluginsfGuardChangePassForm extends PluginsfGuardUserAdminForm
{
  public function configure()
  {
    parent::configure();
    
    $this->useFields(array('password', 'password_again'));
    
    $this->validatorSchema['password']->setOption('required', true);
    $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];
  }
}
