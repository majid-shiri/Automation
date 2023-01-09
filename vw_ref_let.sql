CREATE VIEW vw_ref_let as
SELECT let.*,
CONCAT(us.us_fname,' ',us.us_lname) AS FullNameSender,
CONCAT(ur.us_fname,' ',ur.us_lname) AS FullNameReciever,
ref.ref_Id,ref.ref_us_FK,ref.ref_sender_FK,ref.ref_readstate,ref.ref_date
FROM letters let
INNER JOIN referencs ref on ref.ref_let_FK=let.let_Id
INNER JOIN users us ON us.us_id=let.let_us_FK
INNER JOIN users ur ON ur.us_id=ref.ref_us_FK