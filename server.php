<?php 
session_start();

//------ PHP code for User registration form---
$error = "";
$error2 = "";

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));


if (array_key_exists("new-submit", $_POST)) {
 
     // Database Link
    include('linkdb.php');  
 
    //Taking HTML Form Data from User
    $name = mysqli_real_escape_string($linkdb, $_POST['new_username']);
    $email = mysqli_real_escape_string($linkdb, $_POST['new_email']);
    $password = mysqli_real_escape_string($linkdb,  $_POST['password']); 
    
     
    // PHP form validation PHP code
    if (!$name)
    {
        echo "<script> alert('Name is Required.');

        location='signup.php';  
         
         </script>";
    //  $error .= "Name is required <br>";
     }
    if (!$email) {
        echo "<script> alert('Email is Required.');
      

        location='signup.php';  
         
         </script>";
       // $error .= "Email is required <br>";
     }
    if (!$password) {

        echo "<script> alert('Password is Required.');
       location='signup.php';  

       </script>";
       // $error .= "Password is required <br>";
     } 
    //  if(empty($_POST['agree-term']))
    //    {
    //     echo "<script> alert('Please Agree to terms and conditions');
    //     location='signup.php';  
 
    //     </script>";
    // //    }
    // //  if ($error) {
    // //     $error = "<b>There were error(s) in your form!</b> <br>".$error;
    //  } 
     else {
       
        //Check if email is already exist in the Database
 
        $query = "SELECT id FROM user WHERE email = '$email'";
        $result = mysqli_query($linkdb, $query);
        $queryx = "SELECT id FROM user WHERE 'name' = '$name'";
        $resultx = mysqli_query($linkdb, $query);
        if (mysqli_num_rows($result) > 0)
        {
            
            echo "<script> alert('Account Alerady Exists.'); 

           location='index.php';  
            
            </script>";
         
              
              //$error .="<p>Your email has taken already!</p>";
        }
        elseif (mysqli_num_rows($resultx) > 0)
        {
            
            echo "<script> alert('Username Alerady Exists.'); 

           location='index.php#triply-login-form';  
            
            </script>";
         
              
              //$error .="<p>Your email has taken already!</p>";
        }
        else {
 

            //Password encryption or Password Hashing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
            $query = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
            
             
            if (!mysqli_query($linkdb, $query)){
                $error ="<p>Could not sign you up - please try again.</p>";
                } 
                else {
 
                    //session variables to keep user logged in
                $_SESSION['id'] = mysqli_insert_id($linkdb);  
                $_SESSION['user_name'] = $name;
 
                //Setcookie function to keep user logged in for long time
                // if ($_POST['remember-me'] == '1') {
                // setcookie('id', mysqli_insert_id($linkDB), time() + 60*60*365);
                // echo "<p>The cookie id is :". $_COOKIE['id']."</P>";
                // }
                  
                //Redirecting user to home page after successfully logged in 
                //header("Location: login.php");  
                echo "<script>
              location='index.php';  
         
              </script>";
              
             

          }
          
            }
 
        }  
    
      }
      //-------User Login PHP Code ------------
 
if (array_key_exists("login_submit", $_POST)) {
     
    // Database Link
    include('linkdb.php'); 
 
      //Taking form Data From User
      $email_user = mysqli_real_escape_string($linkdb, $_POST['email_user']);
      $password = mysqli_real_escape_string($linkdb,  $_POST['login_pw']); 
       
      //Check if input Field are empty
      if (!$email_user) {
          //$error2 .= "Email is required <br>";
          
        echo "<script> alert('Username or Email is Required.');
        location='index.php#triply-login-form';  
 
        </script>";
       }
      if (!$password) {
        echo "<script> alert('Password is Required.');
        location='index.php#triply-login-form';  
 
        </script>";
          //$error2 .= "Password is required <br>";
       } 
       if ($error2) {
        echo "<script> alert('There were error(s) in your form.');
        location='index.php#triply-login-form';  
 
        </script>";
          //$error2 = "<b>There were error(s) in your form!</b><br>".$error2;
       }
       
        
      else {        
          //matching email and password
 
            $query = "SELECT * FROM user WHERE email='$email_user'";
            $result = mysqli_query($linkdb, $query);
            $row = mysqli_fetch_array($result);

            $queryx = "SELECT * FROM user WHERE name='$email_user'";
            $resultx = mysqli_query($linkdb, $queryx);
            $rowx = mysqli_fetch_array($resultx);

            $pass = $row['password'];

            if($pass == null) {
              $pass = $rowx['password'];
            }
         
            if (isset($row) || isset($rowx)) {
                if (password_verify($password, $pass)) 
                {

                    //session variables to keep user logged in
                    $_SESSION['id'] = $row['id'];  
 
                      //Logged in for long time untill user didn't log out
                    // if (isset($_POST['remember-me'])) 
                    // {
                    // setcookie('id', $row['id'], time() + 60*60*24); //Logged in permanently
                    // }
                     
                   // header("Location: ../recyclo_after/recyclocart.nicepage.io/Home.html"); //*Change header
                   echo "<script>
                   location='index.php#triply-login-form';  
              
                   </script>";
                   
 
                } else {
                    //$error2 = "Combination of email/password does not match!";
                    echo "<script> alert('Combination of email/password does not match.');
                    location='index.php#triply-login-form';  
             
                    </script>";
                     }
   
            }  else {
              //  $error2 = "Combination of email/password does not match!";
                echo "<script> alert('Combination of email/password does not match.');
                    location='index.php#triply-login-form';  
             
                    </script>";
                 }
        }
}

?>
