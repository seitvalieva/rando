<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;


class SubscriptionManager extends Manager{

    protected $classname = "Model\Entities\Subscription";
    protected $tableName = "subscription";

    public function __construct(){
        parent::connect();
    }
}