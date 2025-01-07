<?php
include 'config/functions.php';

$errors = [];
$form_data = [];

if (isset($_POST['submit'])) {
    
    // First Name Validation
    if (isset($_POST['fname'])) {
        $form_data['fname'] = clean_input($_POST['fname']);
        if (empty($form_data['fname']) || !validate_text($form_data['fname'])) {
            $errors['fname'] = "First Name is required and should contain only letters.";
            $form_data['fname'] = ''; // Clear invalid value
        }
    } else {
        $form_data['fname'] = '';
    }

    // Last Name Validation
    if (isset($_POST['lname'])) {
        $form_data['lname'] = clean_input($_POST['lname']);
        if (empty($form_data['lname']) || !validate_text($form_data['lname'])) {
            $errors['lname'] = "Last Name is required and should contain only letters.";
            $form_data['lname'] = ''; // Clear invalid value
        }
    } else {
        $form_data['lname'] = '';
    }

    // Gender Validation
    if (isset($_POST['gender'])) {
        $form_data['gender'] = clean_input($_POST['gender']);
        if (empty($form_data['gender'])) {
            $errors['gender'] = "Gender is required.";
            $form_data['gender'] = ''; // Clear invalid value
        }
    } else {
        $errors['gender'] = "Gender is required.";
        $form_data['gender'] = '';
    }

    // Date of Birth Validation
    if (isset($_POST['dob'])) {
        $form_data['dob'] = clean_input($_POST['dob']);
        if (empty($form_data['dob']) || !validate_age($form_data['dob'])) {
            $errors['dob'] = "Date of Birth is required and you must be at least 18 years old.";
            $form_data['dob'] = ''; // Clear invalid value
        } else {
            $form_data['age'] = calculate_age($form_data['dob']);
        }
    } else {
        $form_data['dob'] = '';
    }
    // Height Validation
    if (isset($_POST['height'])) {
        $form_data['height'] = clean_input($_POST['height']);
        if (empty($form_data['height']) || !validate_height($form_data['height'])) {
            $errors['height'] = "Height is required and should be a valid number between 50 and 250 cm.";
            $form_data['height'] = ''; // Clear invalid value
        }
    } else {
        $form_data['height'] = '';
    }

    // Weight Validation
    if (isset($_POST['weight'])) {
        $form_data['weight'] = clean_input($_POST['weight']);
        if (empty($form_data['weight']) || !validate_weight($form_data['weight'])) {
            $errors['weight'] = "Weight is required and should be a valid number between 20 and 600 kg.";
            $form_data['weight'] = ''; // Clear invalid value
        }
    } else {
        $form_data['weight'] = '';
    }

    // Email Validation
    if (isset($_POST['email'])) {
        $form_data['email'] = clean_email($_POST['email']);
        if (empty($form_data['email']) || !validate_email($form_data['email'])) {
            $errors['email'] = "Valid Email is required.";
            $form_data['email'] = ''; // Clear invalid value
        }
    } else {
        $form_data['email'] = '';
    }

    // Phone Validation
    if (isset($_POST['phone'])) {
        $form_data['phone'] = clean_input($_POST['phone']);
        if (empty($form_data['phone']) || !validate_phone($form_data['phone'])) {
            $errors['phone'] = "Phone Number is required and should be in valid format (10 Digits).";
            $form_data['phone'] = ''; // Clear invalid value
        }
    } else {
        $form_data['phone'] = '';
    }

    // Address Validation
    if (isset($_POST['street'])) {
        $form_data['street'] = clean_input($_POST['street']);
        if (empty($form_data['street']) || !validate_street($form_data['street'])) {
            $errors['street'] = "Street Address is required and should be valid.";
            $form_data['street'] = ''; // Clear invalid value
        }
    } else {
        $form_data['street'] = '';
    }

    if (isset($_POST['city'])) {
        $form_data['city'] = clean_input($_POST['city']);
        if (empty($form_data['city']) || !validate_text($form_data['city'])) {
            $errors['city'] = "City is required and should contain only letters.";
            $form_data['city'] = ''; // Clear invalid value
        }
    } else {
        $form_data['city'] = '';
    }

    // Postal Code Validation
    if (isset($_POST['postal_code'])) {
        $form_data['postal_code'] = clean_input($_POST['postal_code']);
        if (empty($form_data['postal_code']) || !validate_postal_code($form_data['postal_code'])) {
            $errors['postal_code'] = "Postal Code is required and should be in valid format.";
            $form_data['postal_code'] = ''; // Clear invalid value
        }
    } else {
        $form_data['postal_code'] = '';
    }


    // Health Conditions
    if (isset($_POST['health_conditions'])) {
        $form_data['health_conditions'] = clean_input($_POST['health_conditions']);
    }

    if (count($errors) == 0) {
        // Process the form data
        header("Location: success.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Class Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
</head>


<body class="text-bg-dark bg">
    <main>
        <div class="container text-bg-dark ">
            <div class="py-5 text-center">
                <!--Image taken from https://www.pexels.com/photo/person-holding-barbell-841130/ -->
                <img src="assets/images/hero-image.jpg" class="hero-image">
                <h2 class="mt-5">Fitness Class Registration</h2>
                <hr>
            </div>
            <div class="row g-5">
                <div class="col-md-12">
                    <form method="post" action="" enctype="multipart/form-data" id="register" class="card  p-5">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-3">Personal Details
                                </h4>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="fname">First Name</label>
                                <input class="form-control" type="text" id="fname" name="fname" value="<?php echo isset($form_data['fname']) ? $form_data['fname'] : ''; ?>">
                                <?php echo display_error('fname', $errors); ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="lname">Last Name</label>
                                <input class="form-control" type="text" id="lname" name="lname" value="<?php echo isset($form_data['lname']) ? $form_data['lname'] : ''; ?>">
                                <?php echo display_error('lname', $errors); ?>

                            </div>

                            <div class="col-md-6 mb-3">
                                Gender
                                <div class="d-flex">
                                    <div class="form-check">

                                        <label class="form-check-label" for="female">Female</label>
                                        <input class="form-check-input" type="radio" id="female" name="gender" value="Female" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'Female') echo 'checked'; ?>>
                                    </div>
                                    <div class="form-check mx-4">
                                        <label class="form-check-label" for="male">Male</label>
                                        <input class="form-check-input" type="radio" id="male" name="gender" value="Male" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'Male') echo 'checked'; ?>>

                                    </div>

                                </div>
                                <?php echo display_error('gender', $errors); ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="dob">Date Of Birth</label>
                                <input class="form-control" type="date" id="dob" name="dob" value="<?php echo isset($form_data['dob']) ? $form_data['dob'] : ''; ?>">
                                <?php echo display_error('dob', $errors); ?>

                            </div>

                            <input class="form-control" type="hidden" id="age" name="age" value="<?php echo isset($form_data['age']) ? $form_data['age'] : ''; ?>">
                            <?php echo display_error('age', $errors); ?>



                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="height">Your height (cm)</label>
                                <input class="form-control" type="text" id="height" name="height" value="<?php echo isset($form_data['height']) ? $form_data['height'] : ''; ?>">
                                <?php echo display_error('height', $errors); ?>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="weight">Your current weight (kg)</label>
                                <input class="form-control" type="text" id="weight" name="weight" value="<?php echo isset($form_data['weight']) ? $form_data['weight'] : ''; ?>">
                                <?php echo display_error('weight', $errors); ?>

                            </div>

                            <div class="col-12">
                                <h4 class="mb-3">Address
                                </h4>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="street">Street Address</label>
                                <input class="form-control" type="text" id="street" name="street" value="<?php echo isset($form_data['street']) ? $form_data['street'] : ''; ?>">
                                <?php echo display_error('street', $errors); ?>
                            </div>
                            <div class="col-md-6 mb-3">

                                <label class="form-label" for="city">City</label>
                                <input class="form-control" type="text" id="city" name="city" value="<?php echo isset($form_data['city']) ? $form_data['city'] : ''; ?>">
                                <?php echo display_error('city', $errors); ?>
                            </div>
                            <div class="col-md-6 mb-3">

                                <label class="form-label" for="state">State / Province</label>
                                <select name="state" id="state" class="form-select">
                                    <option value="AB" <?php if (isset($_POST['state']) && $_POST['state'] == 'AB') echo 'selected'; ?>>Alberta</option>
                                    <option value="BC" <?php if (isset($_POST['state']) && $_POST['state'] == 'BC') echo 'selected'; ?>>British Columbia</option>
                                    <option value="MB" <?php if (isset($_POST['state']) && $_POST['state'] == 'MB') echo 'selected'; ?>>Manitoba</option>
                                    <option value="NB" <?php if (isset($_POST['state']) && $_POST['state'] == 'NB') echo 'selected'; ?>>New Brunswick</option>
                                    <option value="NL" <?php if (isset($_POST['state']) && $_POST['state'] == 'NL') echo 'selected'; ?>>Newfoundland and Labrador</option>
                                    <option value="NS" <?php if (isset($_POST['state']) && $_POST['state'] == 'NS') echo 'selected'; ?>>Nova Scotia</option>
                                    <option value="NT" <?php if (isset($_POST['state']) && $_POST['state'] == 'NT') echo 'selected'; ?>>Northwest Territories</option>
                                    <option value="NU" <?php if (isset($_POST['state']) && $_POST['state'] == 'NU') echo 'selected'; ?>>Nunavut</option>
                                    <option value="ON" <?php if (isset($_POST['state']) && $_POST['state'] == 'ON') echo 'selected'; ?>>Ontario</option>
                                    <option value="PE" <?php if (isset($_POST['state']) && $_POST['state'] == 'PE') echo 'selected'; ?>>Prince Edward Island</option>
                                    <option value="QC" <?php if (isset($_POST['state']) && $_POST['state'] == 'QC') echo 'selected'; ?>>Quebec</option>
                                    <option value="SK" <?php if (isset($_POST['state']) && $_POST['state'] == 'SK') echo 'selected'; ?>>Saskatchewan</option>
                                    <option value="YT" <?php if (isset($_POST['state']) && $_POST['state'] == 'YT') echo 'selected'; ?>>Yukon</option>
                                </select>
                                <?php echo display_error('state', $errors); ?>
                            </div>
                            <div class="col-md-6 mb-3">

                                <label class="form-label" for="postal_code">Postal / Zip Code</label>
                                <input class="form-control" placeholder="A1A1A1" type="text" id="postal_code" name="postal_code" value="<?php echo isset($form_data['postal_code']) ? $form_data['postal_code'] : ''; ?>">
                                <?php echo display_error('postal_code', $errors); ?>
                            </div>
                            <div class="col-md-6 mb-3">

                                <label class="form-label" for="country">Country</label>
                                <input class="form-control" type="text" id="country" name="country" value="Canada" disabled>

                            </div>
                            <div class="col-12">
                                <h4 class="mb-3">Contact Details
                                </h4>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" placeholder="email@domain.com" type="text" id="email" name="email" value="<?php echo isset($form_data['email']) ? $form_data['email'] : ''; ?>">
                                <?php echo display_error('email', $errors); ?>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="phone">Phone</label>
                                <input class="form-control" type="text" id="phone" name="phone" value="<?php echo isset($form_data['phone']) ? $form_data['phone'] : ''; ?>">
                                <?php echo display_error('phone', $errors); ?>

                            </div>

                            <div class="col-12">
                                <h4 class="mb-3">Other Information
                                </h4>
                            </div>
                            <div class="col-md-6 mb-3">

                                <label class="form-label" for="batch">Select Batch</label>
                                <select name="batch" id="batch" class="form-select">
                                    <option value="early_morning" <?php if (isset($_POST['batch']) && $_POST['batch'] == 'early_morning') echo 'selected'; ?>>Early Mornings</option>
                                    <option value="morning" <?php if (isset($_POST['batch']) && $_POST['batch'] == 'morning') echo 'selected'; ?>>Mornings</option>
                                    <option value="early_afternoon" <?php if (isset($_POST['batch']) && $_POST['batch'] == 'early_afternoon') echo 'selected'; ?>>Early Afternoons</option>
                                    <option value="afternoon" <?php if (isset($_POST['batch']) && $_POST['batch'] == 'afternoon') echo 'selected'; ?>>Afternoons</option>
                                    <option value="evening" <?php if (isset($_POST['batch']) && $_POST['batch'] == 'evening') echo 'selected'; ?>>Evenings</option>
                                </select>
                                <?php echo display_error('batch', $errors); ?>

                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="health_conditions">If you have any Injuries / Medical condition(s), please list them (Optional)</label>
                                <textarea class="form-control" id="health_conditions" name="health_conditions" placeholder="Please mention any health conditions or concerns" rows="4"><?php echo isset($form_data['health_conditions']) ? $form_data['health_conditions'] : ''; ?></textarea>
                                <?php echo display_error('health_conditions', $errors); ?>

                            </div>

                            <div class="col-md-12 mb-3 text-center">
                                <input class="w-50 btn btn-primary btn-lg" type="submit" name="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>