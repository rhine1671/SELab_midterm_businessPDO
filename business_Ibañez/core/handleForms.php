<?php

require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertNewCustomerBtn'])) {
   
    $query = insertShopCustomer($pdo, $_POST['first_name'], 
		$_POST['last_name'], $_POST['date_of_birth'], $_POST['email_add'], $_POST['contact_number'], $_POST['order_type'], $_POST['item_description'], $_POST['price']);
 
	#$query = insertOrder($pdo, $_POST['order_type'], $_POST['item_description'], $_POST['price']);

	if ($query) {
		header("Location: ../index.php");
        exit;
	}
	else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editCustomerBtn'])) {
	$customer_id = $_POST['customer_id'];
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$date_of_birth = trim($_POST['date_of_birth']);
	$email_add = trim($_POST['email_add']);
	$contact_number = trim($_POST['contact_number']);

	if (!empty($customer_id) && !empty($first_name) && !empty($last_name) && !empty($date_of_birth) && !empty($email_add) && !empty($contact_number)) {

		$query = updateCustomer($pdo, $customer_id, $first_name, $last_name, $date_of_birth, $email_add, $contact_number);

		if ($query) {
			header("Location: ../index.php");
		}
		else {
			echo "Update failed";
		}

	}

	else {
		echo "Make sure that no fields are empty";
	}

}

if (isset($_POST['deleteCustomerBtn'])) {

	$query = deleteCustomer($pdo, $_GET['customer_id']);

	if ($query) {
		header("Location: ../index.php");
		exit;
	}
	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['cancelBtn'])){

		header("Location: ../index.php");
		exit;
	
}

if (isset($_POST['insertNewOrderBtn'])) {
 
	$query = insertOrder($pdo, $_POST['order_type'], $_POST['item_description'], $_POST['price'], $_GET['customer_id']);

	if ($query) {
		header("Location: ../viewOrders.php?customer_id=". $_GET['customer_id']);
        exit;
	}
	else {
		echo "Insertion failed";
	}
}


if (isset($_POST['editOrderBtn'])) {
	$query = updateOrder($pdo, $_POST['order_type'], $_POST['item_description'], $_POST['price'], $_GET['order_id']);

	if ($query) {
		header("Location: ../viewOrders.php?customer_id=" .$_GET['customer_id']);
	}
	else {
		echo "Update failed";
	}

}

if (isset($_POST['canceleditBtn'])){

	header("Location: ../viewOrders.php?customer_id=" .$_GET['customer_id']);
	exit;

}

if (isset($_POST['deleteOrderBtn'])) {
	$query = deleteOrder($pdo, $_GET['order_id']);

	if ($query) {
		header("Location: ../viewOrders.php?customer_id=" .$_GET['customer_id']);
	}
	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['cancelDeleteBtn'])){

	header("Location: ../viewOrders.php?customer_id=" .$_GET['customer_id']);
	exit;

}
?>