
 <!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online-Shop-login</title>
    <link rel="stylesheet" href="{{asset('/css/login.css')}}">
 <form action="/success" method="POST">
    @csrf
    <div class="container" id="login">

        <div class="admin">
            <img src="./imgs/admin.png" alt="admin-logo">
        </div>

        <div class="inputs">
            <input type="text"  placeholder="Enter Username" name="username">
            <input type="password" placeholder="Enter password" name="password"> 
        </div>

<div class="forget">
    <input type="checkbox" id="check"><label for="check"> remember me!</label>
    <a href="#">Forget password</a>
</div>

<div class="buttons">
<a href="/"><input type="submit" value="Login"> </a>
<a type="submit" value="" onclick="showRegistration()">Sign-up</a>
</div>


    </div>
</form>
<form action="/registration" method="POST">
    @csrf
    <div class="regn" id="regn">
         <h2>Admin Registration</h2>
        <div class="inputs">
            <input type="text"  placeholder="Enter Name" name="name">
             <input type="number"  placeholder="Enter Mobile No" name="phone">
            <input type="text"  placeholder="Enter Username" name="username">
            <input type="password" placeholder="Enter password" name="password"> 
        </div>
 
<div class="buttons" id="back-btn">
 <span onclick="showLogin()">back</span>
 <input type="submit" name="" id="" value="register">
 
 </div>
    </div>
</form>

    <script > 
        function showLogin() {
    document.getElementById("login").style.display = "flex";
    document.getElementById("regn").style.display = "none";
}

function showRegistration() {
    document.getElementById("login").style.display = "none";
    document.getElementById("regn").style.display = "flex";
}

// Initially show the login form
showLogin();
    </script>
</body>

</html>