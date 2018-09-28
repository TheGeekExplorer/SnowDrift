CREATE DEFINER=`root`@`localhost` PROCEDURE `find_all_sites_within_distance_of`(IN inLatitude FLOAT(7,4), IN inLongitude FLOAT(7,4), IN inDistance FLOAT(4,1), IN inResultLimit INT(11))
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
    countries.continent,
    sites.elevation, 
    sites.latitude, 
    sites.longitude,
    (3959 * acos(
			cos(radians(inLatitude)) * cos(radians(sites.latitude)) * cos(radians(sites.longitude) - radians(inLongitude)) + 
            sin(radians(inLatitude)) * sin(radians(sites.latitude))
        )
	) AS distance 

FROM 
	sites 

FORCE INDEX
    (idx_latitude, idx_longitude, idx_geo)

LEFT JOIN
    weather.regions AS regions
    FORCE INDEX FOR JOIN (idx_regionid)
    ON weather.regions.regionid = weather.sites.regionid

LEFT JOIN
    weather.unitary_auth_areas AS uaa
    FORCE INDEX FOR JOIN (idx_uaaid)
    ON weather.uaa.uaaid = weather.sites.uaaid

LEFT JOIN
	weather.countries AS countries
    FORCE INDEX FOR JOIN (idx_countryid)
    ON weather.countries.countryid = weather.sites.countryid

WHERE
	sites.latitude  > (inLatitude - 0.5) AND sites.latitude  < (inLatitude + 0.5) AND
    sites.longitude > (inLongitude - 0.5)  AND sites.longitude < (inLongitude + 0.5)

GROUP BY
	sites.regionid,
    regions.name,
    sites.uaaid,
    uaa.name, 
    sites.siteid,
    sites.name, 
    sites.countryid,
    countries.name,
    countries.continent,
    sites.elevation, 
    sites.latitude, 
    sites.longitude,
    distance

HAVING
	distance <= inDistance

ORDER BY 
	distance ASC

LIMIT 
	0, inResultLimit
;


END