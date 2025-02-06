<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>QR Code Scanner</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>


<body>
    <div class="container mt-5">
        <h1 class="text-center">QR Code Scanner</h1>
        <div id="qr-reader" style="width: 500px; margin: auto;"></div>
        <div class="text-center mt-3">
            <button class="btn btn-primary" onclick="startScanner()">Start Scanner</button>
            <button class="btn btn-danger" onclick="stopScanner()">Stop Scanner</button>
        </div>
        <div class="text-center mt-3">
            <h5>Scanned Result:</h5>
            <div id="qr-reader-results"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var lastResult = "";
            var countResults = 0;

            function onScanSuccess(decodedText) {
                if (decodedText !== lastResult) {
                    countResults++;
                    lastResult = decodedText;

                    $("#qr-reader-results").html("<strong>Scanned Data:</strong> " + decodedText);

                    try {
                        var data = JSON.parse(decodedText);
                        var name = data.name;
                        var nip = data.nip;
                        var password = data.password;

                        if (name && nip && password) {
                            $("#qr-reader-results").append("<br><strong>Name:</strong> " + name +
                                "<br><strong>NIP:</strong> " + nip);

                            $.ajax({
                                url: "/scan-qr-code",
                                method: 'POST',
                                data: {
                                    name: name,
                                    nip: nip,
                                    password: password,
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    console.log("Server Response:", response);
                                    if (response.redirect_url) {
                                        window.location.href = response.redirect_url;
                                    } else {
                                        $("#qr-reader-results").append(
                                            "<br><span class='text-warning'>No redirection URL provided.</span>"
                                        );
                                    }
                                },
                                error: function(xhr) {
                                    console.error("AJAX Error:", xhr);
                                    var errorMessage = xhr.responseJSON ? xhr.responseJSON.message :
                                        "Unknown error occurred.";
                                    $("#qr-reader-results").append(
                                        "<br><span class='text-danger'>Error: " + errorMessage +
                                        "</span>");
                                }
                            });
                        } else {
                            $("#qr-reader-results").append(
                                "<br><span class='text-danger'>Invalid data format.</span>");
                        }
                    } catch (e) {
                        console.error("JSON Parsing Error:", e);
                        $("#qr-reader-results").append(
                            "<br><span class='text-danger'>Invalid QR Code format.</span>");
                    }
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
                fps: 10,
                qrbox: 250
            });
            html5QrcodeScanner.render(onScanSuccess);
        });
    </script>

</body>

</html>
