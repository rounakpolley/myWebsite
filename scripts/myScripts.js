$(document).ready(function()
{     
var scroll_start = 0;
var startchange = $('#changeNav');
var offset = startchange.offset();
$(document).scroll(function() 
      { 
            scroll_start = $(this).scrollTop();
            if(scroll_start > offset.top) 
            {   $('#myWebsiteNav').css('background-color', 'rgba(0, 0, 0, 0.9)');  } 
            else 
            {   $('#myWebsiteNav').css('background-color', 'rgba(0, 0, 0, 0.5)');  }
       });
 

  $('a[href*=#]').on('click', function(e) 
                    {   e.preventDefault();
                        $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 500, 'linear');
                    });

});

window.onload = function ()
{

var expandBlog    = document.querySelectorAll(".blogCheck");
var showComments  = document.querySelectorAll(".blogComments");
var updateComment = document.querySelectorAll(".postComment");
var n = expandBlog.length;

for(var i=0; i<n; i++){     showComments[i].style.display = 'none'; 
                            expandBlog[i].onclick = reveralComments; 
                      }    
function reveralComments()
{
    for(var j=0; j<n; j++)
    {
        if(expandBlog[j].checked == true)   {  showComments[j].style.display = 'block';     }
        else                                {  showComments[j].style.display = 'none';      }
    }
}


    
};


















