
 
SELECT CONCAT('a_masivo_013@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(m)' AND email
NOT REGEXP '^(ma)'
UNION 
SELECT CONCAT('a_masivo_013@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(m)' AND email
NOT REGEXP '^(ma)'    
 
 UNION 
SELECT CONCAT('a_masivo_014@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(p)'   
UNION 
SELECT CONCAT('a_masivo_014@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(p)' 
 UNION 
SELECT CONCAT('a_masivo_010@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND     email REGEXP '^(s|t)'  
UNION 
SELECT CONCAT('a_masivo_010@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND     email REGEXP '^(s|t)'  
 UNION 
SELECT CONCAT('a_masivo_011@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(u|v|w|x|y|z)' 
UNION 
SELECT CONCAT('a_masivo_011@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(u|v|w|x|y|z)' 
 UNION 
SELECT CONCAT('a_masivo_011@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^[0-9]'  
UNION 
SELECT CONCAT('a_masivo_011@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^[0-9]'  