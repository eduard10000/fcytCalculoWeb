@extends($layout)

@section('content')
	<button onclick="fullCentral(this);">Expandir contenido</button>
	<div class="titulo"> 
    	Adm usuarios
	</div>
<!--<div id="ocultarColList">
	Ocultar columnas:
	<a class="toggle-vis" data-column="0">+</a> - 
	<a class="toggle-vis" data-column="1">Name</a> - 
	<a class="toggle-vis" data-column="2">Position</a> - 
	<a class="toggle-vis" data-column="3">Office</a> - 
	<a class="toggle-vis" data-column="4">Salary</a>
</div> -->
		

		
<table id="lista" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
				<th>dni</th>
                <th>apellido</th>
                <th>nombre</th>
                <th>email</th>
                <th>perfil</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th></th>
				<th>dni</th>
                <th>apellido</th>
                <th>nombre</th>
                <th>email</th>
                <th>perfil</th>
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

<script type="text/javascript" src="js/efectos.js"></script>
<script type="text/javascript">
/* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
	a='<img class="tableDetallesImagen" id="imagenPrev"'+
	'src="img/'+d.imagen+'" alt="vista previa de imagen"></img>';
    return a+'<div class="tableDetallesInf"><table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Fecha de nacimiento:</td>'+
            '<td>'+d.fechaNacimiento+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>fechareg:</td>'+
             '<td>'+d.fechaRegistro+'</td>'+
        '</tr>'+
		'<tr>'+
            '<td>fechahab:</td>'+
             '<td>'+d.fechaAlta+'</td>'+
        '</tr>'+
    '</table></div>';
}
 
$(document).ready(function() {
    var table = $('#lista').DataTable( {
	"bDestroy": true, // parametro agregado por si se vulve reescribir

        "ajax": "<?php echo $request;?>", // getUsers  o getUsersNew
        "columns": [
            {
                "class":          'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
			// prueba
			{ "data": "dni" },
			{ "data": "apellido" },
            { "data": "nombre" },
            { "data": "email" },
            { "data": "idPerfil" }
			/**/
			
            /*{ "data": "name" },
            { "data": "position" },
            { "data": "office" },
            { "data": "salary" }*/
        ],
		"order": [[1, 'asc']],
			"language": {
			"url": "js/dataTableSpanish.json"
		},
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
		 dom: 'RTClfrtip', //para cambiar el orden de las columnas
		 
		columnDefs:  //controla ancho de columnas
        [    
			{ 
				width: 10, 
				targets: 0
			},
			{
                "render": function ( data, type, row )
				{
                    /*
					<select id="permiso0">
						<option value="2">Profesor</option></select> 
					*/
					/*
					
					aux='<select><option value="-1">Eliminar</option>';
					aux=aux+'<option value="'+data+'" selected="selected">'+row.idPerfil+'</option>';
					if(data!=0)
						aux=aux+'<option value="0">No Habilitado</option>';
					if(data!=1)
						aux=aux+'<option value="1">Alumno</option>';
					if(data!=2)
						aux=aux+'<option value="2">Profesor</option>';
					return aux;
					*/
/*				
				switch (data)
					{
						case 0:
						row.idPerfil ="No Habilitado" ;
						break;
						case 1:
						row.idPerfil ="Alumno" ;
						break;
						case 2:
						row.idPerfil ="Profesor" ;
						break;
						
					}
					
					
					aux='<select><option value="-1">Eliminar</option>';
					aux=aux+'<option value="'+data+'" selected="selected">'+row.idPerfil+'</option>';
					if(data!=0)
						aux=aux+'<option value="0">No Habilitado</option>';
					if(data!=1)
						aux=aux+'<option value="1">Alumno</option>';
					if(data!=2)
						aux=aux+'<option value="2">Profesor</option>';
					return aux;
 */					
				
					aux='';
					aux=aux+'<select class="target"><option value="-1">Eliminar</option>';
					aux=aux+'<option value="0"'; if (data==0) aux=aux+' selected="selected"'; aux=aux+'>No Habilitado</option>';
					aux=aux+'<option value="1"'; if (data==1) aux=aux+' selected="selected"'; aux=aux+'>Alumno</option>';
					// restringe permiso si no es administrador
					<?php if($layout== "layouts.administrador"){ ?>
					aux=aux+'<option value="2"'; if (data==2) aux=aux+' selected="selected"'; aux=aux+'>Profesor</option>';
					<?php }?>
					aux=aux+'</select>'; 
					
					return aux;
				
				},
                "targets": 5
            }
        ],
		//table tools - opciones de guardado
			tableTools: {
             "sSwfPath": "js/copy_csv_xls_pdf.swf",
			"aButtons": [ 
				//"print",
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
                    "oSelectorOpts": {
                        page: 'current'
                    }
                }

			]
        },
		"colVis": {
            "buttonText": "Ocultar/Mostrar columnas"
        }

		
		
    } );
     
    // Add event listener for opening and closing details
    $('#lista tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
	
/*	 $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );*/
	

	var keys=new $.fn.dataTable.KeyTable( table ); //resaltar celdas

	// select agregado eduardo 
	$('#lista tbody').on( 'change', 'select', function () {
	
	
	
        var data = table.row( $(this).parents('tr') ).data();
		
		
		if (confirm('Esta seguro que desea cambiar los permisos de este usuario')) {
        //alert( data.dni);
		//alert( $(this).val()); // cambiado
		//alert( data.idPerfil; // original
		
		// cambiar permiso
		$.post( "changeUsers",{ dni: data.dni,idPerfil: $(this).val() },function( datos ) {
			alert(datos.mensaje);
			if(datos.recargar=='true')
				location.reload();
		}, "json");
		
		table.row('.selected').remove().draw( false );
        }
		else  // volver atras con los permisos
			$(this).val(data.idPerfil);
		
		
		//fin 
		
       //alert( data.dni);
		
    } );

	
} );
</script> 
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/ui.datepicker-es.js"></script>
<script>
$(function() {
$( "#calendario" ).datepicker();
});
</script> 
<script>

</script>
@stop


