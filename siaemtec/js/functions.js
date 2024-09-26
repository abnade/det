$(document).ready(function()
{
	/**
    *@desc- retrasa el evento keyup
    *@param fn - function
    *@param ms - milisegundos que queremos retrasar
    */
    $.fn.delayPasteKeyUp = function(fn, ms)
    {
        var timer = 0;
        $(this).on("keyup paste", function()
        {
            clearTimeout(timer);
            timer = setTimeout(fn, 1);
        });
    };
 
    $("input[name=EMPRESA]").delayPasteKeyUp(function()
    {
        $.ajax({
        	type: "POST",
            url: "app/instancias/autocomplete.php",
            data: "autocomplete="+$("input[name=EMPRESA]").val(),
            success: function(data)
            {
            	if(data)
            	{
            		var json = JSON.parse(data),
            			html = '<div class="list-group">';
            		if(json.res == 'full')
            		{
            			for(datos in json.data)
            			{
            				html+='<a href="#" onclick="info('+json.data[datos].ID_PROVEEDOR+',\''+json.data[datos].PROVEEDOR+'\')" class="list-group-item">';
            				html+='<p class="list-group-item-heading">';
            				html+='' + json.data[datos].PROVEEDOR+'</p>';
            				html+='</a>';
            			}
            		}
            		else
            		{
            			html+='<a href="#" class="list-group-item">';
        				html+='<h4 class="list-group-item-heading">No se ha encontrado nada con '+$("input[name=autocomplete]").val()+'</h4>';
        				html+='</a>';
            		}
            		html+='</div>';
            		$("#busqueda").html("").append(html);
            	}
            }
        });
    }, 500);

	$(document).on("click", "a", function()
	{
		$("a").removeClass("active");
		$(this).addClass("active");
	})
});

//al pulsar en los enlaces muestra su información
function info(id,nombre)
{
	//alert("ID: " + id + " Nombre: " + nombre);
	document.getElementById("EMPRESA").value=nombre
	html = '<div class="list-group">';
	html+='</div>';
            		$("#busqueda").html("").append(html);
}