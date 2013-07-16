
--alteraciones de la tabla person, se le agrega sexo.

ALTER TABLE `person` ADD `sexo` CHAR( 1 ) NOT NULL ,
ADD `firmadodocs` CHAR( 1 ) NOT NULL ;

--Este es un pequeño script que puebla todo , ya que estamarcado
--not null-  no puede quedar vacio.

UPDATE person set sexo='M';

-- quedan todos marcados como hombres. si cambias por 'F' mujeres  o sino 
-- para marcar una organizacion 'O'.
-- nadie se salva de tener que poner el sexo correcto a mano.

UPDATE person set firmadodocs='y';

-- aqui lo mismo.