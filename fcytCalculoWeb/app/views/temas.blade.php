@extends($layout)

@section('content')
	<button onclick="fullCentral(this);">Expandir contenido</button>
	<div class="titulo"> 
    	Temas
	</div>

<div id="menuTemasItems">
	<ul id="ulTemasItems">
	</ul>
</div>
<div id="itemMostrado">

</div>
@stop
@section('extra_script')
<link rel="stylesheet" media="screen" href="css/estilos.css">
<link rel="stylesheet" media="screen" href="css/jquery-ui.css" >
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(function() {
		$.post( "getListaTemasItems",{},function( resultado )
		{
			for(i = 0; i < resultado.length; i++)
			{
				//creacion del tema
				//creo el elemento li
				var liTema = document.createElement("LI");
				liTema.className='nivel1';
				//creo el elemento a y lo agrego al li
				var aTema = document.createElement("A");
				aTema.href='#';
				aTema.id=resultado[i].idTema; 	
				aTema.text=resultado[i].contenido;
				liTema.appendChild(aTema);
				//fin creacion tema
				//comienzo creacion item al tema
				//pregunto si el tema tiene items
				if(resultado[i].items)
				{
					//creacion de ul
					var ulItem = document.createElement("UL");
					for(j = 0; j < resultado[i].items.length; j++)
					{
						var liItem = document.createElement("LI");
						var aItem = document.createElement("A");
						aItem.href='#';
						aItem.id=resultado[i].items[j].idItem; 	
						aItem.text=resultado[i].items[j].nombreItem;
						// evento que busca y trae el item
						aItem.addEventListener("click",function(){ getItem(aItem.id);}	);
						liItem.appendChild(aItem);
						ulItem.appendChild(liItem);
					}
					liTema.appendChild(ulItem);
				}
				//agrego el elemento li final
				document.getElementById('ulTemasItems').appendChild(liTema);
			}
		}, "json");	
});
</script>

<script type="text/javascript">
// solo link que sean de la clase item;



// cambio la llamda por objetc mejor para el html y estandarizar

function getItem(idItem)	
{		// utilizando la etiqueta object traigo el elemento
		document.getElementById('itemMostrado').innerHTML ='<object type="text/html" data="getContentItem?idItem='+idItem+'" style="width: 100%; height:800px;" >  No pudo obtener el archivo </object>';
					// remover /"  y \/"
		
}


</script>

<script type='text/javascript' src='lib/descartes-min.js'></script>
@stop
