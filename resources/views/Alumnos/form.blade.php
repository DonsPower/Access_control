<div class="form-group">
<label for="Nombre" class="control-label">{{'Nombre'}}</label>
<input type="text" class="form-control"  name="Nombre" id="Nombre" value="{{isset($alumno->Nombre)?$alumno->Nombre:''}}">
</div>
<div class="form-group">
<label for="ApellidoP" class="control-label">{{'ApellidoP'}}</label>
<input type="text" class="form-control" name="ApellidoP" id="ApellidoP" value="{{isset($alumno->ApellidoP)?$alumno->ApellidoP:''}}">
</div>
<div class="form-group">
<label for="ApellidoM" class="control-label">{{'ApellidoM'}}</label>
<input type="text" class="form-control" name="ApellidoM" id="ApellidoM" value="{{isset($alumno->ApellidoM)?$alumno->ApellidoM:''}}">
</div>
<div class="form-group">
<label for="ProgramaAcademico" class="control-label">{{'ProgramaAcademico'}}</label>
<input type="text" class="form-control"  name="ProgramaAcademico" id="ProgramaAcademico" value="{{isset($alumno->ProgramaAcademico)?$alumno->ProgramaAcademico:''}}">
</div>
<div class="form-group">
<label for="Boleta" class="control-label">{{'Boleta'}}</label>
<input type="text" class="form-control" name="Boleta" id="Boleta" value="{{isset($alumno->Boleta)?$alumno->Boleta:''}}">
</div>
<div class="form-group">
<label for="TelefonoMovil" class="control-label">{{'TelefonoMovil'}}</label>
<input type="text"  class="form-control" name="TelefonoMovil" id="TelefonoMovil" value="{{isset($alumno->TelefonoMovil)?$alumno->TelefonoMovil:''}}">
</div>
<div class="form-group">
<label for="TelefonoFijo" class="control-label">{{'TelefonoFijo'}}</label>
<input type="text" class="form-control"  name="TelefonoFijo" id="TelefonoFijo" value="{{isset($alumno->TelefonoFijo)?$alumno->TelefonoFijo:''}}">
</div>
<div class="form-group">
<label for="TelefonoPersonal" class="control-label">{{'TelefonoPersonal'}}</label>
<input type="text" class="form-control" name="TelefonoPersonal" id="TelefonoPersonal" value="{{isset($alumno->TelefonoPersonal)?$alumno->TelefonoPersonal:''}}">
</div>
<div class="form-group">
<label for="Correo" class="control-label">{{'Correo'}}</label>
<input type="email" class="form-control" name="Correo" id="Correo" value="{{isset($alumno->Correo)?$alumno->Correo:''}}">
</div>
<div class="form-group">
<label for="NSS" class="control-label">{{'NSS'}}</label>
<input type="text" class="form-control"  name="NSS" id="NSS" value="{{isset($alumno->NSS)?$alumno->NSS:''}}">
</div>
<input type="submit" class="btn btn-success" value="{{$Modo=='crear' ? 'Agregar':'Modificar'}}">
<a class="btn btn-primary" href="{{url('Alumnos')}}">Regresar</a>