$( document ).ready(function(){

  //Asigno una funcion al evento click del boton
  $("#boton_buscar").on('click',buscarProducto);

  //Asigno una funcion al evento onchange del select
  $("#color").on('change',buscarProducto); 

});


/*************************************************************
 * Funcion que se asocia al evento "click" del boton de Buscar
 * Recibe del backend una imagen que se asocia al src de la imagen a mostrar
 */
var buscarProducto = function(){
    //Tomo el nro de producto a buscar, escrito en el input
    var nro_producto = $("#nro_producto").val();
    var color = $("#color").val();

    //Verifico que se ingresa un nro_producto valido
    if($.isNumeric(nro_producto)){

      //Armo el tag html de la imagen a mostrar
      imagen=$("<img id='imagen_generada' src=''/>");

      //esta sera src de la imagen, este PHP va a generar la imagen on the fly y la devolvera al browser
      //va a recibir el id del producto, busca en la DB y genera la imagen con los datos
      var urlImagen = "includes/generaImagen.php?nro_producto="+nro_producto+"&color="+color;

      //coloco el tag HTML en el div correspondiente
      $("#imagen_de_salida").html(imagen);

      //le asigno lo que devuelva el generador de imagen PHP a al src de la imagen
      $("#imagen_generada").attr("src",urlImagen);
    }
}
