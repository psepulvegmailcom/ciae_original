SELECT CONCAT('a_masivo_04@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(e|f)' AND email NOT REGEXP '^(es)'    
UNION 
SELECT CONCAT('a_masivo_04@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND    email REGEXP '^(e|f)' AND email NOT REGEXP '^(es)'   
 UNION 
SELECT CONCAT('a_masivo_05@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND     email REGEXP '^(g|h|i)'  UNION 
SELECT CONCAT('a_masivo_05@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND     email REGEXP '^(g|h|i)'   UNION 
SELECT CONCAT('a_masivo_06@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND     email REGEXP '^(j)'  
UNION 
SELECT CONCAT('a_masivo_06@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND     email REGEXP '^(j)'  
 UNION 
SELECT CONCAT('a_masivo_07@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND     email REGEXP '^(l|o|q|es)'  
UNION 
SELECT CONCAT('a_masivo_07@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %' AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND email NOT LIKE '%>%' AND email NOT LIKE '%:%' AND email NOT LIKE '%,%' AND
email NOT LIKE '%@%@%' AND email NOT LIKE '%.'  AND email NOT LIKE '%..%' AND email NOT LIKE '%	%' AND  email NOT LIKE '%@.%' AND   email NOT LIKE '%\%%' AND `email` NOT LIKE '%"%' AND     email REGEXP '^(l|o|q|es)'   
 
 