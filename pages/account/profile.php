<?php

$users_table = new User();
$user = $users_table->getByEmail($_SESSION['email']);

$avatars_table = new Avatar();
$avatars = $avatars_table->all();

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $avatar = $_POST['avatar'];
    $username = htmlentities(trim($_POST['username']));
    $firstname = htmlentities(trim($_POST['firstname']));
    $lastname = htmlentities(trim($_POST['lastname']));
    $street = htmlentities(trim($_POST['street']));
    $city = htmlentities(trim($_POST['city']));
    $zipcode = htmlentities(trim($_POST['zipcode']));


    // Verification de la birthday date
    if (isset($_POST['birthday']) && !empty($_POST['birthday'])) {
        $birthday = htmlentities(trim($_POST['birthday']));
    } else {
        $birthday = null;
    }

    // Requete
    $user->updateProfile($email, $avatar, $username, $firstname, $lastname, $street, $city, $zipcode, $birthday);
    header('Location: index.php?p=my_account');
    exit();

}

require './pages/templates/header.php';
?>


<div class="edit">

    <h1>Edit Profile</h1>

    <div class="error-message"><?php echo $error_message ?></div>

    <div class="edit-form">

        <form action="" method="post">
            
            <label for="avatar">Choose your avatar</label>
            <div class="avatar-container">
                <?php foreach ($avatars as $avatar): ?>
                    <input type='radio' name='avatar' value="<?= $avatar->name ?>" style='display: none;'>
                    <div class="avatar-option">
                        <img src="<?= $avatar->name ?>" alt="Avatar">
                    </div>
                    </label>
                <?php endforeach ?>
            </div>

            <label for="email">Email</label>
            <input class="edit-input" type="email" name="email" value="<?= $user->email ?>" readOnly="readOnly">

            <label for="username">Username</label>
            <input class="edit-input" type="text" name="username" value="<?= str_replace("-", " ", $user->username); ?>"
                required>

            <label for="email">Cell Phone</label>
            <input class="edit-input" type='tel' value="<?= $user->tel ?>" name="tel">

            <label for="email">Firstname</label>
            <input class="edit-input" type="text" value="<?= $user->firstname ?>" name="firstname">

            <label for="email">Lastname</label>
            <input class="edit-input" type="text" value="<?= $user->lastname ?>" name="lastname">

            <label for="email">Street Adress</label>
            <input class="edit-input" type="text" value="<?= $user->street ?>" name="street">

            <label for="email">City</label>
            <input class="edit-input" type="text" value="<?= $user->city ?>" name="city">

            <label for="email">Zip Code</label>
            <input class="edit-input" type="text" value="<?= $user->zipcode ?>" name="zipcode">

            <label for="email">Birthday Date</label>
            <input class="edit-input" type='date' value="<?= $user->birthday ?>" name="birthday">

            <button type="submit" name="submit" class="product-btn edit-btn account-btn">Save Info</button>

        </form>
    </div>

</div>



<script type="module" src='/JS/profile.js'></script>