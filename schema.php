<!DOCTYPE html>
<html>
<?php
session_start();
require_once('../db_connection.php');

  
//these two line are about showing articles for the first time
//$query = "SELECT * FROM articles ORDER BY RAND()";
//$response = @mysqli_query($connection, $query);


//$logged = 0;
$caption = "Log In";
$logging_link = "login.php";
$button = "Register to get points!";
$button_link = "register.php";
//$user_status = -1;
//$userID = -1;

//if (isset($_SESSION['logged'])) {
 //   if ($_SESSION['logged'])
 //       $logged = 1;
//}

if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    $logged = 1;
    $userID = $_SESSION['user_id'];
    $login_details = "SELECT * FROM users where user_id={$userID}";
    $login_response = @mysqli_query($connection, $login_details);

    if ($login_response) {
        $user_record = mysqli_fetch_array($login_response);
        $user_status = $user_record['status'];
        $username = $user_record['username'];
        $points = $user_record['total_points'];

        if ($user_status) {
            $caption = "Log Out";
            $logging_link = "login.php";
            $button = $username . " | Points:" . $points;
            //$button = "$username";
            //$button_link = "profile.php";
            $button_link = "mypoints.php";
        }else 
          	echo "no response " . mysqli_errno($connection);

    } 
}else {
        $caption = "Log In";
        $logging_link = "login.php";
        $button = "Register to get points!";
        $button_link = "register.php";
        $logged = 0;
        $user_status = -1;
        $userID = -1;
 }
 
 ////////////////////////////////////////////no shuffle//////////////////////
 if($logged == 1){
   
            $order_group_number = $userID % 8;
            switch($order_group_number){
              case 0:
                $query = "SELECT * FROM articles ORDER BY name ASC";
                break;
              case 1:
                $query = "SELECT * FROM articles ORDER BY category ASC";
                break;
              case 2:
                $query = "SELECT * FROM articles ORDER BY topic ASC";
                break;
              case 3:
                $query = "SELECT * FROM articles ORDER BY source ASC";
                break;
              case 4:
                $query = "SELECT * FROM articles ORDER BY name DESC";
                break;
              case 5:
                $query = "SELECT * FROM articles ORDER BY category DESC";
                break;
              case 6:
                $query = "SELECT * FROM articles ORDER BY topic DESC";
                break;
              default:
                $query = "SELECT * FROM articles ORDER BY source DESC";
                break;
            }
   
}else{
  // when user hasn't logged in, the article is in shuffle situation
  $query = "SELECT * FROM articles ORDER BY RAND()"; 
}
$response = @mysqli_query($connection, $query);
/////////////////////
 
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>schema</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
  <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
  <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
  <link rel="stylesheet" href="assets/css/Footer-Basic.css">
  <link rel="stylesheet" href="assets/css/Footer-Dark.css">
  <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
  <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/untitled.css">
  <link rel="stylesheet" href="assets/css/styles_2019_version.css">
  <link rel="stylesheet" href="assets/css/jquery.range.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
</head>

<body>
  <div id="nav" >
    <nav class="navbar navbar-light navbar-expand-md fixed-top navigation-clean-button has-pattern" >
      <div class="container-fluid">
        <div class="logo pull-left">
          <a class="navbar-brand" href="schema.php">
            <img class="logo" src="assets/img/news.png" id="logo-img">
            <span>MyNewsScan</span>
          </a>
        </div>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navcol-1">
              <!--<span> <a href="schema.php" id = "version_entry">Another Version</a> </span>-->
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item dropdown" role="presentation"><a class="nav-link" href="#" id="aboutUs">About Us</a>
                  <div class="dropdown-content">
						<a href="aboutus.php#rewardSystem">Reward System</a>
						<a href="aboutus.php#contactUs">Contact Us</a>
						<a href="aboutus.php#anotherAboutUs">About Us</a>
                  </div></li>
                  <!--<li class="nav-item" role="presentation"><a class="nav-link" href="#" id="contact">Contact</a></li>-->
              </ul><span class="navbar-text actions"> <a href="<?php echo $logging_link;?>" id="login" class="login"><?php echo $caption;?> </a> <a class="btn btn-light action-button" role="button" id="loginButton" href="<?php echo $button_link;?>"><?php echo $button;?>
              </a></span></div>
