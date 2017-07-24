<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Phi Mu University</title>
    <link rel="stylesheet" href="../css/foundation.css" />
    <link rel="stylesheet" href="../css/jqtree.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="../js/vendor/modernizr.js"></script>
  </head>
  <body>
    
    
	    <ul class="side-nav">
	    	<h1>Phi Mu University</h1>
		  <li ><a href="subjects.php"><i class="fa fa-graduation-cap"></i> Add Subject</a></li>
		  <li class="active"><a href="resources.php"><i class="fa fa-youtube-play"></i> Edit Resources</a></li>
		 
		</ul>


		<div class="admin-content">
			<div class="row">
				<div class="large-9 columns">

					<h3><i class="fa fa-plus"></i> Edit Resources</h3>
					
										
					<label>Select Subject
        <select name="subject" id="subject">
          <option>Select a Subject</option>
          
          
              
              <?php

                  require_once('classes/DB.php');

                  $db = new db();

                  //$myClassObj->db();
                  $data = $db->selectSubjects();

                  // $selectArray = array();
                  

                  while($row = mysqli_fetch_assoc($data)){
                      echo '<option value="'.$row['id'].'">'.$row['subject_name'].'</option>';
                  }

              ?>
        </select>
      </label>
      
      			<a class="button secondary small" href="javascript://" onclick="saveTree();">Save Tree</a>

	  			
	  			<div id="tree1" style="margin-bottom: 100px;"></div>
					
				</div>
			</div>

		</div>
   

		
    
    
    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/tree.jquery.js"></script>

    <script>
      $(document).foundation();
    </script>


    
    <div id="addVideoModal" class="reveal-modal" data-reveal style="z-index: 9999;">
	  <h2>Add Video</h2>
	  
	  <label>Video Title
	  <input type="text" id="video-title">
	  </label>
	  
	  <label>Embed Code
	  <textarea id="embed-code"></textarea>
	  </label>
	  
	  <input type="hidden" id="folder-id">
	  
	  <a class="button secondary small" id="submit-vid" href="#" onclick="submitVid();">Submit</a> 
	  
	  <a class="close-reveal-modal">&#215;</a>
	</div>
	
	    <script>
		$(document).ready(function() {
			$('#subject').change(function(){
				var subj_id = $('#subject option:selected').val();
				
				$('#tree1').tree('destroy');
	 
	
		        $.getJSON(
		            '../get-tree.php?subject_id=' + subj_id,
		            function(data) {
		                $('#tree1').tree({
		                    data: data,
		                    autoOpen: true,
		                    dragAndDrop: true,
		                    closedIcon: $('<i class="fa fa-folder"></i>'),
							openedIcon: $('<i class="fa fa-folder-open"></i>'),
		                    onCreateLi: function(node, $li) {
		                      // Add 'icon' span before title
		                      if(node.embed_code) {
		                       $li.find('.jqtree-title').before('<i class="fa fa-play-circle-o"></i>');
		                        
		                      }
		                      
		                      if(node.resource_type_id == 'Folder') {
			                    
			                      
			                      $li.find('.jqtree-element').append('<a href="javascript://" onclick="addVideo('+node.id+');"><i style="color: #ccc; margin-left: 10px;" class="fa fa-plus"></i></a>');
			                      
		                      }
		                      
		                    
		                    }
		                });
		            }
		        );
			});
			
			
			// on move
			$('#tree1').bind(
			    'tree.move',
			    function(event) {
			        console.log( $(this).tree('toJson') );
			    }
			);
			
			
			
			
			
		});
		
		function addVideo(folder_id) {
			$('#folder-id').val(folder_id);
			
			$('#addVideoModal').foundation('reveal', 'open');
			

			
		}
		
		function submitVid() {
				$('#addVideoModal').foundation('reveal', 'close');
				
				var parent_node = $('#tree1').tree('getNodeById', $('#folder-id').val());	 
				
				$('#tree1').tree(
				    'appendNode',
				    {
				        label: $('#video-title').val(),
				        embed_code: $('#embed-code').val(),
				        resource_type: 'Video',
				        hierarchy_level: 2,
				        parent_folder_id: $('#folder-id').val(),
				        id: '10000'
				    },
				    parent_node
				);
				
				var node = $('#tree1').tree('getNodeById', 10000);
		}
		
		function saveTree() {
			var tree = $('#tree1').tree('toJson');
			var subject = $('#subject option:selected').val();
			$.ajax({
			    url: 'update-tree.php',
			    type: 'POST',
			    data: {'tree': tree, 'subject': subject},
			    success: function(data) {    
			    	console.log('ok');
			    }
			});
		}
		
		
			
			
		
		
		
		
		
			
    </script>

   
  </body>
</html>
