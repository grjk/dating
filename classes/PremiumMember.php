<?php

class PremiumMember {

    private $_inDoorInterests;
    private $_outDoorInterests;

    public function __construct($iDI, $oDI) {
        $this->_inDoorInterests = $iDI;
        $this->_outDoorInterests = $oDI;
    }
}