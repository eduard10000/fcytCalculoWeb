@extends($layout)

@section('content')
	<button onclick="fullCentral(this);">Expandir contenido</button>
	<div class="titulo"> 
    	Adm temas
	</div>
<!--<div id="ocultarColList">
	Ocultar columnas:
	<a class="toggle-vis" data-column="0">+</a> - 
	<a class="toggle-vis" data-column="1">Name</a> - 
	<a class="toggle-vis" data-column="2">Position</a> - 
	<a class="toggle-vis" data-column="3">Office</a> - 
	<a class="toggle-vis" data-column="4">Salary</a>
</div> -->
		

<button id="addTema">Añadir nuevo tema</button>
<button id="addItem">Añadir nuevo item</button>
<button id="addRecursos">Añadir nuevo Recurso</button>
<!-- crear nuevo tema -->
<div id="crearTema">
	<input type="text" id="nombreNuevoTema" size="50"></input>
    <button id="enviarCrearTema">Crear</button>
</div>

<!-- crear nuevo item -->
<div id="crearItem">
    <br/>
    <div id="dragandrophandler">Arrastre y suelte su archivo descartes aquí</div>
    <br><br>
    <div id="status1"></div>
    
        <div>Nombre Item</div>
        <input id="nombreNuevoItem" value="" type="text" name="nombreItem" required><br/>
        <div>Tema</div>
         <select id="listaTemas" value="tema" type="text" name="tema" required>
        </select> <br/>
        <button id="enviarCrearItem">Crear</button>
</div>

<!-- crear nuevo Recurso -->
<div id="crearRecursos">
    <br/>
    <div id="dragandrophandler2">Arrastre los recursos necesarios para los archivos descartes</div>
    <br><br>
    <div id="status2"></div>
        <button id="enviarCrearRecursos">Crear</button>
</div>
		
<table id="lista" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>nombreTema</th>
                <th>modificadoPor</th>
                <th>fechaModificacion</th>
                <th>Orden</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th></th>
                <th>nombreTema</th>
                <th>modificadoPor</th>
                <th>fechaModificacion</th>
                <th>Orden</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
@stop

