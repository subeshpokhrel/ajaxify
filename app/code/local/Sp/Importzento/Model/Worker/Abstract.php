<?php
/**
 * Worker Abstract file
 *
 * @package Sp
 * @subpackage Importzento
 * @author subesh
 *
 */
class Sp_Importzento_Model_Worker_Abstract
{
	/**
     * @var Zend_Config_Xml
     */
    protected $_conf;

    /**
     * Constructor
     *
     * Initiates worker configuration
     */
    public function __construct()
    {
    	$conf = new Zend_Config_Xml(dirname(__FILE__) . '/../../etc/worker.xml');
        $this->_conf = $conf;
    }

    /**
     * Destructor
     *
     * Unsets the worker configuration
     */
    public function __destruct()
    {
    	unset($this->_conf);
    }

    /**
     * Returns Options config
     *
     * @param string $type
     * @param string $entity
     * @param string $option
     */
    public function getOptionConfig($type, $entity, $option)
    {
        return $this->_conf->import->$type->$entity->get($option);
    }


    /**
     * This will return the model for processing the import
     * based on the type defined reading the model attribute
     * form the xml structure.
     *
     * @param string $type
     * @param string $entity
     * @return Sp_Importzento_Model_Worker_Abstract
     */
    public function getWorkerFactory($type, $entity)
    {
        if (!$type || !$entity) {
            Mage::throwException('Type and Entity has to be defined to get worker model.');
        }
        $modelAlias = $this->getOptionConfig($type, $entity, 'model');
        if (!$modelAlias) {
            Mage::throwException('Model Alias not found the given type and entity');
        }

        $model = Mage::getModel($modelAlias);

        if (!$model instanceof Sp_Importzento_Model_Worker_Abstract) {
            Mage::throwException('Worker model should be the instance of Sp_Importzento_Model_Worker_Abstract');
        }
        return $model;

    }
}