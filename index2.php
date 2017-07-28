<?php session_start(); ?>
<?php require_once('admin/classes/DB.php'); ?>
<?php
if($_POST){
  session_destroy();
  unset($_POST);
  unset($_REQUEST);
  header('Location: ...');
}

if(isset($_GET["school"])) {
  $_SESSION['school'] = $_GET["school"];
} 

$db = new db();
$schools_results = $db->getSchools();
$subjects_results = $db->selectSubjects(); 

$schools = array();
while($row = mysqli_fetch_assoc($schools_results)) {
  $schools[$row['id']] = $row['name'];
}

$subjects = array();
while($row = mysqli_fetch_assoc($subjects_results)) {
  $subjects[$row['id']] = $row['subject_name'];
}

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Phi Mu University</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/jqtree.css">
    <link href="css/jquery.selectBox.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/style2.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css" src="/css/bootstrap.min.css"></style>
    <script src="js/vendor/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>

  <body>
    
    <div class="inner-frame">
      <?php if( !isset($_SESSION['school']) ): ?>

    	  <div id="pick-school" class="row">
  
          <div class="medium-6 columns">
            <select id="school" name="school">
              <option value="" disabled>Select your School</option>
               <?php foreach($schools as $id => $name) {
                  echo '<option value="'.$id.'">'.$name.'</option>';
                } ?>
            </select>
          </div>

          <div class="medium-6 columns">
            <select id="subject" name="subject">
              <option value="" disabled>Select a Subject</option>
               <?php foreach($subjects as $id => $name) {
                  echo '<option value="'.$id.'">'.$name.'</option>';
                } ?>
            </select>
          </div>

    		</div><!-- #pick-school -->
                
        <div class="video-frame">       
          <div class="flex-video widescreen">
            <video id='video-player' controls>
              <source src='http://videos.studyedge.com/studyedge/phimu/intro_video/Phi_Mu_Intro_Videos.mp4' type='video/mp4'>
            </video>
          </div>
          <h3 class="video-title">Phi Mu Intro Video</h3>
        </div>

      <?php else: ?>

      <div id="pick-subject">

        <div class="row">
          <div class="medium-8 columns">
            <select name="subject" id="subject_second">
              <option value="" disabled>Select a Subject</option>    
               <?php foreach($subjects as $id => $name) {
                  echo '<option value="'.$id.'">'.$name.'</option>';
                } ?>
            </select>  
          </div>
          <div class="medium-4 columns">
            <div class="school-name"><?php echo $schools[$_SESSION['school']] ?></div>
          </div>
        </div>

        <div class="video-frame">
          <div class="flex-video widescreen">
					  <iframe id="wistia" src="//fast.wistia.net/embed/iframe/yaiptxmv9a" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width="800" height="450"></iframe>
            <div class="video-player"></div>
          </div>
          <h3 class="video-title"></h3>
        </div>

        <div class="tree-frame">

          <h3 class="welcome">Welcome to <span class="subject-name">Subject Name</span></h3>
          <div class="tab active-tab videos-label">
            <span><img src="/css/video-more-icn.svg">Videos &amp; More</span>
            <div class="collapse-link">
              <a class="collapse-all">Collapse all folders <span class="caret"></span></a>
              <div class="arrow-down"></div>
            </div>
          </div>

          <div class="tree">
            <div id="tree1"></div>
          </div>

        </div>

      </div><!-- #pick-subject -->
    </div><!-- .inner-frame -->

    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>

    <div id="tmsModal" class="reveal-modal" data-reveal>
      <h2>Tutor Matching Service (TMS)</h2>
      <p>Phi Mu has partnered with Tutor Matching Service (TMS) to give you a free hour of private one-on-one, in-person or online tutoring!</p> 
      <p>TMS works with colleges and universities across the country to bring students the best private tutors. The average price is just $10/hour and many tutors volunteer their time for free!</p>
      <p>Please click the button below to receive a $10 credit so you can start your free hour of private tutoring!</p>
      <a id="go-tms" href="http://www.tutormatchingservice.com/#/phimu" target="_blank">Continue to Tutor Matching Service</a>
      <a class="close-reveal-modal">&#215;</a>
    </div>


<?php endif; ?>

    <script src="http://fast.wistia.net/static/iframe-api-v1.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/jquery.selectBox.js"></script>
    <script src="js/tree.jquery.js"></script>

    <script src="js/test2.js"></script>

    <script>
  	
      	$(document).ready(function() {
      		$('select').selectBox({
      		    mobile: true,
      		    menuSpeed: 'fast'
      		});
      	});

    		$('select#subject').selectBox().change(function () {
  		    $.ajax({
  			    url: 'session.php',
  			    type: 'POST',
  			    data: { 'school': $('select#school').selectBox().val(), 'subject': $(this).val() },
  			    success: function(data) {    
  			    	location.reload();
  			    }
    			});
    		});

    </script>

    <?php if(isset($_SESSION['subject'])): ?>
      <script>
      	$(document).ready(function() {
      		$('select').selectBox('value', <?php echo $_SESSION['subject']; ?>);
      		$('select').selectBox().change();
      	});
      	
      	wistiaEmbed = jQuery("#wistia")[0].wistiaApi; 
      		
      		wistiaEmbed.bind("play", function() {
      		  console.log("The video started playing");
      		  
      		  $.ajax({
      			    url: 'save-video-watch.php',
      			    type: 'POST',
      			    data: { 'school': <?php echo $_SESSION['school']; ?>, 'subject': <?php echo $_SESSION['subject']; ?>, 'video': $('#wistia').data('vidid') },
      			    success: function(data) {    
      			    	console.log('saved');
      			    }
      			});
      			
      			return this.unbind;
      		});
      		
      </script>
    <?php endif; ?>

    <div class="player" ></div>
  </body>
</html>
