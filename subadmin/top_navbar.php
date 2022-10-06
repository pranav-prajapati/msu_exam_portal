

<style>
 .button3 {
  
  color: black; 

}

.button3:hover {

  color:  #f44336;;
}
</style>
<div class="container-fluid">
    <nav class="navbar sticky-top navbar-light bg-light justify-content-between" style="height: 50px;">
        <a style=" text-decoration: none; color:#4682B4; font-size:13px;" href="change_password.php"><i class="fas fa-unlock-alt"></i> UPDATE YOUR PASSWORD</a>
        <form class="form-inline">
            <i class="far fa-clock"><?php
                                    echo " " . date("d/m/Y") . " "; ?></i>
            <i class="fas fa-2x fa-chalkboard-teacher"></i>

            <b><h7 class="center"><?php echo $_SESSION['username'] ?></h7></b>
            
            <a style=" color: #921313;" href="../partials/logouthandler.php">
            <i class="mx-3 ml-5 button3 fa-2x fas fa-power-off"  style="cursor: pointer;"></i>
            </a>
        </form>
    </nav>
</div>