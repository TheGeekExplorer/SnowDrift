CREATE DEFINER=`root`@`localhost` PROCEDURE `find_fiveday_for_siteid`(IN inSiteID INT(11))
BEGIN


SELECT
	fiveday.datetime,
    fiveday.wid,
    weathertypes.name as weathertype,
	fiveday.t,
    fiveday.f,
    fiveday.s,
    fiveday.g,
    winddirection.code as d,
    fiveday.h,
    fiveday.p,
    fiveday.u,
    vis.code as vdcode,
    vis.name as vdname

FROM
	weather.fiveday AS fiveday

USE INDEX
	(idx_siteid)

LEFT JOIN
	weather.weather_types AS weathertypes
    USE INDEX FOR JOIN (idx_wtid)
    ON weathertypes.wid = fiveday.wid
    
LEFT JOIN
	weather.winddirection AS winddirection
    USE INDEX FOR JOIN (idx_wdid)
    ON winddirection.wdid = fiveday.wdid
    
LEFT JOIN
	weather.visibility AS vis
    USE INDEX FOR JOIN (idx_visid)
    ON vis.visid = fiveday.vid

WHERE
	fiveday.siteid = inSiteID

ORDER BY
	fiveday.datetime ASC

LIMIT
	0, 5
;

END