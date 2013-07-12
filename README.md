Local-Exchange-cat
==================

versión de Local-Exchange 3 , en Catalán y con parches diversos.

=======================================================================

Esta versión es basada en el Local Exchange original de Calvin Priest, con ciertos cambios.

Como la versión original, solo funcionará en servidores con PHP 4. 
Si esta es la solución que necesitas pero tu servidor trabaja en PHP 5, dispones de esta solución para bancos de tiempo, 
también basada en versión original Priest :

https://github.com/lastorset/Local-Exchange

========================================================================

Cambios en esta versión:
-------------------------


-Traducción al catalán (frontend y mensajes).

-Se movió la explicación de que es un banco , de la página principal a una individual,

-Muestra de calendarios Google, (cambiando los códigos por los que Google brinda).

-Se restringe información (telefonos, saldo, etc) de las listas a los usuarios no administrativos.

-El correo enviado entre usuarios usando el formulario de contacto , ahora indica quien lo manda.

-Se introduce una imagen en la portada.

========================================================================

Bugs reparados:
--------------- 

Se han reparado los siguientes problemas y hecho algunos cambios significativos.

-Reparado y sustituido todas  las funciones iconv() que daban errores fatales en muchos servidores(eso esperamos todos, esta función esta
muy repartida ).

-Se cambiaron funciones de mail, ya que las de las librerias terminaba en conflicto, Solo el correo masivo no funciona
correctamente, envia el cuerpo de texto vacío. Puede que en otros servidores esto no ocurra.

-Se corrigieron las cabeceras de los mails llegando estos a la bandeja de entrada y no como spam, 
visualizandose correctamente y con la codificación de caracteres corregida(utf-8).

- Se eliminaron las limitaciones para inscribir ofertas y demandas.

- Las ofertas y demandas no se eliminan, ni desaparecen Automaticamente- De momento es la mejor solución, 
hasta lograr otra forma de eliminarlas y/o marcarlas como obsoletas sin conflictos con el sistema.

-Se preparo una librería Pear acorde con el software, por lo que este no puede funcionar con las librerias comunes y modernas.

========================================================================

Instrucciones importantes para administradores:
------------------------------------------------

Cuando el sotfware llegó a mis manos, ya presentaba cambios, algunos comentados, otros no. Cada asociación
uso este material para suspropias necesidades, modificando ciertos protocolos.

-Si el administrador realiza un pago por un usuario y este usuario no posee las horas , queda en saldo NEGATIVO.
Pero si eso lo realiza un usuario, se activara un mensaje que esto no es posible pues no tienes saldo.

- Se pidió que un usuario enpiece con x cantidad de horas, se modificó el código y las restricciones(útil para las cuentas 
solidarias que pueden acumular muchas horas, ya que antes también tenia una restrinción de maximos). Lo optimo es que se pudieran configurar,
 la idea es unir fuerzas en una nueva versión del software y lograr uan versión estable de este, por lo cual ese tipo de implementación es de licitación incierta.
 
