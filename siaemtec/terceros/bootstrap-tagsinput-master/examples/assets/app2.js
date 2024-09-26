$(function() {
    

  $('input, select').on('change', function(event) {
      
    var $element = $(event.target),
      $container = $element.closest('.example');

    if (!$element.data('tagsinput'))
      return;
      
    var val = $element.val();
    var noc = JSON.stringify($element.tagsinput('items'))
    var totalOfItems=$element.tagsinput('items');
        
    console.log(totalOfItems.length)
    
    if(totalOfItems.length>=30){
        alert('El máximo de equipos permitidos es 30')
    }else{
    if (val === null)
      val = "null";
    $('code', $('pre.val', $container)).html( ($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\"") );
    //-- Agregaste este input
    $('#EQUIPOSid').val( ($.isArray(val) ? JSON.stringify(val) : "" + val.replace('"', '\\"') + "") );
      //
      //-- Agregaste este input
    $('#EQUIPOSnoc').val(noc);
      //
    $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));}
      
  }).trigger('change');
    
    
    
});