</div>
    </nav>
  </div>

      <div class="row mx-auto" style="margin-top:45px;padding:0px; ">
          <div class="col-2 has-pattern" id="filtercol" style="width:auto;">
              <div class="row" id="topics">
                <div class="col">
                  <p><strong>Topics</strong></p>
                  <p class="checks" id="tech"><input type="checkbox" id="techn" checked> Technology</p>
                  <p class="checks" id="tech"><input type="checkbox" id="edu" checked> Education</p>
                  <p class="checks" id="tech"><input type="checkbox" id="health" checked> Health & Nutrition</p>
                  <p class="checks" id="tech"><input type="checkbox" id="society" checked> Society & Culture</p>
                  <p class="checks" id="tech"><input type="checkbox" id="envir" checked> Environment</p>
                  <p class="checks" id="tech"><input type="checkbox" id="business" checked> Business & Finance</p>
                </div>
              </div>
              <div class="row" id="category">
                <div class="col">
                  <p><strong>Category</strong></p>
                  <p class="checks" id="tech"><input type="checkbox" id="news" checked> News</p>
                  <p class="checks" id="tech"><input type="checkbox" id="advice" checked> Advice</p>
                  <p class="checks" id="tech"><input type="checkbox" id="analysis" checked> Analysis</p>
                  <p class="checks" id="tech"><input type="checkbox" id="interview" checked> Interview</p>
                  <p class="checks" id="tech"><input type="checkbox" id="discussion" checked> Discussion</p>
                  <p class="checks" id="tech"><input type="checkbox" id="chronicle" checked> Chronicle</p>
                </div>
              </div>

            <div class="row" id="length">
                <div class="col">
                  <p id="slider_title"><strong>Reading Time</strong></p><br/>
                  <div style="margin-left:10px;">
                  	<input type="hidden" class="range-slider" id="range_slider" value="60" />
                  	<button onclick="createArticles(this.id)" class="btn btn-light active" type="button" id="filter">Filter</button>
                  </div>
                </div>
              </div>
          </div>

          <div class="col-10" id="col-3">
              <div class="row" style="height:300px;">
                  <div class="col-9" style="height:350px;">
                      <div class="carousel slide" data-ride="carousel" id="carousel-1" style="margin:0px 0px 0px 0px;height:350px;">
                          <div class="carousel-inner" role="listbox">
                              <div class="carousel-item active"><img class="w-100 d-block" src="assets/img/geometric-1732847_960_720.jpg" alt="Slide Image" style="width:100%;height:300px;"><div class="carousel-caption d-none d-md-block">

                              <h5>"If the human brain were so simple that we could understand it, we would be so simple that we couldn’t."- Emerson M. Pugh</h5>
                              <!-- <p>We research in neuroscience.</p> -->
                            </div></div>
                              <div class="carousel-item"><img class="w-100 d-block" src="assets/img/sunrise-1756274_960_720.jpg" alt="Slide Image" style="height:300px;"><div class="carousel-caption d-none d-md-block">
                                <h5>Research needs your contribution</h5>
                                <h5>Help us collect data for research in neuroscience of decision making</h5>
                              </div></div>
                              <div class="carousel-item"><img class="w-100 d-block" src="assets/img/space-1572212_960_720.png" alt="Slide Image" style="height:300px;"><div class="carousel-caption d-none d-md-block">
                              <p style="font-size:1.1rem;"><br>You can earn points by reading articles and answering questions below them. You earn 2 points by opening each article. For answering the questions you earn points equal to the number of answered general questions (e.g. how useful do you think the article is) multiplied by the number of correctly answered specific questions about each article. Longer articles have more such questions. You can answer multiple times - only your best score for each article counts. In the future you will be able to convert points to various rewards.</p>
                            </div></div>
                          </div>
                          <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1"
                                  role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
                          <ol class="carousel-indicators">
                              <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                              <li data-target="#carousel-1" data-slide-to="1"></li>
                              <li data-target="#carousel-1" data-slide-to="2"></li>
                          </ol>
                      </div>
                  </div>

                  <div class="col-3" style="overflow-y:scroll; height:300px;">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover table-dark">
                              <thead>
                                  <tr>
                                      <th>Username</th>
                                      <th>Points</th>
                                  </tr>
                              </thead>
                              <tbody>

                                <?php
                                //leader borar section
                                $top_users = "SELECT username, total_points FROM users WHERE total_points !=0 ORDER BY total_points DESC LIMIT 100";
                                $top_users_response = @mysqli_query($connection,$top_users);

                                while ($row_top = mysqli_fetch_array($top_users_response)) {
                                  $un   = $row_top['username'];
                                  $tp = $row_top['total_points'];
                                  echo "<tr><td style=\"font-size:16px; height: 16px; line-height: 16px;\">".$un."</td><td style=\"font-size:16px; height:16px; line-height: 16px;\">".$tp."</td></tr>";
                                }

                                ?>


                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>

              <div id="gridcon" style="margin-top:0px;">
                  <div class="row" id="gridRow">
                    <?php
                      if($response) {
						$color_flag=0;
                      while($row = mysqli_fetch_array($response)){
                        
                        $color_flag ++;
    			if($color_flag%2==0){
        		$bg_color='#DEEACD';
    			}else{
        			$bg_color='#EAE3CD';
  					  }
                        
                      ?>
                     
                       <div class="col-3 columnDesc" id="colGrid" >
                          <a class="links schema_article_title" href="ArticlePage.php?id=<?php echo urlencode($row['id']); ?>">
                            <?php echo stripslashes($row['name']); ?>
                          </a>
                          <h6>  <?php echo '<div style="Color: #6D1275">  <i><e>from</e></i> '  . "{$row['source']}" . '</div>' ; ?> </h6>
                            <tr class="description">
                              <td> <i class="ion-clock"></i><?php echo " {$row['reading_time']}"; ?> mins</td>
                              <td> <div style="Color: #343a40"> <?php echo "{$row['topic']}" ;?> </div></td>
                              <td> <?php echo "{$row['category']}"; ?> </td>             
                            </tr>
                            <br>
                         </div>


                          <?php
                            }
                            }
                            else{
                                echo  "Could not issue DB query";
                                echo mysqli_errno($connection);
                            }?>

                      </div>
                  </div>
              </div>
          </div>


      <div class="footer-basic">
        <footer>
          <div class="row">
            <div class="col-sm-6 col-md-4 footer-navigation">
                <br>
                <img src="assets/img/neuro-header.png" id="edinburgh">
                <br><br>
                <img src="assets/img/informatics_logo.gif" id="informatics">
            </div>              
            <div class="col-sm-6 col-md-4 footer-contacts">
                <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                  <p id="address"><span class="new-line-span">1 George Square&nbsp;</span> Edinburgh, United Kingdom</p>
                </div>
                <div><i class="fa fa-phone footer-contacts-icon"></i>
                  <p id="number" class="footer-center-info email text-left"><br>+447766706580<br><br></p>
                </div>
                <div><i class="fa fa-envelope footer-contacts-icon"></i>
                  <p id="email"> <a href="#" target="_blank" style="color:#82649c;"><br>gedi.luksys@ed.ac.uk<br>ahsun.tariq@gmail.com<br></a></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-4 footer-about">
                <h4>About the project</h4>
                <p><br>MyNewsScan is a meta-news project, currently under development, headed by Dr. Gedi Luksys and Dr. Robin Hill from the University of Edinburgh and run by UoE graduates Ahsun Tariq, Mariana Martinez Juarez, Yiyun Zhu, Zhewen Du, Jiachen Cai. Its main purpose is to provide useful and high quality news selection of various topics to international readers. At the same time we aim to collect readers' feedback about the articles that will facilitate our research on the role of schemas on learning, decision making, and more generally on how factors such as perceived news accuracy, familiarity and usefulness affect their performance and popularity.

