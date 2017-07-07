<?php

function oc_serialize($value){
    if (defined('VERSION')) {
        if (version_compare('2.1.0.0', VERSION) <= 0) {
            return json_encode($value);
        }else{
            return serialize($value);
        }
    }else{
        return serialize($value);
    }
}

function oc_unserialize($value){
    if (defined('VERSION')) {
        if (version_compare('2.1.0.0', VERSION) <= 0) {
            return json_decode($value, true);
        }else{
            return unserialize($value);
        }
    }else{
        return unserialize($value);
    }
}

?>