@section('extra_script')
<link rel="stylesheet" media="screen" href="css/estilos.css">
<link rel="stylesheet" media="screen" href="css/jquery-ui.css" >
<link rel="stylesheet" media="screen" href="css/jquery.dataTables.css" >
<link rel="stylesheet" media="screen" href="css/dataTables.colVis.css" >
<link rel="stylesheet" media="screen" href="css/dataTables.keyTable.css" >
<link rel="stylesheet" media="screen" href="css/dataTables.tableTools.css" >
<link rel="stylesheet" media="screen" href="css/dataTables.colReorder.css" >
<script type="text/javascript" language="javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="js/dataTables.colReorder.js"></script>
<script type="text/javascript" language="javascript" src="js/dataTables.colVis.js"></script>
<script type="text/javascript" language="javascript" src="js/dataTables.fixedColumns.js"></script>
<script type="text/javascript" language="javascript" src="js/dataTables.keyTable.js"></script>
<script type="text/javascript" language="javascript" src="js/dataTables.tableTools.js"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/ui.datepicker-es.js"></script>
<script type="text/javascript" src="js/funcionesAdmTemas.js"></script>
<script type="text/javascript" src="js/crearItem.js"></script>
<script type="text/javascript" src="js/crearRecursos.js"></script>
<script type="text/javascript">
//variables globales auxiliares
//arrays que guardan valores previos
var objTemaOld=[]; //guardar nodos <div> que fueron cambiados por <select> o <input> cuando se editan temas
var objItemOld=[]; //guardar nodos <div> que fueron cambiados por <select> o <input> cuando se editan items
//variables auxiliares para los items
var objItem=""; //guarda conjunto de items
objItem.items= []; //para que no de error en algunos casos
//indicadores auxiliares de posicion de elementos en los temas
var colPosNT="1"; //columna con la posicion de nombre tema
var colPosET="7"; //columna con la posicion de editar tema
//indicadores auxiliares de posicion de elementos en los items
var colPosNI="0"; //columna con la posicion de nombre item
var colPosEI="8"; //columna con la posicion de editar item
//auxiliares drag and drop de los items para mover entre los temas
var dragIdItem="";
var dragIdTemaContenedor="";
var itemMover=""; //guarda el item que se esta moviendo
//auxiliares varios
var nombresArchivosItems=""; //variable que contiene el item 
var nombresArchivosRecursos="" // variable que contiene los Recursos
$(document).ready(function() {
var table = $('#lista').DataTable( {
	"ajax":  "getTemas",  /*"admTemas.txt"*/
	 "columns": [ //definicion de datos de columnas
		{
			"class":          'details-control',
			"orderable":      false,
			"data":           null,
			"defaultContent": ''
		},
		/* cambio para que conicidan con la base de datos para facilidad de trabajo con */
		
		{ "data": "contenido" }, /*nombreTema*/
		{ "data": "dniModificador" }, /*modificadoPor*/
		{ "data": "fechaModificacion" }, /*fechaModificacion*/
		{ "data": "orden" }, /*ordenTema*/
		{//ordenar
			"orderable":      false,
			"defaultContent": ''
		},
		{//editar
			"orderable":      false,
			"defaultContent": ''
		},
		{//eliminar
			"orderable":      false,
			"defaultContent": ''
		}
	], //fin definicion datos de columna
	"order": [[4, 'asc']], //ordenar por orden de tema
	"language": {"url": "js/dataTableSpanish.json"}, //lenguaje español
	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]], //opciones de cantidad de filas visibles
	dom: 'RTClfrtip', // dom habilita elementos Colvis (c),TableTools (T)
	columnDefs:  //define caracteristicas de las columnas contenido, ancho entre otros
	[
		{ //columna details-controls 
			width: 10, 
			targets: 0
		},		
		{ //columna nombre tema
			"render": function ( data, type, row )
			{
				aux="<div>"+data+"</div>";
				return aux;
			},
			"targets": 1
		},	
		{ //columna cambiar orden tema arriba
			"render": function ( data, type, row )
			{
				aux="<div class=temaAntes></div>";
				return aux;
			},
			"width":10,
			"targets": 5
		},	
		{ //columna cambiar orden tema abajo
			"render": function ( data, type, row )
			{
				aux="<div class=temaDespues></div>";
				return aux;
			},
			"width":10,
			"targets": 6
		},	
		{ //columna editar campos
			"render": function ( data, type, row )
			{
		
				
				aux="<div class=editarTema></div>";
				return aux;
			},
			"width":10,
			"targets": 7
		},		
		{ // columna eliminar temas
			"render": function ( data, type, row )
			{
		
				
				aux="<div class=eliminarTema></div>";
				return aux;
			},
			"width":10,
			"targets": 8
		},
	],// fin columnDefs
	tableTools: //table tools - opciones de guardado
	{
		"sSwfPath": "js/copy_csv_xls_pdf.swf", //archivo flash
		"aButtons": 
		[ 
			{
				"sExtends": "copy",
				"sButtonText": "Copiar"
			},
			{
				"sExtends": "print",
				"sInfo": "Presione Escape cuando finalize",
				"sButtonText": "Imprimir",
				"bShowAll": false,
			},
			{
				"sExtends": "pdf",
				"sAction": "flash_pdf",
				"sTitle": "My title",
				"sPdfMessage": "Your custom message would go here."
			},
			{
				"sExtends": "xls",
				"oSelectorOpts": 
					{page: 'current'}
			}
		] // fin botones de table tools
	}, //fin definicion de tabletools
	"colVis": { "buttonText": "Ocultar columnas"} //boton para ocular columnas
} ); //fin  var table = $('#lista').DataTable


//------------------------------  eventos  de temas--------------------
	
//añadir nuevo tema
$('#addTema').on( 'click', function () {
	mostrarOcultar("crearTema");
} );
	
