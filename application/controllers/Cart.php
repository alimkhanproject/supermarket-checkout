<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

    function __construct() 
    {
        parent::__construct();        
    }

    function index()
    {
        $data['title'] = 'Cart';
        $this->load->view('cart', $data);
    }

    function add_cart()
    {
      $product_id = $this->input->post('product_id', true);
      $quantity = $this->input->post('quantity', true);

      $product_data = $this->common->getSingle('tbl_product', array('id'=>$product_id, 'is_delete'=>0));

      if(empty($product_data))
      {
          $status = 0;
          $message = 'Invalid product ID !';
          $json_data = array('status'=>$status, 'message'=>$message);

          echo json_encode($json_data);
          exit;                    
      }

      $price = $product_data->unit_price;
      $each_sub_total = 0;
      $remaining_quantity = $quantity;

      $offered_price_data = $this->common->getWhere('tbl_offer_price', array('product_id'=>$product_id, 'mandatory_product_id'=>0));

      if(!empty($offered_price_data))
      {
        $quantity_price_arr = array();
        if(!empty($offered_price_data))
        {
          foreach ($offered_price_data as $row) 
          {
            $quantity_price_arr[$row->minimum_quantity] = $row->offer_price;
          }
          krsort($quantity_price_arr);
        }

        if(!empty($quantity_price_arr))
        {
          foreach ($quantity_price_arr as $arr_quantity => $arr_price) 
          {
            if($remaining_quantity >= $arr_quantity)
            {
              $quotient = (int)($remaining_quantity/$arr_quantity);

              $remaining_quantity = $remaining_quantity % $arr_quantity;

              $each_sub_total += $quotient * $arr_price;
            }
          }
        }

        if(!empty($remaining_quantity))
        {
          $each_sub_total += $remaining_quantity * $price;
        }
      }
      else 
      {
        $offered_price_data = $this->common->getSingle('tbl_offer_price', array('product_id'=>$product_id, 'mandatory_product_id'=>1));

        if(!empty($offered_price_data))
        {
          $cart_items = $this->cart->contents();

          $m_quantity_count = $this->getQuantityCountByProductID($offered_price_data->mandatory_product_id, $cart_items);
          if($quantity <= $m_quantity_count)
          {
            $each_sub_total = $quantity * $offered_price_data->offer_price;
          }
          else
          {
            $n_quantity = $quantity - $m_quantity_count;

            $each_sub_total = (($n_quantity * $price) + ($m_quantity_count * $offered_price_data->offer_price));

          }
        }
        else
        {
          $each_sub_total = $quantity * $price;
        }
      }

      $cart_items = $this->cart->contents();
      if(!empty($cart_items))
      {
          $rowid = $this->searchForProductId($product_id, $cart_items);

          if(!empty($rowid))
          {
            $cart_data = array(
                             'rowid' => $rowid,
                             'qty'   => $quantity,
                             'each_sub_total'     => $each_sub_total,
                          );
            $this->cart->update($cart_data);                 
          }
          else
          {
            $item_id = mt_rand(100,999);

            $cart_data = array(
                         'id'      => $item_id,
                         'product_id' => $product_data->id,
                         'qty'     => $quantity,
                         'price'     => $price,
                         'name'     => $product_data->name,
                         'each_sub_total'     => $each_sub_total,
                      );

            $this->cart->product_name_rules = '[:print:]';

            $this->cart->insert($cart_data);                 	
          }
      }
      else
      {
        $item_id = mt_rand(100,999);

        $cart_data = array(
                       'id'      => $item_id,
                       'product_id'      => $product_data->id,
                       'qty'     => $quantity,
                       'price'     => $price,
                       'name'     => ucfirst($product_data->name),                          
                       'each_sub_total'     => $each_sub_total,               
                    ); 

        $this->cart->product_name_rules = '[:print:]'; 

        $this->cart->insert($cart_data);             	
      }

      $total = getTotalPrice();
      $json_data = array('status'=>1, 'each_sub_total'=>number_format($each_sub_total, 2, '.', ''), 'total'=>number_format($total, 2, '.', ''), 'message'=>'Added successfully');

      echo json_encode($json_data);
      exit;
    }

    private function getQuantityCountByProductID($product_id, $array) 
    {
       foreach ($array as $key => $val) {
           if ($val['product_id'] === $product_id) {
               return $val['qty'];
           }
       }

       return 0;
    }

    private function searchForProductId($product_id, $array) 
    {
       foreach ($array as $key => $val) {
           if ($val['product_id'] === $product_id) {
               return $key;
           }
       }

       return 0;
    }

    function remove_cart_item()
    {
      $cart_item_id = $this->input->post('cart_item_id', true);

      if(empty($cart_item_id))
      {
        $status = 0;
        $message = 'Cart Item ID can not be empty !';
        $json_data = array('status'=>$status, 'message'=>$message);

        echo json_encode($json_data);
        exit; 
      }   

      $data = array(
              'rowid' => $cart_item_id,
              'qty'   => 0
      );

      $this->cart->update($data);

      $total_items = count($this->cart->contents());

      $sub_total = $this->cart->total();
      
      $total = $sub_total;

      $json_data = array('status'=>1, 'total_items'=>$total_items, 'sub_total'=>number_format($sub_total, 2, '.', ''), 'total'=>number_format($total, 2, '.', ''));

      echo json_encode($json_data);
      exit;

    }

}
