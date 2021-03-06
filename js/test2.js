$(document).foundation();

$(function() {
    $('select').selectBox().on('change', function() {
        var subj_id = $(this).val()

        $('#tree1').tree('destroy');
        if ($(this).attr('id') != "school") {
            $(".video-frame").hide();
        }
        $('.video-player').empty();
        $('.video-title').empty();        
        $('.info-row').removeClass('hidden');
        $('.subject-name').text($('.selectBox :selected').text());

        $.getJSON(
            'get-tree.php?subject_id=' + subj_id,
            function(data) {
                $('#tree1').tree({
                    data: data,
                    closedIcon: $('<i class="fa fa-folder">'),
                    openedIcon: $('<i class="fa fa-folder-open">'),
                    onCreateLi: function(node, $li) {
                        // Add 'icon' span before title                     
                        if (node.resource_type_id == 4) {
                            $li.find('.jqtree-title').before('<img class="inner" src="/css/video-icn.svg">');
                            var the_title = node.name.replace(/_/g, " ");
                            the_title = the_title.replace(".mp4", " ");

                            if (the_title.substr(0, 1) == 0) {
                                the_title = the_title.slice(1, the_title.length);
                            }
                            $li.find('.jqtree-title').replaceWith('<span class="jqtree-title jqtree_common">' + the_title + '</span>');
                        }

                        if (node.resource_type_id == 10) {
                            $li.find('.jqtree-title').before('<i class="intro-vid"></i><img src="/css/video-icn.svg">');
                            var intro_url = node.url;
                            var introVidID = intro_url.substr(intro_url.lastIndexOf('/') + 1);
                            var embed_code = '//fast.wistia.net/embed/iframe/' + introVidID;
                            var the_title = node.name;

                            $('div.flex-video iframe').attr('src', embed_code);
                            $('div.flex-video iframe').attr('data-vidID', node.id);
                            $('h3#vid-title').text(node.name);
                        }

                        if (node.resource_type_id == 3) {
                            $li.find('.jqtree-title').before('<img src="/img/file-icn.svg" class="file">');
                            var the_title = node.name.replace(/_/g, " ").slice(0, -4);
                            $li.find('.jqtree-title').replaceWith('<span class="jqtree-title jqtree_common">' + the_title + '</span>');
                        }

                        if (node.resource_type_id == 1 && node.children.length == 0) {
                            $li.find('.jqtree-title').before('<i class="fa fa-folder" style="color: #ccc;"></i>');
                        }

                        if (node.resource_type_id == 1) {
                            $li.find('.jqtree-toggler').before('<i class="fa fa-caret-right _' + node.id + '"></i>');
                        }

                        if (node.resource_type_id == 1) {

                            var the_title = node.name.replace(/_/g, " ");
                            if (the_title.substr(0, 1) == 0) {
                                the_title = the_title.slice(1, the_title.length);
                            }
                            $li.find('.jqtree-title').replaceWith('<span class="jqtree-title jqtree_common folder-item">' + the_title + '</span>');
                        }
                    }
                });
            }
        );


        $('#tree1').bind(
            'tree.click',
            function(event) {
                var node = event.node;
                // click on a folder
                if (node.resource_type_id == 1) {
                    if (node.is_open) {
                        $('#tree1').tree('closeNode', node);
                    } else {
                        $('#tree1').tree('openNode', node);
                    }
                }

                // Click on a PDF
                if (node.resource_type_id == 3) {
                    if (typeof window.wistiaApi != "undefined") {
                        window.wistiaApi.pause();
                    }
                    if ($('video')) {
                        var player = document.getElementById("video-player")
                        player.pause();
                    }
                    window.open(node.url);
                }

                // Click on a video link
                if (node.resource_type_id == 4 || node.resource_type_id == 10) {

                    var url = node.url;
                    var vidID = url.substr(url.lastIndexOf('/') + 1);


                    if (url.indexOf("videos.studyedge") > 0) {
                        var embed_code = url;
                        var studyedge_vid = true;
                    } else {
                        var embed_code = '//fast.wistia.net/embed/iframe/' + vidID;
                        var studyedge_vid = false;
                    }


                    if (node.resource_type_id == 4) {
                        // Check if title contains file extension
                        var the_title = node.name.replace(/_/g, " ");
                        if (the_title.substring((the_title.length - 4),(the_title.length - 3)) == '.') {
                            the_title = the_title.substring(0,(the_title.length - 4));
                        }
                    } else {
                        var the_title = node.name;
                    }

                    if (the_title.substr(0, 1) == 0) {
                        the_title = the_title.slice(1, the_title.length);
                    }

                    // Wistia video
                    if (!studyedge_vid) {
                        $('div.flex-video .video-player').html('');
                        $('div.flex-video iframe').show();
                        $('div.flex-video iframe').attr('src', embed_code);
                        $('div.flex-video iframe').attr('data-vidID', node.id);
                        window.wistiaApi.play();
                    // Local video
                    } else {
                        $('div.flex-video iframe').hide();
                        $('.video-frame .video-player').html("<video id='video-player' controls autoplay><source src='" + embed_code + "' type='video/mp4'></video> ");                        
                    }

                    $('.video-title').text(the_title);

                    if ($('.video-frame').hasClass('hidden')) {
                        $('.video-frame').removeClass('hidden');
                    }
                    $(".video-frame").show();
                    $("video").bind("contextmenu", function() {
                        return false;
                    });
                    $('html,body').scrollTop(0);
                }
            }
        );

        $('#tree1').bind(
            'tree.open',
            function(e) {
                if (e.node.resource_type_id == 1) {
                    $("._" + e.node.id).removeClass('fa-caret-right');
                    $("._" + e.node.id).addClass('fa-caret-down');
                }
            }
        );
        $('#tree1').bind(
            'tree.close',
            function(e) {
                if (e.node.resource_type_id == 1) {
                    $("._" + e.node.id).addClass('fa-caret-right');
                    $("._" + e.node.id).removeClass('fa-caret-down');
                }
            }
        );
    });


    // Collapse all folders
    var $tree = $('#tree1');
    $('.collapse-all').on('click', function() {
        var tree = $tree.tree('getTree');
        console.log('tree', tree);
        tree.iterate(function(node) {
            if (node.hasChildren()) {
                $tree.tree('closeNode', node, true);
            }
            return true;
        });
    });

    // Toggle play when clicking on video
    $('.video-player').on('click', 'video', function() {
        this.paused ? this.play() : this.pause();
    });


    $('.tutoring-tab').hover(function() {
        $(this).css('background', '#ecb3c8');
    }, function() {
        $(this).css('background', '#5D5D5D');
    });

    $('.tutoring-tab').click(function() {
        window.wistiaApi.pause();
        if ($('video')) {
            var player = document.getElementById("video-player")
            player.pause();
        }
    })
});


// Toggle video play with spacebar
$(window).keypress(function(e) {
    var video = $('.video-player video').get(0);
      if (e.which == 32) {
        e.preventDefault();
        if (video.paused)
          video.play();
        else
          video.pause();
      }
});


// Scroll to top button
window.onscroll = function() { 
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        $('.scroll-to-top').fadeIn(200);
    } else {
        $('.scroll-to-top').fadeOut(200);
    }    
};
$('.scroll-to-top').on('click',function(){
    document.body.scrollTop = 0; // For Chrome, Safari and Opera 
    document.documentElement.scrollTop = 0; // For IE and Firefox
});
