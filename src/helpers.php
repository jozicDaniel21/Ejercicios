<?php 


	function quitarEspacio($value)
	{
		return Text\Format::quitarEspacio($value);
	}

	function encontrarMensaje($msj, $instruccion)
	{
		return  Text\Format::encontrarMensaje($msj, $instruccion);
	}

	function arrayToString($value)
	{
		return  Text\Format::arrayToString($value);
	}

	function filtrarMensaje($mensaje)
	{
		return Text\Format::FiltrarMensaje($mensaje);
	}

	function validarNumero($cantdidad, $tipo)
	{
		 return Text\Format::validarNumero($cantdidad, $tipo);
	}

	 function validarInstruccion($instruccion)
	{
		return Text\Format::validarInstruccion($instruccion); 
	}

	function validarMensaje($mensaje)
	{
		return Text\Format::validarMensaje($mensaje);
	}

?>
