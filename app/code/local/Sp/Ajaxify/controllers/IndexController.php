<?php
class Sp_Ajaxify_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Always use this session to set your error or success message
     *
     * @return Sp_Ajaxify_Model_Session
     * 
     * PLEASE DO NOT EDIT THIS
     */
	protected function _getSession()
    {
    	return Mage::getSingleton('ajaxify/session');
    }
    
    /**
     * This will read the message set on Sp_Ajaxify_Model_Session session and output the
     * messages.
     *
     * @return string
     * 
     * PLEASE DO NOT EDIT THIS
     * 
     */
    public function messageAction()
    {
    	$messages = $this->_getSession()->getMessages(true);
    	if ($messages) {
	    	echo $this->getLayout()->createBlock('ajaxify/messages')->setMessages($messages)->getGroupedHtml();
    	}
    	return '';
    }
    
    
	/**
     * This is just a test/example method as a reference to use in
     * your controller.
     * 
     * @todo: Remove this after you get the point.
     * 
     * 
     * You can see there is no any NEW thing done. But the main
     * thing is done in the layout. Please refer to ajaxify.xml in layout.
     * 
     * Here what you can do is do your 
     *
     */
    public function testAction()
    {
    	// Do something here
    	
    	// Set Error message .
    	$this->_getSession()->addError('Item was not added to the shopping cart.');
    	
    	// Set Success message
//    	$this->_getSession()->addSuccess('Item was successfully added to the shopping cart.');
    
    	$this->loadLayout()->renderLayout();
    }
}