MyNewsScan is not a commercial entity. Any questions or enquiries should be addressed to the email addresses on left.&nbsp;<br><br></p>
                  <div class="social-links social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-github"></i></a></div>
                </div>
              </div>
            </footer>
          </div>
          <script src="assets/js/jquery.min.js"></script>
          <script src="assets/bootstrap/js/bootstrap.min.js"></script>
		  <script
  			src="https://code.jquery.com/jquery-3.4.1.min.js"
  			integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  			crossorigin="anonymous"></script>
		  <script src="assets/js/jquery.range.js"></script>
  
       <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
      <script>
      window.cookieconsent.initialise({
        "palette": {
          "popup": {
            "background": "#64386b",
            "text": "#ffcdfd"
          },
          "button": {
            "background": "#f8a8ff",
            "text": "#3f0045"
          }
        },
        "theme": "classic",
        "position": "bottom-right",
      "content": {
        "message": "Our site uses cookies and collects information such as your IP address, location, device ID, and browsing patterns for the purpose of scientific research of human behaviour as well as to improve user experience at MyNewsScan. No information collected here will be used for commercial purposes. In compliance with data protection laws, we ask for your consent of such use. If you disagree, please leave the site now.",
        "dismiss": "Agree",
        "link": "More details",
        "href": "https://www.termsfeed.com/blog/gdpr-notice/"
      }
      });
      </script>
        </body>
		<script>
            $('.range-slider').jRange({
   				 from: 0,
   				 to: 60,
   				 step: 1,
			     scale: [0,30,60],
  				 format: '%s',
  				 width: 120,
   				 showLabels: true,
    			 isRange : true,
                 theme: 'theme-blue'
			});
        </script>

        <script>
        function createArticles(id){
          var techn = document.getElementById("techn").checked;
          var edu = document.getElementById("edu").checked;
          var health = document.getElementById("health").checked;
          var society = document.getElementById("society").checked;
          var envir = document.getElementById("envir").checked;
          var business = document.getElementById("business").checked;
          var news= document.getElementById("news").checked;
          var advice = document.getElementById("advice").checked;
          var analysis = document.getElementById("analysis").checked;
          var interview = document.getElementById("interview").checked;
          var discussion = document.getElementById("discussion").checked;
          var chronicle = document.getElementById("chronicle").checked;
          
          
          //get the range of reading time
          var reading_time_string = $("#range_slider").val().split(",");
          var reading_time_low = parseInt(reading_time_string[0]);
          var reading_time_high = parseInt(reading_time_string[1]);
          

          // var checkboxArray = [techn, edu, health, news, advice, analysis, interview, discussion, short, medium, long];
          var count=0;
          // checkboxArray.forEach(function(entry) {
          //   console.log(entry);
          // });

          var grid = document.getElementById("gridRow");
          grid.remove();
          var grid = document.createElement("div");
          grid.setAttribute("id","gridRow");

          var gridcon = document.getElementById("gridcon");
          gridcon.appendChild(grid);
          document.getElementById("gridRow").classList.add('row');
          var index = 0;
          <?php
          //$query = "SELECT * FROM articles ORDER BY RAND()";//!!!!!!!!!!!!!!!!!!!1
          //$response= @mysqli_query($connection,$query);//!!!!!!!!!!!!!!!!!!!!!!shuffle
          if($logged == 1){
            
            $order_group_number = $userID % 8;
            switch($order_group_number){
              case 0:
                $query = "SELECT * FROM articles ORDER BY name ASC";
                break;
              case 1:
                $query = "SELECT * FROM articles ORDER BY category ASC";
                break;
              case 2:
                $query = "SELECT * FROM articles ORDER BY topic ASC";
                break;
              case 3:
                $query = "SELECT * FROM articles ORDER BY source ASC";
                break;
              case 4:
                $query = "SELECT * FROM articles ORDER BY name DESC";
                break;
              case 5:
                $query = "SELECT * FROM articles ORDER BY category DESC";
                break;
              case 6:
                $query = "SELECT * FROM articles ORDER BY topic DESC";
                break;
              default:
                $query = "SELECT * FROM articles ORDER BY source DESC";
                break;
            }
            
}else{
  // when user hasn't logged in, the article is in shuffle situation
  $query = "SELECT * FROM articles ORDER BY RAND()"; 
}
$response = @mysqli_query($connection, $query);

          if($response) {
            $i=0;
            while($row = mysqli_fetch_array($response)){
              ?>

              var topic = "<?php echo "{$row['topic']}"; ?>";
              var category = "<?php echo "{$row['category']}"; ?>";
              var reading_time = parseInt("<?php echo "{$row['reading_time']}"; ?>"); //note: it must be number not string

              sessionStorage.clear();
              
              sessionStorage.readingtimelow = reading_time_low;
        	  sessionStorage.readingtimehigh = reading_time_high;
              
              var topic_array = [];
              if(techn)
              topic_array.push("Technology");
              else
              sessionStorage.technology=0;

              if(edu)
              topic_array.push("Education");
              else
              sessionStorage.edu=0;

              if(health)
              topic_array.push("Health & Nutrition");
              else
              sessionStorage.health=0;
              
              if(society)
              topic_array.push("Society & Culture");
              else
              sessionStorage.society=0;
              
              if(envir)
              topic_array.push("Environment");
              else
              sessionStorage.envir=0;
              
              if(business)
              topic_array.push("Business & Finance");
              else
              sessionStorage.business=0;


              var category_array = [];
              if(news)
              category_array.push("News");
              else
              sessionStorage.news=0;

              if(advice)
              category_array.push("Advice");
              else
              sessionStorage.advice=0;

              if(analysis)
              category_array.push("Analysis");
              else
              sessionStorage.analysis=0;

              if(interview)
              category_array.push("Interview");
              else
              sessionStorage.interview=0;

              if(discussion)
              category_array.push("Discussion");
              else
              sessionStorage.discussion=0;
              
              if(chronicle)
              category_array.push("Chronicle");
              else
              sessionStorage.chronicle=0;


              if( (topic_array.length==0) || (category_array.length==0) ){
                if(count==0)
                alert("Please select at least one from each topic and category.");
                count++;
              }
              else{

                topic_array.forEach(function(key_topic) {
                  category_array.forEach(function(key_category) {

                      console.log(key_topic+"-"+key_category + "\n");
                      if ((topic == key_topic) && (category == key_category) &&
                        (reading_time >= reading_time_low && reading_time <= reading_time_high) ) {

                        var newGrid = document.createElement("div");
                        grid.appendChild(newGrid);

                        newGrid.setAttribute("id","colGrid"+index);
                        document.getElementById("colGrid"+index).classList.add('col-sm-3','columns','columnDesc');

                        // var image1 = document.createElement("img");
                        // newGrid.appendChild(image1);
                        // image1.setAttribute("id","image"+index);
                        // document.getElementById("image"+index).classList.add('rounded', 'align-items-center', 'w-100','images');
                        // image1.setAttribute("height","150");
                        // image1.setAttribute("src", "<?php echo "{$row['image_path']}"; ?>");


                        
                        
                        var link = document.createElement("a");
                        newGrid.appendChild(link)
                        var href="ArticlePage.php?id=<?php echo urlencode($row['id']); ?>";
                        var content = document.createTextNode("<?php echo stripslashes($row['name']); ?>");
                        link.appendChild(content);
                        link.setAttribute("href",href);
                        link.setAttribute("class",'schema_article_title');
 						//var heading = document.createElement("h5");
                        //link.appendChild(heading);
                       // heading.setAttribute("id","head"+index);
                        //document.getElementById("head"+index).classList.add('text-center');
                        //document.getElementById("head"+index).innerHTML="<?php echo stripslashes($row['name']); ?>";
                        //document.getElementById("head"+index).style.color = "#343a40";
                        //document.getElementById("head"+index).style.fontSize = "20px";

                       
						
                        
                        var source = document.createElement("h6");
                        newGrid.appendChild(source);
                        source.setAttribute("id","source"+index);
                        document.getElementById("source"+index).innerHTML="<i><e>from</e></i> <?php echo $row['source']; ?>";
                        document.getElementById("source"+index).style.color = "#6D1275";
                        
                        
                        var para = document.createElement("p");
                        newGrid.appendChild(para);
                        para.setAttribute("id","desc"+index);

                        document.getElementById("desc"+index).classList.add('para');

                        // var icon2 = document.createElement("i");
                        // para.appendChild(icon2);
                        // icon2.setAttribute("id","like"+index);
                        // document.getElementById("like"+index).classList.add('fa', 'fa-thumbs-up','likes');
                        // document.getElementById("desc"+index).innerHTML=document.getElementById("desc"+index).innerHTML +" Like ";
                        var icon1 = document.createElement("i");
                        para.appendChild(icon1);
                        icon1.setAttribute("id","time"+index);
                        document.getElementById("time"+index).classList.add('icon', 'ion-clock','times');
                        document.getElementById("desc"+index).innerHTML=document.getElementById("desc"+index).innerHTML +  " <?php echo $row['reading_time']; ?> mins <br>";
                        document.getElementById("desc"+index).innerHTML=document.getElementById("desc"+index).innerHTML +  "<?php echo $row['topic']; ?> <br>";
                        document.getElementById("desc"+index).innerHTML=document.getElementById("desc"+index).innerHTML +  "<?php echo $row['category']; ?>";
                        var br = document.createElement("br");
                        newGrid.appendChild(br);
                        index = index+1;
                      }
                      else{

                        console.log("continue");

                      }
                  });
                });
              }
              <?php
              continue;
            }
          }
          else
          {
            console.log("here at error");
            echo "Could not issue DB query".mysqli_errno($connection);?>


            <?php



          }

          ?>
        }




      </script>


      <script>

