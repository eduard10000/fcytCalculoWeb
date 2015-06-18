
//oculta las barras laterales

// style="display: none" para ocultar el contenido completo
// style="display: table-cell" para ponerlo normal
anchoOriginal=document.getElementById("central").style.width;

function fullCentral(boton)
{
	if(document.getElementById("menuIzq").style.display=="none")
	{
	document.getElementById("menuDer").style.display="table-cell";
	document.getElementById("menuIzq").style.display="table-cell";
	document.getElementById("central").style.width=anchoOriginal;
	boton.innerHTML="Expandir contenido";

	}
	else
	{
	document.getElementById("menuIzq").style.display="none";
	document.getElementById("menuDer").style.display="none";
	document.getElementById("central").style.width="100%";
	boton.innerHTML="Contraer contenido";	
	}
}

function mostrarOcultar(id)
{
	if(document.getElementById(id).style.display=="block")
		{
			document.getElementById(id).style.display="none";
		}
	else
		{
			document.getElementById(id).style.display="block";
		} 
}