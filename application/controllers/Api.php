<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

//http://localhost/sultanmart/public/api/users/

class Api extends RestController {

    private $CI;

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->CI =& get_instance();
    }


    public function items_get()
    {
        $item_number = $this->get( 'numbers' );

        log_message('debug', 'Get item api call for item number : '.$item_number);

        if ( $item_number === null )
        {
            $this->response( [
                'code' => E_BAD_REQUEST,
                'message' => 'Try again with giving item number'
            ], 400 );
        }


        $item_info = $this->CI->Item->get_item_by_item_number($item_number);

        if ( ! is_null($item_info) && !empty($item_info))
        {
            $this->response($item_info, 200, 'application/json' );
        }
        else
        {
            $this->response( [
                'code' => E_NOT_FOUND,
                'message' => 'No item found'
            ], 404 );
        }

    }
}