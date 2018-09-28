CREATE DEFINER=`root`@`localhost` PROCEDURE `find_all_sites_for_name_like`(IN inSiteName VARCHAR(255), IN inLimitResults INT(11))
BEGIN

SELECT 
    sites.regionid,
    regions.name as regionname, 
    sites.uaaid,
    uaa.name as uaaname, 
    sites.siteid,
    sites.name as sitename, 
    sites.countryid,
    countries.name as countryname,
    sites.elevation, 
    sites.latitude, 
    sites.longitude

FROM 
    weather.sites as sites

USE INDEX
    (idx_name)

RIGHT OUTER JOIN
    weather.regions AS regions
    USE INDEX FOR JOIN (idx_regionid)
    ON weather.regions.regionid = weather.sites.regionid

RIGHT OUTER JOIN
    weather.unitary_auth_areas AS uaa
    USE INDEX FOR JOIN (idx_uaaid)
    ON weather.uaa.uaaid = weather.sites.uaaid

RIGHT OUTER JOIN
	weather.countries AS countries
    USE INDEX FOR JOIN (idx_countryid)
    ON weather.countries.countryid = weather.sites.countryid

WHERE
    sites.name LIKE inSiteName

GROUP BY
    sites.siteid,
    sites.name,
    sites.regionid,
    sites.uaaid

ORDER BY
    sites.name ASC
    
LIMIT 
    0, inLimitResults
;

END