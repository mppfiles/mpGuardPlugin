<?php

require_once dirname(__FILE__).'/sfGuardUserGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/sfGuardUserGeneratorHelper.class.php';

/**
 * sfGuardUser actions.
 *
 * @package    sfGuardPlugin
 * @subpackage sfGuardUser
 * @author     Fabien Potencier
 * @version    SVN: $Id: BasesfGuardUserActions.class.php 12965 2008-11-13 06:02:38Z fabien $
 */
class BasesfGuardUserActions extends autoSfGuardUserActions
{
  public function executeChangePassword(sfWebRequest $request)
  {
    $this->form = new PluginsfGuardChangePassForm();
    
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('sf_guard_user'));
      
      if($this->form->isValid())
      {
        $values = $this->form->getValues();
        $this->getUser()->setPassword($values['password']);
        
        $this->getUser()->setFlash('notice', 'Password changed successfully');
        
        return $this->redirect("@homepage");
      }
    }
  }
}
