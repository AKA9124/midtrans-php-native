<?php

//this file will be access when payment updated, you can specify the file location in midtrans dashboard
//for example : https://jonialex.com/handler/transaction_update.php
 require_once('vendor/autoload.php');
 Veritrans_Config::$isProduction = false;
 Veritrans_Config::$serverKey = '';//your server key
 $notif = new Veritrans_Notification();

$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;

$transaction_id = $notif->transaction_id;
include "koneksi.php";
 
if ($transaction == 'capture') {
  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
  if ($type == 'credit_card'){
    if($fraud == 'challenge'){
      // TODO set payment status in merchant's database to 'Challenge by FDS'
      // TODO merchant should decide whether this transaction is authorized or not in MAP
      $mysqli->query("UPDATE transaksi SET transaksi_id='$transaction_id', status_detail='Challenge by FDS' WHERE order_id='$order_id'")or die(mysqli_error($conn));
      }
      else {
      // TODO set payment status in merchant's database to 'Success'
      $mysqli->query("UPDATE transaksi SET transaksi_id='$transaction_id', status_pembayaran='lunas' WHERE order_id='$order_id'")or die(mysqli_error($conn));
      }
    }
  }
else if ($transaction == 'settlement'){
  // TODO set payment status in merchant's database to 'Settlement'
  $mysqli->query("UPDATE transaksi SET transaksi_id='$transaction_id', status_detail='successfully transfered using $type', status_pembayaran='lunas' WHERE order_id='$order_id'")or die(mysqli_error($conn));
}
  else if($transaction == 'pending'){
  // TODO set payment status in merchant's database to 'Pending'
  $mysqli->query("UPDATE transaksi SET transaksi_id='$transaction_id', status_pembayaran='menunggu', status_detail='waiting customer to finish transaction' WHERE order_id='$order_id'")or die(mysqli_error($conn));
  
  }
  else if ($transaction == 'deny') {
  // TODO set payment status in merchant's database to 'Denied'
  $mysqli->query("UPDATE transaksi SET transaksi_id='$transaction_id', status_pembayaran='deny', status_detail='payment is denied' WHERE order_id='$order_id'")or die(mysqli_error($conn));
  
  }
  else if ($transaction == 'expire') {
  // TODO set payment status in merchant's database to 'expire'
  $mysqli->query("UPDATE transaksi SET transaksi_id='$transaction_id', status_pembayaran='expired', status_detail='payment expired' WHERE order_id='$order_id'")or die(mysqli_error($conn));
  
  }
  else if ($transaction == 'cancel') {
  // TODO set payment status in merchant's database to 'Denied'
  $mysqli->query("UPDATE transaksi SET transaksi_id='$transaction_id', status_pembayaran='cancel', status_detail='payment canceled' WHERE order_id='$order_id'")or die(mysqli_error($conn));
  
}
?>