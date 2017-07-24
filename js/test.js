$(function() {
	$('select').selectBox().change(function () {   	
    	var subj_id = $(this).val()

        $('#tree1').tree('destroy');
 		if($(this).attr('id') != "school" ){
 			$(".video-frame").hide();
 		}

        $.getJSON(
            'get-tree.php?subject_id=' + subj_id,
            function(data) {
                $('#tree1').tree({
                    data: data,
                    closedIcon: $('<i class="fa fa-folder"></i>'),
					openedIcon: $('<i class="fa fa-folder-open"></i>'),
                    onCreateLi: function(node, $li) {
                      // Add 'icon' span before title                     
                      if(node.resource_type_id == 4) {
	                       	$li.find('.jqtree-title').before('<i class="fa fa-play-circle-o"></i>'); 
	                       	var the_title = node.name.replace(/_/g, " ");
	                       	the_title = the_title.replace(".mp4", " ");

	                       	if(the_title.substr(0,1) == 0){
	                       		the_title = the_title.slice(1, the_title.length);
	                       	}
	                       	$li.find('.jqtree-title').replaceWith('<span class="jqtree-title jqtree_common">'+the_title+'</span>');     
                      }
                      
                       if(node.resource_type_id == 10) {
                       $li.find('.jqtree-title').before('<i class="fa fa-play-circle-o intro-vid"></i>'); 
                       var intro_url = node.url;
                       var introVidID = intro_url.substr(intro_url.lastIndexOf('/') + 1);
                       var embed_code = '//fast.wistia.net/embed/iframe/'+introVidID;
                       var the_title = node.name;
                        
                       $('div.flex-video iframe').attr('src', embed_code);
                       $('div.flex-video iframe').attr('data-vidID', node.id);
					   $('h2#vid-title').text(the_title);
                      }
                      
                      if(node.resource_type_id == 3) {
                       $li.find('.jqtree-title').before('<i class="fa fa-file-text-o"></i>');                  	
                       	var the_title = node.name.replace(/_/g, " ").slice(0, -4);           
                       	$li.find('.jqtree-title').replaceWith('<span class="jqtree-title jqtree_common">'+the_title+'</span>');
                      }

					  if(node.resource_type_id == 1 && node.children.length == 0) {
	                      $li.find('.jqtree-title').before('<i class="fa fa-folder" style="color: #ccc;"></i>');
                      }

                      if(node.resource_type_id == 1) {

                      	var the_title = node.name.replace(/_/g, " ");
                      	if(the_title.substr(0,1) == 0){
                       		the_title = the_title.slice(1, the_title.length);
                       	}
	                    $li.find('.jqtree-title').replaceWith('<span class="jqtree-title jqtree_common folder-item">'+the_title+'</span>');  
                      }
                    }
                });
            }
        );
      

      $('#tree1').bind(
          'tree.click',
          function(event) {
	          var node = event.node;
	          // click on Folder
	          if(node.resource_type_id == 1) {
				  if(node.is_open) {
					 $('#tree1').tree('closeNode', node); 
				  } else {
					  $('#tree1').tree('openNode', node);
				  }
				  
	          }
	          
	          // Click on PDF
	          if(node.resource_type_id == 3) {
	          	if(typeof window.wistiaApi != "undefined"){
		        	window.wistiaApi.pause();
		      	}
		      	if($('video')){
		      		var player = document.getElementById("video-player")
					player.pause();
				}
		        window.open(node.url);
	          }
	          
	          // Click on Video
	          if(node.resource_type_id == 4 || node.resource_type_id == 10) {
              
              	var url = node.url;
			  	var vidID = url.substr(url.lastIndexOf('/') + 1);

              
	            
	          
	            if (url.indexOf("videos.studyedge") > 0) {
					var embed_code = url;
					var studyedge_vid = true;
	             } else {
	            	var embed_code = '//fast.wistia.net/embed/iframe/'+vidID;
	            	var studyedge_vid = false;
	             }
	             
	              
              	if(node.resource_type_id == 4) {
	              	var the_title = node.name.replace(/_/g, " ").slice(0, -4);
              	} else {
	              	var the_title = node.name;
              	}

              	if(the_title.substr(0,1) == 0){
               		the_title = the_title.slice(1, the_title.length);
               	}

               	if(!studyedge_vid) {
               		$('div.flex-video .video-player').html('');
            		$('div.flex-video iframe').show();
                	$('div.flex-video iframe').attr('src', embed_code);
                	$('div.flex-video iframe').attr('data-vidID', node.id);
            	} else {
            		$('div.flex-video iframe').hide();
            		$('div.flex-video .video-player').html("<video id='video-player' controls><source src='"+embed_code+"' type='video/mp4'></video> ");
            	}
                
                $('h2#vid-title').text(the_title);



                if ( $('.video-frame').hasClass('hidden') ) {
                    $('.video-frame').removeClass('hidden');
		       	  
                }
                $(".video-frame").show();
                 $("video").bind("contextmenu",function(){
                        return false;
                    });
		$('html,body').scrollTop(110);
	            
              
              }

             
          }
      );

    }
    
    
    
   
);

	$('.tutoring-tab').hover(function(){
		$(this).css('background', '#ecb3c8');
	}, function() {
		$(this).css('background', '#5D5D5D');
	});

	$('.tutoring-tab').click(function(){
		window.wistiaApi.pause();
		if($('video')){
			var player = document.getElementById("video-player")
			player.pause();
		}
	})

});
	
	
	
	
	
	
	
	
	
	



