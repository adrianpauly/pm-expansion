<?php session_start(); ?>
<?php require_once('admin/classes/DB.php'); ?>
<?php
if($_POST){
  session_destroy();
  unset($_POST);
  unset($_REQUEST);
  header('Location: ...');
}

if(isset($_GET["school"])) 
{
  $_SESSION['school'] = $_GET["school"];
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
    
  <div class="">
    <div class="col-md-12">
      <div>
        <div class="inner-frame">
          <?php if( !isset($_SESSION['school']) ): ?>
          <?php
            $db = new db();
            $schools = $db->getSchools();
          ?>
          </div>
      	  <div id="pick-school">
      	    <select id="school" name="subject" class="custom" style="display: none;">
              <option>Select your School</option>
	      <?php
                while($row = mysqli_fetch_assoc($schools)){
                  echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
              ?>
            </select> 
            <select id="subject" name="subject" class="col-md-4" style="display: none;">
              <option>Select a Subject</option>
                    
              <?php
                $db = new db();
                $data = $db->selectSubjects();                  

                while($row = mysqli_fetch_assoc($data)){
                    echo '<option value="'.$row['id'].'">'.$row['subject_name'].'</option>';
                }

              ?>
                    
            </select>
                  
            <div class="video-frame">       
              <div class="flex-video">
                <video id='video-player' controls><source src='http://videos.studyedge.com/studyedge/phimu/intro_video/Phi_Mu_Intro_Videos.mp4' type='video/mp4'></video>
              </div>
              <h2 id="vid-title">Phi Mu Intro Video</h2>
            </div>
      		</div>
          <?php else: ?>
          <div id="pick-subject">
            <div class="col-md-12">
              <select name="subject" class="selectbox col-md-4" style="display: none;">
                <option>Select a Subject</option>    
                <?php
                  require_once('admin/classes/DB.php');

                  $db = new db();
                  $data = $db->selectSubjects();
                  while($row = mysqli_fetch_assoc($data)){
                    echo '<option value="'.$row['id'].'">'.$row['subject_name'].'</option>';
                  }
                ?>
              </select>
              <div class="pull-right school" style="float:right" >
                <span class="school-name">Solutions University</span>
              </div>
            </div>
            <div class="col-md-12">
              <div class="video-frame hidden">
                <div class="flex-video">
      					  <iframe id="wistia" src="//fast.wistia.net/embed/iframe/yaiptxmv9a" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width="800" height="450"></iframe>
                  <div class="video-player"></div>
                </div>
                <h3 id="vid-title">Phi Mu Intro Video</h3>
              </div>
              <div class="tree-frame">
                <div class="tab active-tab">
                  <span><img src="/css/video-more-icn.svg">Videos & More</span>
                  <span class="pull-right collapse-active" style="float:right">Collapse all folders <span class="caret"></span>
                  <div class="arrow-down"></div>
                </div>
                <div class="info-row hidden">
                  <span> <img src="/css/comment.svg"> Welcome to <span class="subject-name">Subject Name</span></span>
                </div>
                <div class="tree">
                  <div id="tree1"></div>
                </div>
              </div>
            </div>
          </div><!-- end inner frame -->
        </div>
      </div>
    </div>
    <div id="tmsModal" class="reveal-modal" data-reveal>
    <h2 style="font-size: 26px; margin-bottom: 20px;">Tutor Matching Service (TMS)</h2>
    <p>Phi Mu has partnered with Tutor Matching Service (TMS) to give you a free hour of private one-on-one, in-person or online tutoring!</p> 
    <p>TMS works with colleges and universities across the country to bring students the best private tutors. The average price is just $10/hour and many tutors volunteer their time for free!</p>
    <p>Please click the button below to receive a $10 credit so you can start your free hour of private tutoring!</p>
    <a id="go-tms" href="http://www.tutormatchingservice.com/#/phimu" target="_blank">Continue to Tutor Matching Service</a>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</div>
<?php endif; ?>
<script src="http://fast.wistia.net/static/iframe-api-v1.js"></script>
<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script src="js/jquery.selectBox.js"></script>
<script src="js/tree.jquery.js"></script>

<script>
  $(document).foundation();
</script>
<script src="js/test2.js"></script>
<script>
	
	$(document).ready(function() {
		$('select').selectBox({
		    mobile: true,
		    menuSpeed: 'fast'
		});
	});
	
	</script> 
	
	<script>
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
	
</script>

<script>
	
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