//LOGOUT SCRIPT

var userID = <?php echo $userID;?>;
var logged = <?php echo $logged; ?>;
var status = <?php echo $user_status;?>;
var form = $('#login')[0]
var formData3 = new FormData();
formData3.append("form",form);
formData3.append("status",status);
formData3.append("userID",userID);
// var logbutton = document.getElementById("login");

if(logged==1){
$( "#login" ).click(function( event ) {
   event.preventDefault();

    $.ajax({ url: 'logout.php',


              type: 'post',
              data: formData3,
              contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
              processData: false,

         success: function(output) {
                      alert(output);
                      window.location.replace("<?php echo $logging_link;?>");

                  },
          error: function(request, error){
            alert("Error: Could not issue ajax request\n"+"Status: "+status+"\nuserID:"+userID+error+request);
          }
    });



  });
}
      </script>



      <script>
      console.log("logged: " +<?php echo $logged; ?>);

      console.log("User Status: " +"<?php echo $user_status;?>");

      </script>



      <script>
      <?php

  try{

      $ip = $_SERVER['REMOTE_ADDR'];

      function curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $return = curl_exec($ch);
        curl_close ($ch);
        return $return;

      }


      $string = curl("http://ipinfo.io/{$ip}/json");
      $details=json_decode($string);
      $loc = $details->loc;
      $myString= (string)$loc;
      $myArray = explode(',', $myString);

      $lat=$myArray[0];
      $long = $myArray[1];
      $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false&key=AIzaSyDQmKWbeMPdUDQk83emuOfACLIdmvgF7Cc";

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_ENCODING, "");
      $curlData = curl_exec($curl);
      curl_close($curl);

      $address = json_decode($curlData);
      $street= $address->results[0]->formatted_address;





      $user = 'unregistered user';
      $user_id ='-1';
      if($logged){
        $user_id = $userID ;
        $user_query = "SELECT * FROM users WHERE user_id = {$user_id}";
        $response = @mysqli_query($connection,$user_query);
        if($response){
          $user_record = mysqli_fetch_array($response);
          $user = $user_record['username'];
        }
      }



      $ip_address = $details->ip;
      $host_name = $details->hostname;
      $country = $details->country;
      $region = $details->region;
      $city = $details->city;
      $coodrinates = $details->loc;
      $ISP_address = $street ;

    if(empty($ip_address))
    $ip_address = 'unreachable';
    if(empty($host_name))
    $host_name = 'unreachable';
    if(empty($country))
    $country = 'unreachable';
    if(empty($region ))
    $region = 'unreachable';
    if(empty($city))
    $city = 'unreachable';
    if(empty($coodrinates))
    $coodrinates = 'unreachable';
    if(empty($ISP_address ))
    $ISP_address = 'unreachable';


    }


    catch (Exception $e) {
      ?>

      console.log(<?php echo 'Caught exception: ',  $e->getMessage(), "\n";?>);
      <?php
      $ip_address = 'unreachable';
      $host_name = 'unreachable';
      $country = 'unreachable';
      $region = 'unreachable';
      $city = 'unreachable';
      $coodrinates = 'unreachable';
      $ISP_address = 'unreachable';
      $user = 'unregistered user';
      $user_id ='-1';
      if($logged){
        $user_id = $userID ;
        $user_query = "SELECT * FROM users WHERE user_id = {$user_id}";
        $response = @mysqli_query($connection,$user_query);
        if($response){
          $user_record = mysqli_fetch_array($response);
          $user = $user_record['username'];
        }
      }
  }



      ?>

      console.log("<?php echo (!empty($details)) && isset($details);?>")
      console.log(<?php echo $string;?>);
      console.log("<?php echo $street;?>");


       </script>


       <script>
       function insertActivity(ArticleID,ArticleName){

         var logged = <?php echo $logged; ?>;
         var user = "<?php echo $user ;?>";
         var user_id = "<?php echo $user_id  ;?>";
         var ip_address = "<?php echo $ip_address;?>";
         var host_name = "<?php echo $host_name;?>";
         var country = "<?php echo $country;?>";
         var region = "<?php echo $region;?>";
         var city = "<?php echo $city;?>";
         var coordinates = "<?php echo $coodrinates;?>";
         var isp_address = "<?php echo $ISP_address;?>";

         var activity = user + " is now browsing articles."

           var activity_form = $('#gridRow')[0]
           var formdata = new FormData();

           formdata.append("form", activity_form);
           formdata.append("article_id", ArticleID);
           formdata.append("article_name",ArticleName);
           formdata.append("user",user);
           formdata.append("activity",activity);
           formdata.append("user_id",user_id);
           formdata.append("ip_address",ip_address);
           formdata.append("hostname",host_name);
           formdata.append("country",country);
           formdata.append("region",region);
           formdata.append("city",city);
           formdata.append("coordinates",coordinates);
           formdata.append("isp_address",isp_address);

           $.ajax({ url: 'add_activity.php',


           type: 'post',
           data: formdata,
           contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
           processData: false,
           success: function(output) {
             console.log(output);



           },
           error: function(request, status, error){
             alert("could not issue ajax request for activity.")

           }
         });

     }

     insertActivity("n/a","n/a" );



     </script>



