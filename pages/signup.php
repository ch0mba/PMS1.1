<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login_styles.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Signup</header>
            <form action="../api/signup_data.php" method="post">
                <div class="field input">
                    <label for="username">Username </label>
                    <input type="text" name="username" placeholder="Danco Number DCL111" id="username" required>
                </div>
                <div class="field input">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname" required>
                </div>
                <div class="field input">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname" required>
                </div>
                <div class="field input">
                    <label for="department">Department</label>
                    <input type="text" name="department" id="department" required>
                </div>
                <div class="field input">
                    <label for="role">Role</label>
                    <select name ="role" id="role" required>
                        <option value="Administrator">Administrator</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Clerk">Clerk</option>
                        <option value="Production Manager">Production Manager</option>
                        <option value="Machine Operator">Machine Operator</option>
                        <option value="Data Analyst">Data Analyst</option>
                       
                    </select>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Submit" required>
                </div>
                <div class="links">
                    <a href="index.php">Login</a><br>
                    <a href="resetpassword.php">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>