//crear tema
$('#enviarCrearTema').on( 'click', function () {
	nombreNuevoTema=$('#nombreNuevoTema').val(); //tomo el valor del input
	mostrarOcultar("crearTema"); //oculto el input
	$.post( "crearTema",{ temaNuevo:nombreNuevoTema},function( resultado )
	{
		table.ajax.reload(); //recargo la tabla
	}, "json");
	
	
	
} );

//eliminar tema
$('#lista tbody').on( 'click', 'div.eliminarTema', function () {

	trAux=$(this).parents('td').parents('tr');
	idTemaEliminar=trAux.attr('id');
	if(trAux.attr('id')!='nT')
	{
		if (confirm('¿Esta seguro que desea eliminar este tema?'))
		{
			$.post( "eliminarTema",{ temaEliminar:idTemaEliminar},function( resultado )
			{
				table.ajax.reload();
			}, "json");
	
		}//envio por ajax del id del tema a eliminar
	}
} );

//editar tema
$('#lista tbody').on( 'click', 'div.editarTema', function () {
	var auxTr=$(this).parents('td').parents('tr');
	if(auxTr.attr('id')!='nT')
	{
		var div=document.getElementById(auxTr.attr('id')).childNodes[colPosNT].childNodes[0];
		objTemaOld[auxTr.attr('id')]=div.innerHTML; //guardo la informacion que contenia el div
		var objTemaNew=document.createElement("input"); //creo el elemento <input>
		objTemaNew.value=div.innerHTML; 
		objTemaNew.setAttribute('class', 'inputNombreTemaEditar');//agregar clase al boton input con el nombre del tema
		document.getElementById(auxTr.attr('id')).childNodes[colPosNT].replaceChild(objTemaNew,div); //lo reemplazo
		document.getElementById(auxTr.attr('id')).childNodes[colPosET].childNodes[0].setAttribute('class', 'guardarTema'); //cambio el boton de editar por el de guardar

	}
} );

//guardar tema
$('#lista tbody').on( 'click', 'div.guardarTema', function () {
	var auxTr=$(this).parents('td').parents('tr');
	var temaOld=objTemaOld[auxTr.attr('id')];
	temaGuardar=document.getElementById(auxTr.attr('id')).childNodes[colPosNT].childNodes[0];
	if(temaGuardar.value!=temaOld.innerHTML)
	{
		$.post( "editarTema",{ temaNombre:temaGuardar.value,idTema:auxTr.attr('id')},function( resultado )
		{
			table.ajax.reload();
		}, "json");	
	}
} );

//guardar el nombre del tema con el intro tambien

$('#lista tbody').on('keyup', 'input.inputNombreTemaEditar', function (event) {
	if(event.which==13)
	{
		var auxTr=$(this).parents('td').parents('tr');
		var temaOld=objTemaOld[auxTr.attr('id')];
		temaGuardar=document.getElementById(auxTr.attr('id')).childNodes[colPosNT].childNodes[0];
		if(temaGuardar.value!=temaOld.innerHTML)
		{
			$.post( "editarTema",{ temaNombre:temaGuardar.value,idTema:auxTr.attr('id')},function( resultado )
			{
				table.ajax.reload();
			}, "json");	
		}
	}
  });



//dismiur orden de un tema
$('#lista tbody').on( 'click', 'div.temaAntes', function () {
	var auxTr=$(this).parents('td').parents('tr');
	var tema=auxTr.attr('id');
	if(auxTr.attr('id')!='nT' && auxTr.attr('id')!='itemPapelera' && !auxTr.hasClass('primerTema')) 
	{
		$.post( "ordenTema",{ temaCambiarOrden:tema,orden:'antes'},function( resultado )
		{
			table.ajax.reload();
		}, "json");
	}
	} );

