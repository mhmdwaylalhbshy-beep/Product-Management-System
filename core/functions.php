<?php
//general finction
function setmessage($message, $type)
{
    $_SESSION['message'] = [
        'text' => $message,
        'type' => $type
    ];
}

//general function
function showmessage($type = null, $field = null)
{
    // General message
    if ($type !== 'error' && isset($_SESSION['message'])) {

        $text = $_SESSION['message']['text'];
        $messageType = $_SESSION['message']['type'];

        if ($type === null || $messageType === $type) {

            echo "<div class='alert alert-$messageType'>$text</div>";

            unset($_SESSION['message']);
        }
    }

    // Validation errors
    if ($type === 'error' && !empty($_SESSION['errors'])) {
        if ($field === null) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<div class='text-danger mt-1'>" . htmlspecialchars($error, ENT_QUOTES) . "</div>";
            }
        } elseif (isset($_SESSION['errors'][$field])) {
            echo "<div class='text-danger mt-1'>" . htmlspecialchars($_SESSION['errors'][$field], ENT_QUOTES) . "</div>";
        }
    }

    return "";
}
//product function
function add_product($product_name, $category, $price, $stock, $photo, $description, $status)
{
    $product = Base_Path . "data/data.json";

    if (file_exists($product)) {
        $products = json_decode(file_get_contents($product), true) ?? [];
    } else {
        $products = [];
    }

    $add = [
        'id' => count($products) + 1,
        'product_name' => $product_name,
        'category' => $category,
        'price' => $price,
        'stock' => $stock,
        'photo' => $photo,
        'description' => $description,
        'status' => $status
    ];

    $products[] = $add;

    return file_put_contents(
        $product,
        json_encode($products, JSON_PRETTY_PRINT)
    ) !== false;
}

function get_datajson() {
$product = Base_Path . "data/data.json";
if (file_exists($product)) {
    return json_decode(file_get_contents($product), true);

}
return [];

}

function get_user_cart($userId)
{
    $cartFile = Base_Path . "data/cart.json";

    if (!file_exists($cartFile)) {
        return [];
    }

    $carts = json_decode(file_get_contents($cartFile), true) ?? [];
    return $carts[ $userId] ?? [];
}

function save_user_cart($userId, $cart)
{
    $cartFile = Base_Path . "data/cart.json";
if (file_exists($cartFile)) {
    $carts = json_decode(file_get_contents($cartFile), true) ?? [];
} else {
    $carts = [];
}
    $carts[$userId] = $cart;

    return file_put_contents($cartFile, json_encode($carts, JSON_PRETTY_PRINT)) !== false;
}
//contact function
function add_contact($name,$email,$message)
{
    $contact = Base_Path . "data/contact.json";

    if (file_exists($contact)) {
        $contacts = json_decode(file_get_contents($contact), true) ?? [];
    } else {
        $contacts = [];
    }

    $add = [
        'id' => count($contacts) + 1,
        'name' => $name,
        'email' => $email,
        'message' => $message
        
    ];

    $contacts[] = $add;

    return file_put_contents(
        $contact,
        json_encode($contacts, JSON_PRETTY_PRINT),true);
}

function get_contactjson() {
$contact = Base_Path . "data/contact.json";
if (file_exists($contact)) {
    return json_decode(file_get_contents($contact), true);

}
return [];

}

function add_client($name, $email, $password){
    
    $client = Base_Path . "data/client.json";

    if (file_exists($client)) {
        $clients = json_decode(file_get_contents($client), true) ?? [];
    } else {
        $clients = [];
    }

$id = count($clients) + 1;
    $add = [
        'id' => $id,
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
        
    ];

    $clients[] = $add;

file_put_contents($client,json_encode($clients, JSON_PRETTY_PRINT));

    $_SESSION['user'] = [
        'id' => $id,
        'name' => $name,
        'email' => $email
    ];

    $_SESSION['cart'][$id] = get_user_cart($id);
    return true;

}

  function login_user($email, $password)
{
    $jsonFile = Base_Path . "data/client.json";
    if (file_exists($jsonFile)) {
        $users = json_decode(file_get_contents($jsonFile), true);
    } else {
        return false;
    }
    foreach ($users as $user) {

        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];
            $_SESSION['cart'][$user['id']] = get_user_cart($user['id']);
            return true;
        }
    }
    return false;
}
function check_authentication()
{
    if (!isset($_SESSION['user']['id'])) {
        header("Location: " . Base_URL . "views/auth/login.php");
        exit;
    }
}
function add_checkout($name, $email, $address, $phone, $note)
{
    $checkout = Base_Path . "data/checkout.json";

    $add = [
        'id' => 1,
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'phone' => $phone,
        'note' => $note
    ];

    return file_put_contents(
        $checkout,
        json_encode([$add], JSON_PRETTY_PRINT));
}
function get_checkoutjson() {
$checkout = Base_Path . "data/checkout.json";
if (file_exists($checkout)) {
    return json_decode(file_get_contents($checkout), true);

}
return [];

}
?>