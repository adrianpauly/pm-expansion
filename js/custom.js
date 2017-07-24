$(function() {

$("select.custom").each(function() {          
  var sb = new SelectBox({
    selectbox: $(this),
    height: 1000,
    width: 200,
    mobile: true,
    changeCallback: function() {
      var selected = $('div.selectedValue').text();
      
      var subj_id = $('select.custom option:contains('+selected+')').val();

      $('#tree1').tree('destroy');
 

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
                      }
                      
                       if(node.resource_type_id == 10) {
                       $li.find('.jqtree-title').before('<i class="fa fa-play-circle-o intro-vid"></i>'); 
                      }
                      
                      if(node.resource_type_id == 3) {
                       $li.find('.jqtree-title').before('<i class="fa fa-file-text-o"></i>'); 
                      }

					  if(node.resource_type_id == 1 && node.children.length == 0) {
	                      $li.find('.jqtree-title').before('<i class="fa fa-folder" style="color: #ccc;"></i>');
                      }

                    }
                });
            }
        );
      

      $('#tree1').bind(
          'tree.click',
          function(event) {
	          var node = event.node;
	          
	          if(node.resource_type_id == 3) {
		          window.open(node.url);
	          }
	          
	          if(node.resource_type_id == 4 || node.resource_type_id == 10) {
              
              var url = node.url;
              var vidID = url.substr(url.lastIndexOf('/') + 1)

              
	              
	          
	              
	             var embed_code = '<iframe src="//fast.wistia.net/embed/iframe/'+vidID+'" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width="800" height="450"></iframe>';
	              
	              
	
	            
	                 $('div.flex-video').html(embed_code);
	                 $('h2#vid-title').text(node.name);
	                 $('html,body').scrollTop(0);
	
	                if ( $('.video-frame').hasClass('hidden') ) {
	                    $('.video-frame').removeClass('hidden');
	                  }
	                  
	                  $('html,body').scrollTop(0);
	              
              
              }

             
          }
      );

    }
  });
});

});

