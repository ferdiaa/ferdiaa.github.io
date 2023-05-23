<!DOCTYPE html>
<html>
<head>
    <title>Testimonial Page</title>
    <style>
        /* Add your CSS styles here */
        /* For example, you can style the form and success message */
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .success-message {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
    // Function to validate the form input
    function validateFormInput($data)
    {
        $errors = array();

        // Validate the 'nama' field
        if (empty($data['nama']) || !preg_match('/^[a-zA-Z\s\'-]+$/', $data['nama'])) {
            $errors[] = 'Invalid or empty name field';
        }

        // Validate the 'email' field
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid or empty email field';
        }

        // Validate the 'asal_instansi' field
        if (empty($data['asal_instansi']) || !preg_match('/^[a-zA-Z\s\'-]+$/', $data['asal_instansi'])) {
            $errors[] = 'Invalid or empty institution field';
        }

        // Validate the 'testimoni' field
        if (empty($data['testimoni'])) {
            $errors[] = 'Invalid or empty testimonial field';
        }

        // Validate the 'foto' field
        if (!empty($data['foto']) && !filter_var($data['foto'], FILTER_VALIDATE_URL)) {
            $errors[] = 'Invalid photo URL';
        }

        return $errors;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Fetch form data
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $asal_instansi = $_POST['asal_instansi'];
        $testimoni = $_POST['testimoni'];
        $foto = $_POST['foto'];

        // Validate form input
        $errors = validateFormInput($_POST);

        // If there are no errors, proceed to submit the data
        if (empty($errors)) {
            $data = array(
                'nama' => $nama,
                'email' => $email,
                'asal_instansi' => $asal_instansi,
                'testimoni' => $testimoni,
                'foto' => $foto
            );

            // Submit the data to the API
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://646c237a7b42c06c3b2ac0dd.mockapi.io/testimoni');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Check if the data was successfully submitted
            if ($httpCode === 201) {
                echo '<div class="success-message">Testimonial submitted successfully!</div>';
            } else {
                echo 'Error submitting testimonial. Please try again later.';
            }
        } else {
            // Display validation errors
            foreach ($errors as $error) {
                echo '<div>' . $error . '</div>';
            }
        }
    }
    ?>

    <div class="form-container">
        <h2>Submit Testimonial</h2>
        <form method="POST" action="">
            <div>
                <label for="nama">Name:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="asal_instansi">Institution:</label>
                <input type="text" id="asal_instansi" name="asal_instansi" required>
            </div>
            <div>
                <label for="testimoni">Testimonial:</label>
                <textarea id="testimoni" name="testimoni" required></textarea>
            </div>
            <div>
                <label for="foto">Photo URL:</label>
                <input type="url" id="foto" name="foto">
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>