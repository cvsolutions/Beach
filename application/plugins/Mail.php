<?php
/**
* Plugin_Mail
*
* @uses     Zend_Controller_Plugin_Abstract
*
* @category Category
* @package  Package
* @author    <>
* @license  
* @link     
*/
class Plugin_Mail extends Zend_Controller_Plugin_Abstract
{
    /**
     * Send
     * 
     * @param array $params Description.
     *
     * @access public
     * @static
     *
     * @return mixed Value.
     */
	public static function Send($params = array())
	{
		$layout = new Zend_Layout(array('layoutPath' => sprintf('%s/layouts/scripts/', APPLICATION_PATH )));
		$layout->setLayout('email');

		$view = new Zend_View();
		$view->setScriptPath( sprintf('%s/views/scripts/email/', APPLICATION_PATH));

		$view->assign('params', $params['params']);

		$layout->content = $view->render($params['template']);
		$TPL = $layout->render();

		$mail = new Zend_Mail('utf-8');
		$mail->setBodyHtml($TPL);
		$mail->setFrom('info@pippo.it');
		$mail->addTo($params['email'] );
		$mail->setReplyTo($params['reply']);
		$mail->setSubject($params['subject']);
		return $mail->send();
	}
}