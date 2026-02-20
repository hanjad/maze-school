<?php
$pagetitle = "Register";
require_once 'assets/header.php';
require_once 'assets/dbConnect.php';

$firstname = $othername = $surname = $email = $phone = $password = $confirm_password = $course = $gender = $dob = $address = "";

$firstname_err = $othername_err = $surname_err = $email_err = $phone_err = $password_err = $confirm_password_err = $course_err = $gender_err = $dob_err = $address_err = $result_err = $passport_err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = htmlspecialchars($_POST['first-name'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $othername = htmlspecialchars($_POST['other-name'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $surname = htmlspecialchars($_POST['surname'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $confirm_password = htmlspecialchars($_POST['confirm-password'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $course = htmlspecialchars($_POST['course'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $gender = htmlspecialchars($_POST['gender'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $dob = htmlspecialchars($_POST['dob'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $address = htmlspecialchars($_POST['address'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $result = $_FILES['result'] ?? null;
    $passport = $_FILES['passport'] ?? null;


    if (empty($firstname)) {
        $firstname_err = "First name is required.";
    }

    if (empty($othername)) {
        $othername_err = "Other name is required.";
    }

    if (empty($surname)) {
        $surname_err = "Surname is required.";
    }

    if (empty($email)) {
        $email_err = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    }

    if (empty($phone)) {
        $phone_err = "Phone number is required.";
    } elseif (!preg_match("/^(0|\+234)(7|8|9)(0|1)\d{8}$/", $phone)) {
        $phone_err = "Invalid phone number format.";
    }

    if (empty($password)) {
        $password_err = "Password is required.";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $password_err = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }

    if (empty($confirm_password)) {
        $confirm_password_err = "Please confirm your password.";
    } elseif ($password !== $confirm_password) {
        $confirm_password_err = "Passwords do not match.";
    }

    if (empty($course)) {
        $course_err = "Course is required.";
    }

    if (empty($dob)) {
        $dob_err = "Date of birth is required.";
    } elseif (strtotime($dob) > time()) {
        $dob_err = "Date of birth cannot be in the future.";
    } elseif (strtotime($dob) > strtotime('-16 years')) {
        $dob_err = "You must be at least 16 years old to register.";
    }

    if (empty($address)) {
        $address_err = "Address is required.";
    }

    if ($result && $result['error'] === UPLOAD_ERR_NO_FILE) {
        $result_err = "Result file is required.";
    } elseif ($result && $result['error'] !== UPLOAD_ERR_OK) {
        $result_err = "Error uploading result file.";
    }

    if ($passport && $passport['error'] === UPLOAD_ERR_NO_FILE) {
        $passport_err = "Passport file is required.";
    } elseif ($passport && $passport['error'] !== UPLOAD_ERR_OK) {
        $passport_err = "Error uploading passport file.";
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
}
?>

<section class="bg-gray-50 dark:bg-gray-900 py-4">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
            Maze Schools
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Create an account
                </h1>
                <form class="space-y-4 md:space-y-6" action="" method="post" enctype="multipart/form-data">
                    <!-- First Name Field -->
                    <div>
                        <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                        <input type="text" name="first-name" id="first-name" value="<?= $firstname ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John">
                        <span class="text-red-500 text-sm"><?= $firstname_err ?></span>
                    </div>
                    <!-- Other Name Field -->
                    <div>
                        <label for="other-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Other Name</label>
                        <input type="text" name="other-name" id="other-name" value="<?= $othername ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Other Name(s)">
                        <span class="text-red-500 text-sm"><?= $othername_err ?></span>
                    </div>
                    <!-- Last Name Field -->
                    <div>
                        <label for="surname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Surname</label>
                        <input type="text" name="surname" id="surname" value="<?= $surname ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe">
                        <span class="text-red-500 text-sm"><?= $surname_err ?></span>
                    </div>
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" value="<?= $email ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                        <span class="text-red-500 text-sm"><?= $email_err ?></span>
                    </div>
                    <!-- Phone Field -->
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="tel" name="phone" id="phone" value="<?= $phone ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="+2348012345678 or 09112345678" pattern="^(0|\+234)(7|8|9)(0|1)\d{8}$">
                        <span class="text-red-500 text-sm"><?= $phone_err; ?></span>
                    </div>
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" value="<?= $password ?>" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <span class="text-red-500 text-sm"><?= $password_err ?></span>
                    </div>
                    <!-- Confirm Password Field -->
                    <div>
                        <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                        <input type="password" name="confirm-password" id="confirm-password" value="<?= $confirm_password ?>" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <span class="text-red-500 text-sm"><?= $confirm_password_err ?></span>
                    </div>
                    <!-- Course Field -->
                    <div>
                        <label for="course" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course</label>
                        <input type="text" name="course" id="course" value="<?= $course ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Computer Science">
                        <span class="text-red-500 text-sm"><?= $course_err ?></span>
                    </div>
                    <!-- Gender Field -->
                    <div>
                        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                        <select name="gender" id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <span class="text-red-500 text-sm"><?= $gender_err ?></span>
                    </div>
                    <!-- DOB Field -->
                    <div>
                        <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <span class="text-red-500 text-sm"><?= $dob_err ?></span>
                    </div>
                    <!-- Address Field -->
                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <textarea name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123 Main Street, City, Country"><?= $address ?></textarea>
                        <span class="text-red-500 text-sm"><?= $address_err ?></span>
                    </div>
                    <!-- Result Field -->
                    <div>
                        <label for="result" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Result file</label>
                        <input type="file" name="result" id="result" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" accept="image/*,.pdf,.docx">
                        <span class="text-red-500 text-sm"><?= $result_err ?></span>
                    </div>
                    <!-- Passport Field -->
                    <div>
                        <label for="passport" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Passport file</label>
                        <input type="file" name="passport" id="passport" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" accept="image/*,.pdf">
                        <span class="text-red-500 text-sm"><?= $passport_err ?></span>
                    </div>
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 cursor-pointer border-2 border-white">Create an account</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>