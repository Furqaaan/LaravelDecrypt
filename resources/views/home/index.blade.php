<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Decrypt Online | Laravel Crypt Facade Online | Laravel Encrypt Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        * {
            font-family: monospace;
        }

        .pageHeading {
            margin-top: 4%;
            margin-bottom: 30px;
            font-weight: bold;
            background: #f3f3f3;
            padding: 10px;
            border-bottom: 2px solid #ccc;
        }

        .decodeBtn button {
            font-weight: bold;
        }

        .toastify-top {
            text-transform: uppercase;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div class='container'>

        <h1 class='text-uppercase text-center pageHeading' title='Laravel Decrypt Online | Laravel Crypt Facade Online | Laravel Encrypt Online' alt='Laravel Decrypt Online | Laravel Crypt Facade Online | Laravel Encrypt Online'>Laravel Decrypt Online</h1>

        <div class='encodedTextContainer'>
            <label for="encodedText" class="form-label">Encrypted :</label>
            <textarea class="form-control" rows="5" name="encodedText" placeholder="Enter text to decrypt using the Crypt facade" style="padding:12px;"></textarea>
        </div>

        <div class="d-grid py-5 decodeBtn">
            <button type="button" class="btn btn-primary btn-block"><span class="spinner-border spinner-border-sm decodeBtnSpinner"></span>&nbsp;DECRYPT</button>
        </div>

        <div class='decodedTextContainer'>
            <label for="decodedText" class="form-label">Decyrpted :</label>
            <textarea class="form-control" rows="5" name="decodedText" placeholder="Enter text to encrypt using the Crypt facade" style="padding:12px;"></textarea>
        </div>

        <div class="d-grid py-5 encodeBtn">
            <button type="button" class="btn btn-success btn-block"><span class="spinner-border spinner-border-sm encodeBtnSpinner"></span>&nbsp;ENCRYPT</button>
        </div>

    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(()=>{

            $(".decodeBtnSpinner").hide();
            $(".encodeBtnSpinner").hide();

            $(".decodeBtn").on("click",()=>{

                let encodedText = $(".encodedTextContainer").find("textarea").val().trim();
                let encodeTextLength = encodedText.length;

                if(encodeTextLength >= 100) {
                    $(".btnSpinner").show();

                    $.ajax({
                        type: "POST",
                        url: "{{route('decryptText')}}",
                        data: {
                            encodedText,
                        },
                        success: function (response) {

                            if(response.code != 0) {
                                $(".decodedTextContainer").find("textarea").val(response);
                                showToastify("Text decoded successfully","#04AA6D");
                            }
                            else {
                                showToastify("Please enter a valid text to decrypt");
                                $(".decodedTextContainer").find("textarea").val("");
                            }

                            $(".decodeBtnSpinner").hide();
                        }
                    });
                }else{
                    showToastify("Please enter a valid text to decrypt");
                    $(".decodedTextContainer").find("textarea").val("");

                }
            });

             $(".encodeBtn").on("click",()=>{

                let decodedText = $(".decodedTextContainer").find("textarea").val().trim();
                let decodedTextLength = decodedText.length;

                if(decodedTextLength > 0) {
                    $(".encodeBtnSpinner").show();

                    $.ajax({
                        type: "POST",
                        url: "encryptText",
                        data: {
                            decodedText,
                        },
                        success: function (response) {

                            if(response.code != 0) {
                                $(".encodedTextContainer").find("textarea").val(response);
                                showToastify("Text encoded successfully","#04AA6D");
                            }
                            else{
                                showToastify("Please enter a valid text to encrypt");
                                $(".encodedTextContainer").find("textarea").val("");
                            }

                            $(".encodeBtnSpinner").hide();
                        }
                    });
                }else{
                    showToastify("Please enter a valid text to encrypt");
                     $(".encodedTextContainer").find("textarea").val("");
                }
            });

            function showToastify(msg,color="tomato") {
                Toastify({
                        text: msg,
                        duration: 2000,
                        destination: "#",
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: "right",
                        stopOnFocus: true,
                        style: {
                            background: color,
                        },
                        onClick: function(){}
                    }).showToast();
            }

        });
    </script>
</body>
</html>
