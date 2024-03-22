En el archivo bienvenida.py utilizado en los videos anteriores, agregar los siguientes cambios:

1. Agregar una caja de texto para ingresar el apellido
2. Agregar otra caja de texto para ingresar el apodo
3. Cambiar el texto del botón, en lugar de OK, que diga SALUDAR
4. Al presionar el botón, mostrar un mensaje que involucre el nombre, el apellido y el apodo ingresados por el usuario.
5. Agregar un nuevo botón LIMPIAR
6. Crear una función limpiar que no recibe parámetros. La función limpia el mensaje del label lblMensaje.
7. Al presionar el botón LIMPIAR, se ejecutará la función limpiar.
8. En la función limpiar, hacer que también se limpien las cajas de texto, para esto puede usar la función delete de las cajas, por ejemplo
      txtNombre.delete(0,tk.END) #borra el contenido desde la posición 0, hasta el final de la cadena

Subir como evidencia una captura de pantalla del código y otra captura de la ventana ejecutándose.