<script>

var runFilter = false;

if(sessionStorage.technology==0){
document.getElementById("techn").checked=false;
runFilter=true;
}
if(sessionStorage.edu==0){
document.getElementById("edu").checked=false;
runFilter=true;
}

if(sessionStorage.health==0){
document.getElementById("health").checked=false;
runFilter=true;
}

if(sessionStorage.society==0){
document.getElementById("society").checked=false;
runFilter=true;
}

if(sessionStorage.envir==0){
document.getElementById("envir").checked=false;
runFilter=true;
}

if(sessionStorage.business==0){
document.getElementById("business").checked=false;
runFilter=true;
}


if(sessionStorage.news==0){
document.getElementById("news").checked=false;
runFilter=true;
}

if(sessionStorage.advice==0){
document.getElementById("advice").checked=false;
runFilter=true;
}

if(sessionStorage.analysis==0){
document.getElementById("analysis").checked=false;
runFilter=true;
}

if(sessionStorage.discussion==0){
document.getElementById("discussion").checked=false;
runFilter=true;
}

if(sessionStorage.interview==0){
document.getElementById("interview").checked=false;
runFilter=true;
}

if(sessionStorage.chronicle==0){
document.getElementById("chronicle").checked=false;
runFilter=true;
}

if(sessionStorage.readingtimelow || sessionStorage.readingtimehigh){
    $('.range-slider').jRange('setValue', ''+sessionStorage.readingtimelow+','+sessionStorage.readingtimehigh+'');
    runFilter = true;
}

console.log(sessionStorage.technology);
console.log(document.getElementById("techn").checked);

if(runFilter==true)
  document.getElementById("filter").click()
</script>
      </html>
