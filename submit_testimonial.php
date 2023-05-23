<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apiUrl = 'https://646c237a7b42c06c3b2ac0dd.mockapi.io/testimoni';

    // Validate form inputs
    $errors = [];

    $nama = validateInput($_POST['nama'], 'nama', true);
    $email = validateInput($_POST['email'], 'email', true);
    $asal_instansi = validateInput($_POST['asal_instansi'], 'asal_instansi', true);
    $testimoni = validateInput($_POST['testimoni'], 'testimoni', true);
    $foto = validateInput($_POST['foto'], 'foto', true);

    if (empty($errors)) {
        // Prepare testimonial data
        $testimonialData = [
            'nama' => $nama,
            'email' => $email,
            'asal_instansi' => $asal_instansi,
            'testimoni' => $testimoni,
            'foto' => $foto,
        ];

        // Send POST request to the API
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($testimonialData));
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 201) {
            // Testimonial successfully submitted
            echo '<script>alert("Testimonial submitted successfully.");</script>';
        } else {
            // Error submitting testimonial
            echo '<script>alert("Error submitting testimonial. Please try again later.");</script>';
        }
    } else {
        // Validation errors occurred
        echo '<script>alert("' . implode('\n', $errors) . '");</script>';
    }
}

function validateInput($input, $field, $required = false) {
    $input = trim($input);

    if ($required && empty($input)) {
        $errors[] = ucfirst($field) . ' is required.';
    }

    switch ($field) {
        case 'nama':
        case 'asal_instansi':
            $pattern = '/^[\p{L}\s\'-]+$/u';
            $minLength = 3;
            $maxLength = 100;
            $errorMessage = ucfirst($field) . ' must contain alphabets, spaces, apostrophes, and dashes only.';
            break;
        case 'email':
            $pattern = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
            $minLength = 3;
            $maxLength = 100;
            $errorMessage = 'Invalid email address.';
            break;
        case 'testimoni':
            $pattern = '/^.{3,}$/';
            $minLength = 3;
            $maxLength = null;
            $errorMessage = 'Testimonial must be at least 3 characters long.';
            break;
        case 'foto':
            $pattern = '/^https?:\/\/\S+$/i';
            $minLength = 3;
            $maxLength = 100;
            $errorMessage = 'Invalid photo URL.';
            break;
        default:
            return $input;
    }

    if (isset($pattern) && !preg_match($pattern, $input)) {
        $errors[] = $errorMessage;
    }

    if (isset($minLength) && strlen($input) < $minLength) {
        $errors[] = ucfirst($field) . ' must be at least ' . $minLength . ' characters long.';
    }

    if (isset($maxLength) && strlen($input) > $maxLength) {
        $errors[] = ucfirst($field) . ' must not exceed ' . $maxLength . ' characters.';
    }

    if (empty($errors)) {
        return $input;
    } else {
        foreach ($errors as $error) {
            echo '<script>alert("' . $error . '");</script>';
        }
        exit();
    }
}
