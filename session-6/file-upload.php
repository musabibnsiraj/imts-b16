<!DOCTYPE html>
<html>

<body>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: Arial, sans-serif;
            background: #f3f6fb;
        }

        .upload-card {
            width: min(90%, 420px);
            padding: 2rem;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(31, 45, 61, .12);
        }

        .upload-card h1 {
            margin-top: 0;
            color: #1f2937;
        }

        .upload-card p {
            color: #6b7280;
        }

        .upload-card label {
            display: block;
            margin: 1.25rem 0 .5rem;
            font-weight: bold;
            color: #374151;
        }

        .upload-card input[type="file"] {
            width: 100%;
            box-sizing: border-box;
            padding: .75rem;
            border: 1px dashed #9ca3af;
            border-radius: 8px;
            background: #f9fafb;
        }

        .upload-card input[type="submit"] {
            width: 100%;
            margin-top: 1.25rem;
            padding: .8rem;
            border: 0;
            border-radius: 8px;
            color: #fff;
            background: #2563eb;
            cursor: pointer;
            font-weight: bold;
        }

        .upload-card input[type="submit"]:hover {
            background: #1d4ed8;
        }
    </style>

    <!-- multipart/form-data is required so the selected file is included in the POST request. -->
    <form class="upload-card" action="script/upload.php" method="post" enctype="multipart/form-data">
        <h1>Upload an image</h1>
        <p>Select an image from your device to upload.</p>
        <label for="fileToUpload">Choose image</label>
        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" required>
        <input type="submit" value="Upload Image" name="submit">
    </form>

</body>

</html>