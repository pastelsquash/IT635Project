DELIMITER //
CREATE PROCEDURE searchParking
(tname VARCHAR(20), searchterm VARCHAR(40))
BEGIN
  IF tname = "users" THEN
  	SELECT user_ID, user_name, user_role, user_email FROM users WHERE user_name LIKE CONCAT("%", searchterm , "%");
  ELSEIF tname = "role" THEN
  	SELECT user_ID, user_name, user_role, user_email FROM users WHERE user_role LIKE CONCAT('%', searchterm , "%");
  ELSEIF tname = "partners" THEN
  	SELECT partners.*, links.zone_ID FROM partners LEFT JOIN links ON partners.partner_ID = links.partner_ID where partners.partner_name LIKE CONCAT("%", searchterm , "%");
  ELSEIF tname = "lots" THEN
  	SELECT * FROM lots WHERE lot_name LIKE CONCAT("%", searchterm , "%");
  ELSEIF tname = "venues" THEN
  	SELECT * FROM venues WHERE venue_name LIKE CONCAT("%", searchterm , "%");
  ELSEIF tname = "zones" THEN
  	SELECT * FROM zones WHERE zone_description LIKE CONCAT("%", searchterm , "%");
  END IF;
END //
DELIMITER ;
