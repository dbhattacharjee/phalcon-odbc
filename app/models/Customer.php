<?php
namespace FutureFoam\Model;
use Phalcon\Mvc\Model;

class Customer extends Model
{
    /**
     * @var integer
     */
    public $CustNum;

    /**
     * @var varchar
     */
    public $Name;
    
    /**
     * @var varchar
     */
    public $EmailAddress;
    
    /**
     * @var varchar
     */
    public $Fax;
    
    public function initialize()
    {
        $this->setSource("Customer");
    }
    
}