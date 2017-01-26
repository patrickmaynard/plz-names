 populate = function(selection){
  $('#visibleplz')[0].value = selection.innerHTML;
  plz = selection.innerHTML.split(' ' )[0];
  $('#hiddenplz')[0].value = plz;
  $('#dropdown').hide();
 }


 $(function(){
      $('#visibleplz').keyup(function(){
          if($('#visibleplz')[0].value.length > 2){ 
              url = 'http://patrickmaynard.com/plz/endpoint.php?description='+$('#visibleplz')[0].value;  
              $.getJSON(url,function(data){
                    $('#dropdown').show();
                    $('#dropdown')[0].innerHTML = ''; 
                    $(data).each(function(i,v){
                          $('#dropdown')[0].innerHTML += '<p onclick="populate(this)">'+v.description+'</p>';
                        }); 
                  }); 
              }   
          }); 
 });
