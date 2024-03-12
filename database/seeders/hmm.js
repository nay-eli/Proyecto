$(document).on("click","#btnregistrar" ,()=>{
    Registrar();
 })
 
 
 function Registrar() {
     
     const nombres=$("#nombres").val();
     $("#resultado").text(nombres);
     const cedula=$("#cedula").val();
     $("#resultado1").text(cedula);
     const correo=$("#correo").val();  
     $("#resultado2").text(correo);
     let x=0;
     let card=
       let card=
       `<div class="card>`
       <span class="resultado1">1</span>
       <small class="heading">Nombres</small>
       <span class="resultado2">${nombres}</span>
       <small class="heading">Cedula</small>
       <span class="heading">${Cedula}</span>
        <small class="heading">correo</small>
        <span class="heading">${Cedula}</span>
        <div class="">
        <i class="fa-regular fa-trash-can btn btnDelete" style=`position:absolute;left:0px;bottom:4px`></i>
         <i class="fa-regular fa-trash-can btn btnDelete" style=`position:absolute;left:0px;bottom:4px`></i>
         </div>
         </div>
         ;
     
 
      $("#contenedor").append(card);
 
       }
 
       $(document).on("click",".btnDelete",function(){
              delete(this);
               })
       function editCard(button){
           const card=$(button).parent().parent();
           const name=$(card).find(txt).text();
           $("#nombres").val(names);
               const cedula=$(card).find(txt).text();
               $("#cedula").val(cedulas);
               const correo=$(card).find(txt).text();
               $("#correo").val(correos);
       }
       function deleteCard(button){
           $(button).parent().parent)(.remove();
       }
              
 
 