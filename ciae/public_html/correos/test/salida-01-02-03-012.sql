SELECT CONCAT('a_masivo_01@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(a)' 
UNION 
SELECT CONCAT('a_masivo_01@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(a)'  
 UNION 
SELECT CONCAT('a_masivo_02@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(b|d)' 
UNION 
SELECT CONCAT('a_masivo_02@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(b|d)' 
 UNION 
SELECT CONCAT('a_masivo_03@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(ca)' 
UNION 
SELECT CONCAT('a_masivo_03@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(ca)' 
 UNION 
SELECT CONCAT('a_masivo_03@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(k)' 
UNION 
SELECT CONCAT('a_masivo_03@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(k)' 
 UNION 
SELECT CONCAT('a_masivo_012@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND     email REGEXP '^(c)' AND email
NOT REGEXP '^(ca)'  
UNION 
SELECT CONCAT('a_masivo_012@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND     email REGEXP '^(c)' AND email
NOT REGEXP '^(ca)'
