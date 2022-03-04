<?php
require_once "header.php"
?>
    <body>
        <div class="wrapper">
            <section class="form login">
                <header>Chat US</header>
                <form action="#">
                    <div class="error-txt"></div>
                        <div class="field input">
                            <label>Email Address</label>
                            <input type="text" name="email" placeholder="Email">
                        </div>
                        <div class="field input">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="field button">
                            <input type="submit" value="continue to chat">
                        </div>
                    
                </form>
                <div class="link">New to us ?<a href="index.php">signup</a></div>
            </section>
        </div>
        <script src="javascript/pass-show-hide.js"></script>
        <script src="javascript/login.js"></script>
        
    </body>
