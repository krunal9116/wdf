<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login</title>
<link rel="stylesheet" href="css/style.css"></head>
<body>
<div class="container">
  <h2>Login</h2>
  <form method="post" action="/actions/authenticate.php">
    <label>Email<br><input type="email" name="email" required></label><br>
    <label>Password<br><input type="password" name="password" required></label><br>
    <label><input type="checkbox" name="remember"> Remember me</label><br>
    <button class="btn" type="submit">Login</button>
  </form>
</div>
</body></html>
