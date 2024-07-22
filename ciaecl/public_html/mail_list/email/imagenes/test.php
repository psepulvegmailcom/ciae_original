<script type="text/javascript" language="JavaScript">
var futuro = new Date (2010,10,30,23,59);
var actualiza = 1000;
function faltan(){
var ahora = new Date();
var faltan = futuro - ahora;
if (faltan > 0){
var segundos = Math.round(faltan/1000);
var minutos = Math.floor(segundos/60);
var segundos_s = segundos%60;
var horas = Math.floor(minutos/60);
var minutos_s = minutos%60;
var dias = Math.floor(horas/24);
var horas_s = horas%24;
document.formulario.reloj.value= dias + " dias : " + horas_s + " horas : " +
+minutos_s + " minutos : " + segundos_s + " segundos" ;
setTimeout("faltan()",actualiza);
}
else {
document.formulario.reloj.value= "0 dias : 0 horas : 0 minutos : 0 segundos" ;
return true;
}
}
</script>
</head>
<BODY onload="faltan()" bgcolor="#0B111A">
<form name="formulario" style="font-family: Corbel; padding: 0">
<p align="center"><font face="Corbel">
<input type="text" name="reloj" value="" size="55" style="border-style:solid; border-width:0; padding:0; text-align : center; font-family:Corbel; color:#FF9900; background-color:#0B111A">
</font></p>
</form>
</body>
</html>