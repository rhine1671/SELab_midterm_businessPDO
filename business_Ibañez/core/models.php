<?php

require_once 'dbConfig.php';

function insertShopCustomer($pdo, $first_name, $last_name,$date_of_birth, $email_add, $contact_number) {

	$sql = "INSERT INTO customers (first_name, last_name, date_of_birth, email_add, contact_number) VALUES(?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $date_of_birth, $email_add, $contact_number]);

	if ($executeQuery) {
		return true;
	}
}

function getAllCustomer($pdo){
    $sql  = "SELECT * FROM customers";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getCustomerByID($pdo, $customer_id) {
    $sql = "SELECT * FROM customers WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$customer_id])) {
        return $stmt->fetch();
    }
 }


function updateCustomer($pdo, $customer_id, $first_name, $last_name, $date_of_birth, $email_add, $contact_number) {

    $sql = "UPDATE customers
				SET first_name = ?, 
					last_name = ?,  
					date_of_birth = ?,
                    email_add = ?, 
					contact_number = ? 
                WHERE customer_id = ?";
	$stmt = $pdo->prepare($sql);
	
	$executeQuery = $stmt->execute([$first_name, $last_name, $date_of_birth, $email_add, $contact_number, $customer_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteCustomer($pdo, $customer_id) {

	$sql = "DELETE FROM customers WHERE customer_id = ?";
	$stmt = $pdo->prepare($sql);

	$executeQuery = $stmt->execute([$customer_id]);

	if ($executeQuery) {
		return true;
	}

}

function getOrderByCustomer($pdo, $customer_id){
    $sql  = "SELECT  orders.order_id AS order_id,
        orders.order_date AS order_date,
        orders.order_type AS order_type,
        orders.item_description AS item_description,
        orders.price AS price,
        CONCAT(customers.first_name, ' ',customers.last_name) AS customer_name
        FROM orders 
        JOIN customers ON orders.customer_id = customers.customer_id
        WHERE orders.customer_id = ?
        GROUP BY orders.order_type;";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getAllInfoByID($pdo, $customer_id) {
    $sql = "SELECT * FROM customers WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$customer_id])) {
        return $stmt->fetch();
        }
    }

function insertOrder($pdo, $order_type, $item_description, $price, $customer_id) {

	$sql = "INSERT INTO orders (order_type, item_description, price, customer_id) VALUES(?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$order_type, $item_description, $price, $customer_id]);

	if ($executeQuery) {
		return true;
	}
}

function getAllOrder($pdo){
    $sql  = "SELECT * FROM orders";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getOrderByID($pdo, $order_id){
    $sql  = "SELECT  orders.order_id AS order_id,
        orders.order_date AS order_date,
        orders.order_type AS order_type,
        orders.item_description AS item_description,
        orders.price AS price,
        CONCAT(customers.first_name, ' ',customers.last_name) AS customer_name
        FROM orders 
        JOIN customers ON orders.customer_id = customers.customer_id
        WHERE orders.order_id = ?
        GROUP BY orders.order_type;";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$order_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

function updateOrder($pdo, $order_type, $item_description, $price, $order_id) {

    $sql = "UPDATE orders
				SET order_type = ?, 
					item_description = ?,  
					price = ?
                WHERE order_id = ?";
	$stmt = $pdo->prepare($sql);
	
	$executeQuery = $stmt->execute([$order_type, $item_description, $price, $order_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteOrder($pdo, $order_id) {

	$sql = "DELETE FROM orders WHERE order_id = ?";
	$stmt = $pdo->prepare($sql);

	$executeQuery = $stmt->execute([$order_id]);

	if ($executeQuery) {
		return true;
	}

}



?>