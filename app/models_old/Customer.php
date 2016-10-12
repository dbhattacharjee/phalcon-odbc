<?php
namespace FutureFoam\Model;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;

class Customer extends Model
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false)
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
     * @Column(type="decimal", length=17, nullable=true)
     */
    public $Balance;
    
    /**
     * @Column(type="string", length=50, nullable=true)
     */
    public $City;
    
    /**
     * @Column(type="string", length=160, nullable=true)
     */
    public $Comments;
    
    /**
     * @Column(type="string", length=60, nullable=true)
     */
    public $Contact;
    
    /**
     * @Column(type="string", length=60, nullable=true)
     */
    public $Country;
    
    /**
     * @Column(type="decimal", length=17, nullable=true)
     */
    public $CreditLimit;
    
    /**
     * @Column(type="decimal", length=4, nullable=true)
     */
    public $Discount;
    
    /**
     * @Column(type="string", length=100, nullable=true)
     */
    public $EmailAddress;
    
    /**
     * @Column(type="string", length=40, nullable=true)
     */
    public $Fax;
    
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
     * @Column(type="string", length=8, nullable=true)
     */
    public $SalesRep;
    
    /**
     * @Column(type="string", length=40, nullable=true)
     */
    public $State;
    
    /**
     * @Column(type="string", length=40, nullable=false)
     */
    public $Terms;
    
    public function initialize()
    {
        $this->setSource("Customer");
        //$this->skipAttributesOnCreate(array('CustNum'));
        $this->hasMany(
            "CustNum",
            "FutureFoam\\Model\\BillTo",
            "CustNum",
            [
             'alias' => 'Bills',
             "foreignKey" => [
                    "action" => Relation::ACTION_CASCADE,
                ],
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