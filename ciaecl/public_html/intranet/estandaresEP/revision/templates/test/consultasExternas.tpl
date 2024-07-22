 <script>
function buscarRut(){

var rut = document.main.ate_institucion_rut.value;
var dv = document.main.ate_institucion_dv.value;
buscarRutSII(rut,dv);
}
function buscarRBD(){

var rbd = document.main.ate_rbd_rut.value; 
  buscarRBDMineduc(rbd);
  
}
</script> <button onclick="javascript:buscarRut();" type="button"><span>Revisar Rut </span></button>
	<br /><br />
	<button onclick="javascript:buscarRBD();" type="button"><span>Revisar RBD </span></button><br /><br /><input type="text" name="ate_rbd_rut" value="4083" style="width:20%"  ><br /><br /> 
 <div id='test_rbd'></div>
	
	<br /><button onclick="javascript:showFrame();" type="button"><span>Revisar Frame </span></button>
	 

<script>
function showFrame(){
alert(document.getElementById('frame_rbd').innerHTML);
}</script>

 
 