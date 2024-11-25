
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>API Graph Facebook</title>
  </head>
  <body>
    <label for="">Comentario</label>
    <input type="text">
    <button>Enviar</button>
    <script>

        

      window.fbAsyncInit = function () {
        FB.init({
          appId: "5418457015944400",
          xfbml: true,
          version: "v21.0",
        });

        FB.api(
          "1269110071000190/posts",
          "GET",
          {
            access_token:
              "EAASCP7b2fH4BOzQ5lo3g8n7bqADVQEYptKRJzXDrBEzQZB7syLmiwbEBT3DoN6G14AsKXZAZBdCDcI2hgp4f1eSpFBJgwYgYtZBG5drETAZCpOLoykvVBX4MgLKGXd2baRXyDkKTvaZBCEkvEZCbY98k7DM1zLwc9hgFaU44Aw81nVetYzFoBbvHeQyBmiXEcqfEA0RjWHW6OmqSOUvkTPNZA9Lbt5yZCRnKbvrwTFyns3SErg9EfmcmOvJKEDBmb",
          },
          function (response) {
            if (response && !response.error) {
              console.log(response);
            } else {
              console.log("error");
            }
          }
        );

        FB.api(
          "1269110071000190/feed",
          "POST",
          {
            message: "Hola desde JS 2",
            access_token:
              "EAASCP7b2fH4BOzQ5lo3g8n7bqADVQEYptKRJzXDrBEzQZB7syLmiwbEBT3DoN6G14AsKXZAZBdCDcI2hgp4f1eSpFBJgwYgYtZBG5drETAZCpOLoykvVBX4MgLKGXd2baRXyDkKTvaZBCEkvEZCbY98k7DM1zLwc9hgFaU44Aw81nVetYzFoBbvHeQyBmiXEcqfEA0RjWHW6OmqSOUvkTPNZA9Lbt5yZCRnKbvrwTFyns3SErg9EfmcmOvJKEDBmb",
          },
          function (response) {
            if (response && !response.error) {
              console.log("post", response);
            } else {
              console.log("error");
            }
          }
        );
      };
    </script>
    <script
      async
      defer
      crossorigin="anonymous"
      src="https://connect.facebook.net/en_US/sdk.js"
    ></script>
  </body>
</html>
