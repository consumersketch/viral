<?php

class Common_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // get list of all clients
    // arg: none
    
    function get_cliients()
    {
        $query = $this->db->get('Clients');

        // return query result object
        return $query->result();
    }

    // get products by client_id
    // arg: $client_id

    function get_products_by_client($client_id)
    {
        $this->db->select('*');
        $this->db->from('Products');
        $this->db->where('client_id',$client_id);

        $query = $this->db->get();

        // return query result object
        return $query->result();
    }

    // Last Month to Date
    // arg: none

    function search1($cl_id=0)
    {

        $date = date('Y-m-d');
        $last_month = date('m');
        $last_month -= 1;
        $last_month_first_day = date('Y-'.$last_month.'-01');
        
        $this->db->select('*');
        $this->db->from('InvoiceLineItems');
        $this->db->join('Invoices','InvoiceLineItems.invoice_num = Invoices.invoice_num');
        $this->db->join('Products','InvoiceLineItems.product_id = Products.product_id');
        $this->db->where("invoice_date <= '$date'");
        $this->db->where("invoice_date >= '$last_month_first_day'");

        // additional condition that checks if search is dependant on client
        if($cl_id)
        {
            $this->db->where("Invoices.client_id = '$cl_id'");
        }

        $query = $this->db->get();
        
        // return query result object
        return $query->result();
    }

    // for: This Month
    // arg: none

    function search2($cl_id=0)
    {
        $date = date('Y-m-d');
        
        $last_month = date('m');

        $last_month_first_day = date('Y-'.$last_month.'-01');
        
        $this->db->select('*');
        $this->db->from('InvoiceLineItems');
        $this->db->join('Invoices','InvoiceLineItems.invoice_num = Invoices.invoice_num');
        $this->db->join('Products','InvoiceLineItems.product_id = Products.product_id');
        $this->db->where("invoice_date <= '$date'");
        $this->db->where("invoice_date >= '$last_month_first_day'");

        // additional condition that checks if search is dependant on client
        if($cl_id)
        {
            $this->db->where("Invoices.client_id = '$cl_id'");
        }

        $query = $this->db->get();
        
        // return query result object
        return $query->result();
    }

    // for: This year
    // arg: none

    function search3($cl_id=0)
    {
        $date = date('Y');
        
        $this->db->select('*');
        $this->db->from('InvoiceLineItems');
        $this->db->join('Invoices','InvoiceLineItems.invoice_num = Invoices.invoice_num');
        $this->db->join('Products','InvoiceLineItems.product_id = Products.product_id');
        
        $this->db->where("invoice_date >= '$date-01-01'");

        // additional condition that checks if search is dependant on client
        if($cl_id)
        {
            $this->db->where("Invoices.client_id = '$cl_id'");
        }

        $query = $this->db->get();
        
        // return query result object
        return $query->result();
    }

    // for: Last year
    // arg: none

    function search4($cl_id=0)
    {

        $date = date('Y');

        $date2 = date('Y');

        $today = date('Y-m-d');

        $date -= 1;
        
        $this->db->select('*');
        $this->db->from('InvoiceLineItems');
        $this->db->join('Invoices','InvoiceLineItems.invoice_num = Invoices.invoice_num');
        $this->db->join('Products','InvoiceLineItems.product_id = Products.product_id');

        $this->db->where("invoice_date < '$date2-01-01'");
        $this->db->where("invoice_date >= '$date-01-01'");

        // additional condition that checks if search is dependant on client
        if($cl_id)
        {
            $this->db->where("Invoices.client_id = '$cl_id'");
        }

        $query = $this->db->get();
        
        // return query result object
        return $query->result();
    }

}