<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Phi Mu University</title>
    <link rel="stylesheet" href="../css/foundation.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="../js/vendor/modernizr.js"></script>
  </head>
  <body>
    
    
	    <ul class="side-nav">
	    	<h1>Phi Mu University</h1>
		  <li class="active"><a href="subjects.php"><i class="fa fa-graduation-cap"></i> Add Subject</a></li>
		  <li><a href="resources.php"><i class="fa fa-youtube-play"></i> Edit Resources</a></li>
		 
		</ul>


		<div class="admin-content">
			<div class="row">
				<div class="large-9 columns">

					<h3><i class="fa fa-plus"></i> Add Subject</h3>

					<form>
					  <div class="row">
					    <div class="large-8 columns">
					      <label>
					        <input id="subject" name="subject" type="text" placeholder="Enter Subject Name">
					      </label>
					    </div>
					  </div>

					  <div class="row">
					    <div class="large-8 columns">
					      <a id="add-sub" href="javascript://" class="button secondary small">Submit</a>
					    </div>
					  </div>
					</form>

				</div>

				<div class="large-3 columns widget">
					<h3 class="widget-head">Current Subjects</h3>

					<ul class="current-subjects">
						
					</ul>
				</div>
			</div>

		</div>
    
    	<div data-alert class="alert-box success">
		  <span class="response"></span>
		</div>

		<div data-alert class="alert-box alert">
		  You didn't enter anything!
		</div>

		
    
    
    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/foundation.min.js"></script>

    <script>
      $(document).foundation();
    </script>

    <script>
		$(document).ready(function() {
			// get current subjects 
			$.ajax({
			    url: 'get-subjects.php',
			    type: 'GET',
			    cache: false,
			    success: function(data) {    
			    	$('ul.current-subjects').html(data);
			    }
			});

			// submit the form
			$('a#add-sub').click(function() {
				var subj = $('input#subject').val();

				if(subj == '') {
					$('.alert-box.alert').css('display', 'block');
			    	setTimeout(function() {
		              $(".alert-box.alert").hide();
		            }, 2000);
					return false;
				}

				$.ajax({
				    url: 'add-subject.php',
				    type: 'POST',
				    cache: false,
				    data: {
				    	'subject_name': subj
				    },
				    success: function(data) {    
				    	$('input#subject').val('');
				    	$('ul.current-subjects').append('<li class="just-added">'+data+'</li>');
				    	$('.alert-box.success span.response').text(data + ' was added successfully.');
				    	$('.alert-box.success').css('display', 'block');
				    	setTimeout(function() {
			              $(".alert-box.success").hide();
			            }, 2000);
				    }
				});
			});
		});
    </script>

   
  </body>
</html>
