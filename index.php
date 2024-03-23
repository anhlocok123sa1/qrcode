<?php //session_start();?>
<html>
    <head>
<script type="text/javascript" src="js/adapter.min.js"></script>
<script type="text/javascript" src="js/vue.min.js"></script>
<script type="text/javascript" src="js/instascan.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
    
        <div class="container">
        <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
            </div>
            <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="#">Page 1-1</a></li>
                <li><a href="#">Page 1-2</a></li>
                <li><a href="#">Page 1-3</a></li>
                </ul>
            </li>
            <li><a href="#">Page 2</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
        </nav>
       
            <div class="row">
                <div class="col-md-6">
                    <video id="preview" width="100%"></video>
					
                </div>
				
                <div class="col-md-6">
                <form action="insert1.php" method="post" class="form-horizontal">
                     <label>SCAN QR CODE</label>
                    <input type="text" name="text" id="text" readonly placeholder="scan qrcode" class="form-control">
                </form>
                  <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>STUDENT ID</td>
                            <td>TIMEIN</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $server = "localhost";
                        $username="root";
                        $password="";
                        $dbname="qrcodedb";
                    
                        $conn = new mysqli($server,$username,$password,$dbname);
                    
                        if($conn->connect_error){
                            die("Connection failed" .$conn->connect_error);
                        }
                           $sql ="SELECT ID,STUDENTID,TIMEIN FROM table_attendance WHERE DATE(TIMEIN)=CURDATE()";
                           $query = $conn->query($sql);
                           while ($row = $query->fetch_assoc()){
                        ?>
                            <tr>
                                <td><?php echo $row['ID'];?></td>
                                <td><?php echo $row['STUDENTID'];?></td>
                                <td><?php echo $row['TIMEIN'];?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>

        <script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
               } else{
                   alert('No cameras found');
               }

           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('text').value=c;
               document.forms[0].submit();
           });
        </script>
    </body>
</html>