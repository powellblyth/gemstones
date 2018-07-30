<?php
        $host = 'apiorders-cluster.cluster-cpay5vxwhivt.eu-west-2.rds.amazonaws.com';
        $user = "user";
        $pass = "P0werfu11Gees3!";
        $dbname = "APIorders";

        $db = new mysqli($host,$user,$pass,$dbname);
        if (mysqli_connect_errno($db)) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $from_date = date('c', strtotime('2014-01-25 14:55:19'));
        $to_date   = date('c', strtotime('2019-01-25 14:55:30'));

        $aws = array(
                'token'                    => "4e99670c6dc6921bce9a189122054c7b",
                'updated_at[from]' => $from_date,
                'updated_at[to]'   => $to_date,
        );

        $url = "https://api.sandbox.notonthehighstreet.com/api/v1/orders?";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . http_build_query($aws));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);

        $response = curl_exec ($ch);
        curl_close ($ch);
        $data = json_decode($response, true);

        $row_num = $data['query']['total'];

        if($row_num > 0){

                foreach ($data['data'] as $v) {
                        $id = $v['id'];
                        $state = $v['state'];
                        $confirm_by = $v['confirm_by'];
                        $estimated_dispatch_at = $v['estimated_dispatch_at'];
                        $placed_at = $v['placed_at'];
                        $expired_at = $v['expired_at'];
                        $declined_at = $v['declined_at'];
                        $accepted_at = $v['accepted_at'];
                        $dispatched_at = $v['dispatched_at'];
                        $archived_at = $v['archived_at'];
                        $updated_at = $v['updated_at'];
                        $repeat_customer = $v['repeat_customer'];
                        $customer_expected_delivery_date = $v['customer_expected_delivery_date'];
                        $number = $v['number'];
                        $dispatch_note_viewed = $v['dispatch_note_viewed'];
                        $express = $v['express'];
                        $partner_name = $v['partner_name'];
                        $delivery_recipient_name = $v['delivery_recipient_name'];
                        $delivery_recipient_first_name = $v['delivery_recipient_first_name'];
                        $delivery_recipient_last_name = $v['delivery_recipient_last_name'];
                        $international = $v['international'];
                        $dispatch_overdue = $v['dispatch_overdue'];
                        $gift = $v['gift'];
                        $gift_message = $v['gift_message'];
                        $gift_wrap = $v['gift_wrap'];
                        $gift_receipt = $v['gift_receipt'];
                        $delivery_note = $v['delivery_note'];
                        $has_enquiry = $v['has_enquiry'];
                        $estimated_delivery_date = $v['estimated_delivery_date'];
                        $rebate_qualified = $v['rebate_qualified'];
                        $rebate_achieved = $v['rebate_achieved'];
                        $from_wedding_list = $v['from_wedding_list'];
                        $from_wish_list = $v['from_wish_list'];
                        $user = json_encode($v['user']);
                        $delivery_address = json_encode($v['delivery_address']);
                        $delivery_zone = json_encode($v['delivery_zone']);
                        $delivery_service = json_encode($v['delivery_service']);
                        $order_detail = json_encode($v['order_detail']);
                        $order_total = json_encode($v['order_total']);
                        $delivery_total = json_encode($v['delivery_total']);
                        $enquiry = json_encode($v['enquiry']);
                        $promotion_discount = json_encode($v['promotion_discount']);
                        $promotion_present = json_encode($v['promotion_present']);
                        $remaining_refund_amount = json_encode($v['remaining_refund_amount']);
                        $refund_total = json_encode($v['refund_total']);
                        $extra_refund_amount = json_encode($v['extra_refund_amount']);

                        $q = "INSERT INTO `orders`(`id`, `state`, `confirm_by`, `estimated_dispatch_at`, `placed_at`, `expired_at`, `declined_at`, `accepted_at`, `dispatched_at`, `archived_at`, `updated_at`, `repeat_customer`, `customer_expected_delivery_date`, `number`, `dispatch_note_viewed`, `express`, `partner_name`, `delivery_recipient_name`, `delivery_recipient_first_name`, `delivery_recipient_last_name`, `international`, `dispatch_overdue`, `gift`, `gift_message`, `gift_wrap`, `gift_receipt`, `delivery_note`, `has_enquiry`, `estimated_delivery_date`, `rebate_qualified`, `rebate_achieved`, `from_wedding_list`, `from_wish_list`, `user`, `delivery_address`, `delivery_zone`, `delivery_service`, `order_detail`, `order_total`, `delivery_total`, `enquiry`, `promotion_discount`, `promotion_present`, `remaining_refund_amount`, `refund_total`, `extra_refund_amount`) ";
                        $q.= "VALUES ('$id','$state','$confirm_by','$estimated_dispatch_at','$placed_at','$expired_at','$declined_at','$accepted_at','$dispatched_at','$archived_at','$updated_at','$repeat_customer','$customer_expected_delivery_date','$number','$dispatch_note_viewed','$express','$partner_name','$delivery_recipient_name','$delivery_recipient_first_name','$delivery_recipient_last_name','$international','$dispatch_overdue','$gift','$gift_message','$gift_wrap','$gift_receipt','$delivery_note','$has_enquiry','$estimated_delivery_date','$rebate_qualified','$rebate_achieved','$from_wedding_list','$from_wish_list','$user','$delivery_address','$delivery_zone','$delivery_service','$order_detail','$order_total','$delivery_total','$enquiry','$promotion_discount','$promotion_present','$remaining_refund_amount','$refund_total','$extra_refund_amount');";
                        $db->query($q);

                        foreach ($v['items'] as $item) {
                                $items_id = $item['id'];
                                $item_title = $item['item_title'];
                                $quantity = $item['quantity'];
                                $commission_vat_rate = $item['commission_vat_rate'];
                                $options = json_encode($item['options']);
                                $listing_total_gross = json_encode($item['listing_total_gross']);
                                $product_id = $item['product']['id'];
                                $product_sku = $item['product']['sku'];
                                $product_title = $item['product']['title'];
                                $product_personalisable = $item['product']['personalisable'];
                                $product_image = json_encode($item['product']['image']);

                                $q2 = "INSERT INTO `items`(`items_id`, `item_title`, `quantity`, `commission_vat_rate`, `options`, `listing_total_gross`, `product_id`, `product_sku`, `product_title`, `product_personalisable`, `product_image`)";
                                $q2.= " VALUES ('$items_id','$item_title','$quantity','$commission_vat_rate','$options','$listing_total_gross','$product_id','$product_sku','$product_title','$product_personalisable','$product_image');";
                                $db->query($q2);

                        }
                }
        }
$q3 = "INSERT INTO `callLog`(`timestamp`,`script`,`rows`, `fromdate`, `todate`)";
                                $q3.= " VALUES (NOW(),'NOTHS','$row_num','$from_date','$to_date');";
                                $db->query($q3);
        #echo "<pre>";
        #print_r($data['data'][0]);
?>
