// JavaScript Document

function escribirEnTop(){
	//document.write("hola");
}

function borrarRegistro(pagina){
	if(confirm("¿Desea realmente eliminar el registro?")){
		window.location = pagina+"&DeleteRegistro=ok"
	}
}

function go(pagina){
	window.location = pagina;
}