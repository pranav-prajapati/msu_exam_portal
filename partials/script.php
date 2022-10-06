<script src="../js/sweetalert.js"> </script>

<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') { ?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status']; ?>",
            // text: "You clicked the button!",
            icon: "<?php echo $_SESSION['status-code']; ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php
    unset($_SESSION['status']);
}

?>

<!-- <script>
        swal({
          title: "Hello world",
          text: "You clicked the button!",
          icon: "success",
          showConfirmButton: false,
          timer: 1500
        });
      </script> -->