//aumentar el orden de un tema
$('#lista tbody').on( 'click', 'div.temaDespues', function () {
	var auxTr=$(this).parents('td').parents('tr');
	var tema=auxTr.attr('id');
	if(auxTr.attr('id')!='nT' && auxTr.attr('id')!='itemPapelera' && !auxTr.hasClass('ultimoTema'))
	{
		$.post( "ordenTema",{ temaCambiarOrden:tema,orden:'despues'},function( resultado )
		{
			table.ajax.reload();
		}, "json");
	}
	} );

//------------------------------  eventos  de items--------------------
//añadir nuevo item
$('#addItem').on( 'click', function () {
	mostrarOcultar("crearItem");
	if(document.getElementById("crearItem").style.display!="none")
	{
		$.post( "getListaTemas",{},function( resultado )
			{
				for(i = 0; i < resultado.length; i++)
				{
					var op = document.createElement("OPTION"); 
					op.value=resultado[i].idTema;
					op.text=resultado[i].contenido;
					document.getElementById('listaTemas').appendChild(op);
				}
			}, "json");
	}
} );
	
//crear item
$('#enviarCrearItem').on( 'click', function () {
	nombreNuevoItem=$('#nombreNuevoItem').val(); //tomo el valor del input
	rutaaArchivoTemp= nombresArchivosItems;
	idTemaP=document.getElementById('listaTemas').value;
	mostrarOcultar("crearItem"); //oculto el input
	$.post( "crearItem",{nombreItem:nombreNuevoItem,ruta:rutaaArchivoTemp,idTema:idTemaP},function( resultado )
	{
		console.log(resultado);
		table.ajax.reload(); //recargo la tabla
	}, "json");
	
	
	
} );

//------------------------------  eventos  de Recurso--------------------
//añadir nuevo Recursos
$('#addRecursos').on( 'click', function () {
	mostrarOcultar("crearRecursos");

} );
	
//crear Recursos
$('#enviarCrearRecursos').on( 'click', function () {

	rutasaArchivosTemp= nombresArchivosRecursos;
	mostrarOcultar("crearRecursos"); //oculto el input
	$.post( "crearRecursos",{rutas:rutasaArchivosTemp},function( resultado )
	{
		console.log(resultado);
		table.ajax.reload(); //recargo la tabla
	}, "json");
	
	
	
} );





$('#lista tbody').on('click', 'td.details-control', function ()  //sub menu de items abrir
{
	var tr = $(this).closest('tr');
    var row = table.row( tr );
    if ( row.child.isShown() )
	{
    	row.child.hide();
        tr.removeClass('shown');
    }
    else 
	{
		objItem=row.data(); //objeto que guarda lista de items de un tema
		
		if(typeof(objItem.items) != "undefined") //temas si i
		{
			row.child( crearTablaItem() ).show();
			tr.addClass('shown');
		}
		else
		{
			row.child( crearTablaItemVacia() ).show();
			tr.addClass('shown'); 
		}
	}

var tableItem = $('.listaItems').DataTable( {
	retrieve: true,//retrieve y paging se usan para evitar que cuando se llame devuelta a la tabla no tire un warning
    paging: false,
	"data": objItem.items, //json que envia el td details controls
	"columns": 
	[
		{ "data": "nombreItem" },
		{ "data": "modificadoPor" },
		{ "data": "fechaModificacion" },
		{ "data": "ordenItem" },
		{//ordenar
			"orderable":      false,
			"defaultContent": ''
		},
		{//mover de tema
			"orderable":      false,
			"defaultContent": ''
		},
		{//previsualizar
			"orderable":      false,
			"defaultContent": ''
		},
		{//editar
			"orderable":      false,
			"defaultContent": ''
		},
		{//eliminar
			"orderable":      false,
			"defaultContent": ''
		}
	], //fin definicion  datos de columnas
	"order": [[3, 'asc']],
	"language": {"url": "js/dataTableSpanish.json"},
	dom: '', //para cambiar el orden de las columnas
	columnDefs:  //controla ancho de columnas
       [    	
			{ //nombre item
				"render": function ( data, type, row )
				{
					aux="<div>"+data+"</div>";
					return aux;
				},
				"width":220,
				"targets": 0
			},
			{ //modificado por
				"render": function ( data, type, row )
				{
					aux="<td>"+data+"</td>";
					return aux;
				},
				"width":220,
				"targets": 1
			},
			{ //cambiar orden item arriba
				"render": function ( data, type, row )
				{
					aux="<div class=itemAntes orden="+row.ordenItem+" ></div>";
					return aux;
				},
				"width":20,
				"targets": 4
			},
			{ //cambiar orden item abajo
				"render": function ( data, type, row )
				{
					aux="<div class=itemDespues orden="+row.ordenItem+"></div>";
					return aux;
				},
				"width":20,
				"targets": 5
			},
			{ //mover item de tema
				"render": function ( data, type, row )
				{
					aux="<div class=moverItem><img src=../public/img/mover.png   draggable=true alt=> </div>";
					return aux;
				},
				"width":10,
				"targets": 6
			},
			{ //previsualizar
				"render": function ( data, type, row )
				{
					
					aux='<a href="getContentItem?idItem='+"poner el id item"+'" target="_blank" onClick="window.open(this.href, this.target, "width=300,height=400"); return false;"> <div class=previsualizar></div></a>';
					return aux;
				},
				"width":10,
				"targets": 7
			},
			{ //editar item
				"render": function ( data, type, row )
				{
			
					
					aux="<div class=editarItem></div>";
					return aux;
				},
				"width":10,
				"targets": 8
			},
			{ //eliminar
				"render": function ( data, type, row )
				{
			
					
					aux="<div class=eliminarItem ></div>";
					return aux;
				},
				"width":10,
				"targets": 9
			},
        ] //fin definicion de renderizado de columnas
} ); //fin  var tableItem = $('.listaItems').DataTable( {

}); //fin td details

