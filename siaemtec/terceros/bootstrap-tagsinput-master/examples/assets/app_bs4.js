var citynames = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: {
    url: 'bootstrap-tagsinput-master/examples/assets/Inventario.php?tipo=',
    filter: function(list) {
      return $.map(list, function(cityname) {
        return { name: cityname }; });
    }
  }
});
citynames.initialize();

var cities = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: {
      url: 'bootstrap-tagsinput-master/examples/assets/Inventario.php?tipo=',
        replace: function () {
            var q = 'bootstrap-tagsinput-master/examples/assets/Inventario.php?tipo=';
               /*$('#TIPO_DOCUMENTO').change(function() {*/
                q += $("#TIPO_DOCUMENTO option:selected").val();
            /*});*/
             console.log(q)
            return q;
  } },
    cache: false,
   
});
cities.initialize();


 /* Typeahead
 */
var elt = $('.example_typeahead > > input');
elt.tagsinput({
  typeaheadjs: {
    name: 'citynames',
    displayKey: 'name',
    valueKey: 'name',
    source: citynames.ttAdapter()
  }
});

/**
 * Objects as tags
 */
elt = $('.example_objects_as_tags > > input');
elt.tagsinput({
  itemValue: 'value',
  itemText: 'text',
  typeaheadjs: {
    name: 'cities',
    displayKey: 'text',
    source: cities.ttAdapter()
  }
});




// HACK: overrule hardcoded display inline-block of typeahead.js
$(".twitter-typeahead").css('display', 'inline');
