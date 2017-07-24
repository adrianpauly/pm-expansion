<?php session_start(); ?>

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







<?php 

	
	if( !isset($_SESSION['school']) ): ?>
	
			<div id="pick-school">

			<select id="school" name="subject" class="custom" style="display: none;">
              <option>Select your School</option>
              
               <option value="1">Albright College</option>
  <option value="2">American University</option>
  <option value="3">Appalachian State University</option>
  <option value="4">Arkansas Technological University</option>
  <option value="5">Armstrong State University</option>
  <option value="6">Auburn University</option>
  <option value="7">Baldwin-Wallace University</option>
  <option value="8">Ball State University</option>
  <option value="9">Bellarmine University</option>
  <option value="10">Belmont University</option>
  <option value="11">Bethany College</option>
  <option value="12">Binghamton University</option>
  <option value="13">Brenau University</option>
  <option value="14">California State University-Fresno</option>
  <option value="15">California State University-Northridge</option>
  <option value="16">California State University – Stanislaus</option>
  <option value="17">Case Western Reserve University</option>
  <option value="18">Central Michigan University</option>
  <option value="19">Christopher Newport University</option>
  <option value="20">Cleveland State University</option>
  <option value="21">College of Charleston</option>
  <option value="22">Columbus State University</option>
  <option value="23">Cornell University</option>
  <option value="24">Delta State University</option>
  <option value="25">DePaul University</option>
  <option value="26">Drexel University</option>
  <option value="27">East Carolina University</option>
  <option value="28">Elmhurst College</option>
  <option value="29">Elon University</option>
  <option value="30">Florida Atlantic University</option>
  <option value="31">Florida Gulf Coast University</option>
  <option value="32">Florida International University</option>
  <option value="33">Florida State University</option>
  <option value="34">Georgetown College</option>
  <option value="35">Georgia College and State University</option>
  <option value="36">Georgia Institute of Technology</option>
  <option value="37">Georgia Southern University</option>
  <option value="38">Georgia State University</option>
  <option value="39">Grand Valley State University</option>
  <option value="40">Hanover College</option>
  <option value="41">High Point University</option>
  <option value="42">Houston Baptist University</option>
  <option value="43">Huntingdon College</option>
  <option value="44">Indiana University</option>
  <option value="45">IUPUI (Indiana University Purdue University Indianapolis)</option>
  <option value="46">Jacksonville State University</option>
  <option value="47">James Madison University</option>
  <option value="48">Kennesaw State University</option>
  <option value="49">Kent State University</option>
  <option value="50">LaGrange College</option>
  <option value="51">Lander University</option>
  <option value="52">LaSalle University</option>
  <option value="53">Louisiana State University</option>
  <option value="54">Louisiana State University-Shreveport</option>
  <option value="55">Louisiana Tech University</option>
  <option value="56">Lyon College</option>
  <option value="57">McDaniel College</option>
  <option value="58">McNeese State University</option>
  <option value="59">Mercer University</option>
  <option value="60">Miami University</option>
  <option value="61">Millsaps College</option>
  <option value="62">Mississippi State University</option>
  <option value="63">Muhlenberg College</option>
  <option value="64">Nicholls State University</option>
  <option value="65">Northwest Missouri State University</option>
  <option value="66">Northwestern State University</option>
  <option value="67">Oklahoma State University</option>
  <option value="68">Oklahoma City University</option>
  <option value="69">Pennsylvania State University</option>
  <option value="70">Purdue University</option>
  <option value="71">Queens University of Charlotte</option>
  <option value="72">Roanoke College</option>
  <option value="73">Rutgers University</option>
  <option value="74">Salisbury University</option>
  <option value="75">Samford University</option>
  <option value="76">Shorter University</option>
  <option value="77">Southeastern Louisiana University</option>
  <option value="78">Southern Arkansas University</option>
  <option value="79">Spring Hill College</option>
  <option value="80">Tarleton State University</option>
  <option value="81">Tennessee Technological University</option>
  <option value="82">Westminster College</option>
  <option value="83">The Johns Hopkins University</option>
  <option value="84">Towson University</option>
  <option value="85">Transylvania University</option>
  <option value="86">Troy University</option>
  <option value="87">Tulane University</option>
  <option value="88">University of Alabama</option>
  <option value="89">University of Arkansas</option>
  <option value="90">University of Cincinnati</option>
  <option value="91">University of Evansville</option>
  <option value="92">University of Florida</option>
  <option value="93">University of Georgia</option>
  <option value="94">University of Hartford</option>
  <option value="95">University of Houston</option>
  <option value="96">University of Kentucky</option>
  <option value="97">University of Louisiana at Lafayette</option>
  <option value="98">University of Louisiana at Monroe</option>
  <option value="99">University of Maine-Orono</option>
  <option value="100">University of Maryland-Baltimore County</option>
  <option value="101">University of Memphis</option>
  <option value="102">University of Michigan-Dearborn</option>
  <option value="103">University of Mississippi</option>
  <option value="104">University of Missouri-Columbia</option>
  <option value="105">University of Montevallo</option>
  <option value="106">University of Nebraska-Lincoln</option>
  <option value="107">University of North Alabama</option>
  <option value="108">University of North Carolina- Chapel Hill</option>
  <option value="109">University of North Carolina-Wilmington</option>
  <option value="110">University of North Georgia</option>
  <option value="111">University of South Alabama</option>
  <option value="112">University of South Carolina</option>
  <option value="113">University of South Carolina-Aiken</option>
  <option value="114">University of South Carolina-Upstate</option>
  <option value="115">University of Southern Mississippi</option>
  <option value="116">University of Tennessee-Knoxville</option>
  <option value="117">University of Texas-San Antonio</option>
  <option value="118">University of Washington</option>
  <option value="119">University of West Alabama</option>
  <option value="120">University of West Georgia</option>
  <option value="121">University of Wisconsin-River Falls</option>
  <option value="122">Valdosta State University</option>
  <option value="123">Virginia Commonwealth University</option>
  <option value="124">West Chester University of Pennsylvania</option>
  <option value="125">Western Carolina University</option>
  <option value="126">Western Kentucky University</option>
  <option value="127">York College of Pennsylvania</option>
              
            </select>
            
            <select id="subject" name="subject" class="custom" style="display: none;">
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
            
            <div class="video-frame">
                
                <div class="flex-video">
					<iframe src="//fast.wistia.net/embed/iframe/yaiptxmv9a" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width="800" height="450"></iframe>
                </div>

                <h2 id="vid-title">Phi Mu Intro Video</h2>
              </div>
           
            
			</div>




<?php else: ?>

<div id="pick-subject">
<select name="subject" class="custom" style="display: none;">
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
    
    <a id="go-tms" href="http://www.tutormatchingservice.com/#/phimu" target="_blank">Continue to Tutor Matching Service</a>
    <a class="close-reveal-modal">&#215;</a>
  </div>
  
</div>



<?php endif; ?>





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

<?php endif; ?>

  </body>
</html>