function crearTablaItem () 
{
	tabla="<table class=listaItems><thead><th>Nombre Item</th><th>Modificado por</th><th>fecha</th><th>Orden</th><th></th><th></th><th></th><th></th><th></th><th></th></thead></table>";
	return tabla;
}

function crearTablaItemVacia () 
{
	div="<div>No existen items para este tema</div";
	return div;
}

//eliminar item
$('body').on( 'click', 'div.eliminarItem', function () {
	
	if (confirm('¿Esta seguro que desea eliminar este item?'))
	{
		var auxTr=$(this).parent('td').parent('tr');
		idItemEliminar=auxTr.attr('id');
		$.post( "eliminarItem",{ itemEliminar:idItemEliminar},function( resultado )
			{
				table.ajax.reload();
			}, "json");
		//envio de datos por ajax y corregir encabezado que queda
	}
} );

//dismiur orden de un item
$('#lista tbody').on( 'click', 'div.itemAntes', function () {
	var auxTr=$(this).parents('td').parents('tr');
	var itemTema=auxTr.attr('id');
	if(!auxTr.hasClass('primerItem'))
	{
		$.post( "ordenItem",{ itemCambiarOrden:itemTema,orden:'antes'},function( resultado )
		{
			table.ajax.reload();
			
		
		}, "json");
	}
	} );

//aumentar el orden de un item
$('#lista tbody').on( 'click', 'div.itemDespues', function () {
	var auxTr=$(this).parents('td').parents('tr');
	var itemTema=auxTr.attr('id');
	if(!auxTr.hasClass('ultimoItem'))
	{
		$.post( "ordenItem",{ itemCambiarOrden:itemTema,orden:'despues'},function( resultado )
		{
			table.ajax.reload();
		}, "json");
	}
	} );
	
