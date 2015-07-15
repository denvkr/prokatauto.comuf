use rentacar
/*Query notes car almost full description and rent status*/
SELECT
  carsinfo.car_name, 
  carsinfo.photo,
  car_color.color,
  body_type.body_type,
  carsinfo.odometer_value, 
  power.power_type, 
  power_shift.power_shift, 
  power_shift_type.power_shift_type, 
  modification.modification, 
  steering_side.steering_side, 
  transmission.transmission, 
  year_of_production.year_of_production,
  rent_status.rent_status
FROM
  carsinfo,
  modification,
  power,
  power_shift,
  power_shift_type,
  rent_status,
  steering_side,
  transmission,
  year_of_production,
  car_color,
  body_type
WHERE
  carsinfo.modification_id = modification.id AND 
  carsinfo.power_id = power.id AND 
  carsinfo.year_of_production_id = year_of_production.id AND 
  carsinfo.power_shift_id = power_shift.id AND 
  carsinfo.power_shift_type_id = power_shift_type.id AND 
  carsinfo.transmission_id = transmission.id AND
  carsinfo.steering_side_id=steering_side.id AND
  carsinfo.color_id=car_color.color AND
  carsinfo.rent_status_id=rent_status.id and
  carsinfo.body_type_id=body_type.ID
