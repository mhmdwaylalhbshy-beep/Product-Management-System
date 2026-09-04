<?php
function validate_require($data,$field_name) {
if (empty($data)) {
        return "$field_name is required.";
    }
    return "";

}
function validate_salary($price) {
    if (!is_numeric($price) || $price < 0  || $price == 0) {
        return "Price must be a positive number.";
    }
    return "";
}
function validate_stock($stock)
{
    if (!is_numeric($stock) || $stock <= 0) {
        return "Stock must be a positive number.";
    }

    return "";
}
function validate_photo($photo)
{

    if ($photo['error'] !== UPLOAD_ERR_OK) {
        return "Error uploading file.";
    }

    $maxsize = 2 * 1024 * 1024; // 2MB

    if ($photo['size'] > $maxsize) {
        return "File size exceeds the maximum limit of 2MB.";
    }

    $ext = pathinfo($photo['name'], PATHINFO_EXTENSION);

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array(strtolower($ext), $allowedExtensions)) {
        return "Invalid file type. Only JPEG, PNG, and GIF are allowed.";
    }

    return "";
}

function validate_email($email) {
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //true or false
        return "Invalid email format.";
    }
    return "";
}

function validate_phone($phone) {
if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
        return "Invalid phone number format.";
    }
    return "";
}
function validate_password($password) {
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must contain at least one uppercase letter.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        return "Password must contain at least one lowercase letter.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        return "Password must contain at least one number.";
    }
    if (!preg_match('/[\W_]/', $password)) {
        return "Password must contain at least one special character.";
    }
    return "";
}
function validate_passwordmatch($password,$confirm_password)
{
    if ($password !== $confirm_password) {
        return "Passwords do not match.";
    }
        return "";
    
}
function add_error(&$errors, $error)
{
    if ($error) {
        $errors[] = $error;
    }
}
function validate_product_data( $product_name, $category, $price, $stock, $photo, $description, $status) {

    $errors = [];

    $data = [
        'product_name' => $product_name,
        'category' => $category,
        'price' => $price,
        'stock' => $stock,
        'photo' => $photo,
        'description' => $description,
        'status' => $status
    ];

    foreach ($data as $field => $value) {

        if (empty($value)) {
            $errors[$field] = ucfirst($field) . " is required.";
        }
    }

    if (!empty($price)) {
        $error = validate_salary($price);

        if ($error) {
            $errors['price'] = $error;
        }
    }

    if (!empty($stock)) {
        $error = validate_stock($stock);

        if ($error) {
            $errors['stock'] = $error;
        }
    }

    if (!empty($photo)) {
        $error = validate_photo($photo);

        if ($error) {
            $errors['photo'] = $error;
        }
    }

    return $errors;
}
function validate_contact_data($name,$email,$message) {

    $errors = [];

    $data = [
        'name' => $name,
        'email' => $email,
        'message' => $message
    ];

    foreach ($data as $field => $value) {

        if (empty($value)) {
            $errors[$field] = ucfirst($field) . " is required.";
        }
    }

    if (!empty($email)) {
        $error = validate_email($email);

        if ($error) {
            $errors['email'] = $error;
        }
    }
    return $errors;
}
function validate_register_data($name, $email, $password, $confirm_password)
{
    $errors = [];

    $data = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'confirm_password' => $confirm_password
    ];

    foreach ($data as $field => $value) {
        if (empty($value)) {
            $errors[$field] = ucfirst($field) . " is required.";
        }
    }

    if (!empty($email)) {
        $error = validate_email($email);

        if ($error) {
            $errors['email'] = $error;
        }
    }

    if (!empty($password)) {
        $error = validate_password($password);

        if ($error) {
            $errors['password'] = $error;
        }
    }

    if (!empty($confirm_password) && !empty($password)) {
        $error = validate_passwordmatch($password, $confirm_password);

        if ($error) {
            $errors['confirm_password'] = $error;
        }
    }

    return $errors;
}
function validate_login_data($email, $password)
{
    $errors = [];

    $data = [
       
        'email' => $email,
        'password' => $password,
    ];

    foreach ($data as $field => $value) {
        if (empty($value)) {
            $errors[$field] = ucfirst($field) . " is required.";
        }
    }

    if (!empty($email)) {
        $error = validate_email($email);
        if ($error) {
            $errors['email'] = $error;
        }
    }


    return $errors;
}
function validate_checkout_data($name, $email, $phone, $address , $note)
{
    $errors = [];

    $data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'note' => $note
    ];

    foreach ($data as $field => $value) {
        if (empty($value)) {
            $errors[$field] = ucfirst($field) . " is required.";
        }
    }

    if (!empty($email)) {
        $error = validate_email($email);

        if ($error) {
            $errors['email'] = $error;
        }
    }

    if (!empty($phone)) {
        $error = validate_phone($phone);

        if ($error) {
            $errors['phone'] = $error;
        }
    }

    return $errors;
}



?>