// alert("hola")
const TIPO_DOCUMENTO_PERMITIDO="application/pdf"

function mensajeCargarDeArchivo(){
    let textoInputFiles=document.getElementById("textoInputFiles")
    let archivoPdf=document.getElementById("archivoPdf")
    if(archivoPdf.files.length>0){
        if(archivoPdf.files[0].type===TIPO_DOCUMENTO_PERMITIDO){
            Swal.fire(
                'Archivo Cargardo con Exito',
                '',
                'success'
              )
            
              textoInputFiles.textContent=archivoPdf.files[0].name
        }
        else{
            Swal.fire(
                'No es un archivo valido solo solo se puede cargar archivo  del tipo Pdf',
                '',
                'warning'
              )
              archivoPdf.files=[]
        }
       
    }
    else{
        textoInputFiles.textContent="Abjuntar Pdf"
    }
}

function guardar(event){
    event.d()
    let archivoPdf=document.getElementById("archivoPdf")
    let formulario=document.getElementById("formulario")
    if(archivoPdf.files.length>0){
        formulario.submit()
    }
    else{
        Swal.fire(
            'Porfavor ajunte un archivo para poder continuar',
            '',
            'warning'
          )
    }
}