//editar item
$('#lista tbody').on( 'click', 'div.editarItem', function () {
	var auxTr=$(this).parents('td').parents('tr');
	var div=document.getElementById(auxTr.attr('id')).childNodes[colPosNI].childNodes[0];
	objItemOld[auxTr.attr('id')]=div.innerHTML; //guardo la informacion que contenia el div
	var objItemNew=document.createElement("input"); //creo el elemento <input>
	objItemNew.value=div.innerHTML; 
	objItemNew.setAttribute('class', 'inputNombreItemEditar');//agregar clase al boton input con el nombre del tema
	document.getElementById(auxTr.attr('id')).childNodes[colPosNI].replaceChild(objItemNew,div); //lo reemplazo
	document.getElementById(auxTr.attr('id')).childNodes[colPosEI].childNodes[0].setAttribute('class', 'guardarItem'); //cambio el boton de editar por el de guardar
} );

$('#lista tbody').on( 'click', 'div.guardarItem', function () {
	var auxTr=$(this).parents('td').parents('tr');
	var itemOld=objItemOld[auxTr.attr('id')];
	itemGuardar=document.getElementById(auxTr.attr('id')).childNodes[colPosNI].childNodes[0];
	if(itemGuardar.value!=itemOld.innerHTML)
	{
		$.post( "editarItem",{ itemNombre:itemGuardar.value,idItem:auxTr.attr('id')},function( resultado )
		{
			table.ajax.reload();
		}, "json");	
	}
} );

//en proceso

//guardar el nombre del item con el intro tambien
$('#lista tbody').on('keyup', 'input.inputNombreItemEditar', function (event) {
	if(event.which==13)
	{
		var auxTr=$(this).parents('td').parents('tr');
		var itemOld=objItemOld[auxTr.attr('id')];
		itemGuardar=document.getElementById(auxTr.attr('id')).childNodes[colPosNI].childNodes[0];
		if(itemGuardar.value!=itemOld.innerHTML)
		{
			$.post( "editarItem",{ itemNombre:itemGuardar.value,idItem:auxTr.attr('id')},function( resultado )
			{
				table.ajax.reload();
			}, "json");	
		}
	}
  });

//pruebas

function allowDrop(ev) { //evita inconvenientes con el drag and drop
    ev.preventDefault();
}

function drag(ev) {
	auxiliarItemMover=ev.parents(); //item que llamo a la funcion
	itemMover=auxiliarItemMover[2];
	dragIdItem=itemMover.id;
	auxiliarTemaOrigen=itemMover.parentNode.parentNode.parentNode.parentNode;
	temaOrigen=auxiliarTemaOrigen.previousSibling;
	dragIdTemaContenedor=temaOrigen.id;
}

function drop(ev) {
    ev.preventDefault();
	temaDestino=ev.target.parentNode;
	if(dragIdTemaContenedor!=temaDestino.id)
	{
		$.post( "moverItem",{ idItem:dragIdItem,idTemaDestino:temaDestino.id},function( resultado )
		{
			table.ajax.reload();
			
		}, "json");	
	}
}


$('#lista tbody').on( 'drop','tr', function (event) {
console.log('disparador ondrop');
drop(event);
	
} );

$('#lista tbody').on( 'dragover','tr.drop', function (event) {  //evita inconvenientes con el drag and drop
allowDrop(event);
	
} );

$('#lista tbody').on( 'dragstart','tr.drag td img', function (event) {
drag($(this));
	
} );

//captura el evento drag
/*$('#lista tbody').on( 'dragstart','tr.drag td img', function () {
	console.log('entro');
	itemMover=$(this); //item que llamo a la funcion
	dragIdItem=itemMover.attr('id');
	auxiliarTemaOrigen=itemMover.parents();
	temaOrigen=auxiliarTemaOrigen[3].previousSibling;
	dragIdTemaContenedor=temaOrigen.id;
	
} );

	// en proceso
$('#lista tbody').on( 'drop','tr.drop td img', function (event) {
	
	temaDestino=$(this);
console.log('entro a la segunda');
	/*if(dragIdTemaContenedor!=temaDestino.attr('id'))
	{
		$.post( "moverItem",{ idItem:dragIdItem,idTemaDestino:temaDestino.attr('id')},function( resultado )
		{
			table.ajax.reload();
			
		}, "json");	
	}*/

/*} );*/


} ); //fin $(document).ready(function()
</script>

@stop
