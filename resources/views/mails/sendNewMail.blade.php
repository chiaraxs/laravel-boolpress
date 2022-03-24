<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>
      
    <h1>You have a new message!</h1>

      <p>From: {{$newContactInfo->name}}</p>
      <p>Email: {{$newContactInfo->email}}</p>
      <p>Message for you: {{$newContactInfo->message}}</p>

    </ul>
  
  </body>
</html>