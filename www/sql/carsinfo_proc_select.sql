/*Select query via proc (it's the same as carsinfo_select.sql*/
USE rentacar;
CALL carsinfo_get_row1('Skoda', @retval);
