<?php
namespace FutureFoam\Model;
use Phalcon\Mvc\Model;

class BillTo extends Model
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false)
     */
    public $BillToID;
    
    /**
     * @Column(type="interger", length=4, nullable=true)
     */
    public $CustNum;

    /**
     * @Column(type="string", length=70, nullable=true)
     */
    public $Address;
    
    /**
     * @Column(type="string", length=70, nullable=true)
     */
    public $Address2;
    
    /**
     * @Column(type="string", length=50, nullable=true)
     */
    public $City;
    
    /**
     * @Column(type="string", length=60, nullable=true)
     */
    public $Contact;
    
    /**
     * @Column(type="string", length=60, nullable=true)
     */
    public $Name;
    
    /**
     * @Column(type="string", length=40, nullable=true)
     */
    public $Phone;
    
    /**
     * @Column(type="string", length=20, nullable=true)
     */
    public $PostalCode;
    
    /**
     * @Column(type="string", length=40, nullable=true)
     */
    public $State;
    
    
    public function initialize()
    {
        $this->setSource("BillTo");
        
        $this->belongsTo(
            "CustNum",
            "FutureFoam\\Model\\Customer",
            "CustNum",
            [
             'alias' => 'Customer',
            ]
        );
    }
    
    public function beforeValidationOnCreate() {
        $metaData = $this->getModelsMetaData();
        $defaultValues = $metaData->getDefaultValues($this);
        foreach ($defaultValues as $field => $defVal) {
            if (!isset($this->{$field}) || is_null($this->{$field})) {
                $this->{$field} = is_null($defVal) ? '' : $defVal;
            }
        }
    }
    
}