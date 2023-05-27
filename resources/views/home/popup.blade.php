<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Popup Page</title>
    <style>
        body{

            background-color: #B2D2A4  ;
        }
        .conta{
            width: 80%;
            height: 380px;
            margin: 27px auto;
            justify-content: center;
            align-items: center;
            font-size: 21px;
            letter-spacing: 1px;
            color: white;


        }

        .mycheckbox{
            display: block;
            margin-top: 0;
        }
        input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            margin-top: 0;
            color: darkgray;
        }
        button{

            width: 70%;
            padding: 10px 20px;

            color: white;
            border: none;
            cursor: pointer;
            background-color: #fd7e14;
            font-size: 22px;
            margin: 40px 50px;
        }
        h2{
            color: #fd7e14;

        }

    </style>
</head>
<body>
<div class="conta">
    <h2>Demande le Produite </h2>


    <form method="POST" action="{{ route('achatCreate') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" name="product_id" placeholder="Client Name" style="display: none" value="{{$product->id}}"><br><br>
        <p>
            -Afin d'obtenir ce produit, nous vous prions de nous fournir une ordonnance indiquant votre besoin</p>

        <input type="file" name="image"><br><br>
        <p>-Selon nos conditions, nous demandons que le produit soit retourné après que vous en avez fini de l'utiliser.</p>

        <div class="mycheckbox">
            <input type="checkbox" name="accept_terms" value="yes">
            J'accepte

        </div>
        <button type="submit">Envoie le demande</button>
    </form>

</div>



<script>
    function submitForm() {
        // Get the product ID from the URL
        var urlParams = new URLSearchParams(window.location.search);
        var product_id = urlParams.get('id');

        // Create a FormData object to store the form data
        var formData = new FormData();
        formData.append('product_id', product_id);
        formData.append('ordonnance', document.getElementById('ordonnance').files[0]);
        formData.append('accept_terms', document.querySelector('input[name="accept_terms"]:checked').value);

        // Send an AJAX request to submit the form
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/achats');
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Form submission successful, close the popup window
                window.close();
            } else {
                // Form submission failed, handle the error
                console.error(xhr.responseText);
            }
        };
        xhr.send(formData);
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("form").submit(function(event) {
            event.preventDefault(); // prevent the default form submission

            // Check if the user has uploaded the ordonnance and accepted the terms
            var ordonnance = $("input[name='image']").val();
            var accept_terms = $("input[name='accept_terms']:checked").val();

            if (!ordonnance || !accept_terms) {
                alert("Veuillez remplir le formulaire");
                return;
            }

            // Submit the form using AJAX
            var form = $(this);
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data) {
                    alert("Votre demande a été envoyée avec succès !");
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log("Error:", textStatus);
                }
            });
        });
    });
</script>

</body>
</html>
