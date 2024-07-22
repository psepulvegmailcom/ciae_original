SELECT CONCAT('a_masivo_08@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(ma)' 
UNION 
SELECT CONCAT('a_masivo_08@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(ma)' 
UNION 
SELECT CONCAT('a_masivo_09@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(n|r)'   
UNION 
SELECT CONCAT('a_masivo_09@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(n|r)'  
UNION 
SELECT CONCAT('a_masivo_07@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND     email REGEXP '^(l|o|q|es)' 
 UNION 
SELECT CONCAT('a_masivo_08@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(ma)' 