<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Malawi Police- Statistics </title>
    <!-- tab icon-->
    <link rel="icon" type="image/x-icon" href="Assets/logo/logo.png" />
    <!-- CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Includes Jquery -->
    <script src="Script/jquery-3.5.1.min.js"></script>
    <script src="Script/jquery.validate.min.js"></script>
    <link href="Style/style.css" rel="stylesheet" />
</head>

<body>
    <div class="header">

        <!-- Full screeen alements -->
        <img class="profilepic" src="Resources/Profile Pic.jpg" alt="" srcset="">
        <span class="ProfileLabel">Precious Nyasulu</span>

        <a href="Statistics.html" class="statistics">
            <img src="Resources/icons8_pie_chart.svg" alt="" srcset="">
            <span>Statistics</span>
        </a>
        <span class="noti stat">1</span>

        <a href="Notifications.php" class="notifications">
            <img src="Resources/icons8_notification.svg" alt="" srcset="">
            <span>Notifications</span>
        </a>
        <span class="noti notif">0</span>

        <a href="index.php" class="policelogo">
            <img src="Resources/Malawi Police logo.jpg" alt="" srcset="">
        </a>
        <!-- end of fullscreeen elements -->

        <!-- mobile screeen elements -->
        <img class="menu-mobile" src="Resources/icons8_squared_menu.svg" alt="" srcset="">
        <span class="noti-mobile notif-mobile">0</span>

        <!-- Logout -->
        <a href="Logout.php" class="btn logout-mobile btn-primary">Logout</a>
    </div>

    <div class="statistics-container">
        <h4>SURVEY DATA ANALYSIS</h4>
        <!-- <div class="key">
            <span class="box-option">At Night</span>
            <span class="box-option">During day time</span>
            <span class="box-option">During holidays</span>
        </div>
        <div class="piechart">
            <svg width="200" height="200">
                <circle cx="100" cy="100" r="100" fill="#BABDBD" />
            </svg>
        </div> -->
        <?php
            $stats = true;
            include "Analysis/Analysis-Gender.php";
            echo"<br>";
            include "Analysis/Analysis-District.php"
            ?>
    </div>

    <!-- Mobile SlideBar -->
    <div class="SlideBar">
        <img class="cancel" src="Resources/icons8_multiply.svg" alt="">
        <img class="profilepic-mobile" src="Resources/Profile Pic.jpg" alt="" srcset="">
        <hr>
        <a href="index.php">Home</a>
        <a href="Statistics.html" class="Statistics-mobile">Statistics</a>
        <a href="Notifications.php" class="Notifications-mobile">Notifications</a>
        <a href="Logout.php" class="btn btn-primary">Logout</a>
    </div>
    
</body>

<Script type="text/javascript">
$(document).ready(function() {
setInterval(loadnotification,3000);
    function loadnotification() {
            $.ajax({
                url: 'LoadDetails.php',
                method: "POST",
                data: { username: '' },
                dataType: "json",
                success: function (data) {
                    if (data.notnum != 0) {
                        $('.notif').text(data.notnum);
                        $('.noti-mobile').text(data.notnum);
                        // alert(data.notnum);
                    } else {
                        $('.notif').hide();
                        $('.noti-mobile').hide();
                        // alert(data.notnum);
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    alert(errorMessage);
                }
            });
        }


    $.ajax({
        url: 'LoadDetails.php',
        method: "POST",
        data: {
            username: ''
        },
        dataType: "json",
        success: function(data) {
            if (data.notnum != 0) {
                $('.notif').text(data.notnum);
            } else {
                $('.notif').hide();
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            alert(errorMessage);
        }
    });

    // sildebar in
    $('.menu-mobile').click(function() {
        $('.SlideBar').css("left", "0px");
        $('.header, .survey, .recent').css('filter', 'blur(2px)');
        $('.profilepic').css('opacity', '0%');
    });

    // slidebar out
    $('.cancel').click(function() {
        $('.SlideBar').css("left", "-70%");
        $('.header, .survey, .recent').css('filter', 'none');
        $('.profilepic').css('opacity', '100%');
    });
});
</Script>

</html>