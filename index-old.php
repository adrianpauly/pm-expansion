<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Phi Mu University</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/jqtree.css">
    <link href="css/jquery.selectBox.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/style.css" />
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,300' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    
    <script src="js/vendor/modernizr.js"></script>

  </head>
  <body>
    
    <div class="row">
      <div class="large-12 columns">
        <div class="outer-frame">
          <div class="inner-frame">
            <h1 class="frame-head"><span>&raquo;</span> Phi Mu University</h1>

            <select name="subject" class="custom" style="display: none;" >
              <option>Select a Subject</option>
              
              <?php

                  require_once('admin/classes/DB.php');

                  $db = new db();

                  //$myClassObj->db();
                  $data = $db->selectSubjects();

                  // $selectArray = array();
                  

                  while($row = mysqli_fetch_assoc($data)){
                      echo '<option value="'.$row['id'].'">'.$row['subject_name'].'</option>';
                  }

              ?>
              
            </select>

            
            <div class="large-6 columns large-offset-3">
              <div class="video-frame">
                
                <div class="flex-video">
					<iframe src="//fast.wistia.net/embed/iframe/yaiptxmv9a" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width="800" height="450"></iframe>
                </div>

                <h2 id="vid-title">Phi Mu Intro Video</h2>
              </div>

              <div class="tree-frame">
                <div class="tab active-tab">Review Videos
                  <div class="arrow-down"></div>
                </div>
                
                <div class="tab tutoring-tab" data-reveal-id="tmsModal">1 : 1 Private Tutoring</div>




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

    <p>If you’d like a 1-on-1 in-person or online private tutor, Phi Mu has partnered with Tutor Matching Service (TMS), the official private tutor list of colleges and universities across the country. The average price per hour is just $10 and many of the tutors are volunteering their time (for FREE).</p>
    <p>Phi Mu has arranged for your first hour to be free. $10 will be credited to your TMS account when you click the button below.</p>
    
    <a id="go-tms" href="http://www.tutormatchingservice.com/phimu/10" target="_blank">Continue to Tutor Matching Service</a>
    <a class="close-reveal-modal">&#215;</a>
  </div>
    
    
    
   <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/jquery.selectBox.js"></script>
    <script src="js/tree.jquery.js"></script>

    <script>
      $(document).foundation();
    </script>

    <script src="js/test.js"></script>

<script>
	
	$(document).ready(function() {
		$('select').selectBox({
		    mobile: true,
		    menuSpeed: 'fast'
		});
	});
	
	</script> 


      


  </body>
</html>
