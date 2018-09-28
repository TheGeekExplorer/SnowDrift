CREATE DEFINER=`root`@`localhost` PROCEDURE `find_threehour_for_siteid`(IN inSiteID INT(11))
BEGIN


SELECT
	threehour.datetime,
    threehour.wid,
    weathertypes.name as weathertype,
	threehour.t,
    threehour.f,
    threehour.s,
    threehour.g,
    winddirection.code as d,
    threehour.h,
    threehour.p,
    threehour.u,
    vis.code as vdcode,
    vis.name as vdname,
    threehour.updated

FROM
	weather.threehour AS threehour

USE INDEX
	(idx_siteid)

LEFT JOIN
	weather.weather_types AS weathertypes
    USE INDEX FOR JOIN (idx_wtid)
    ON weathertypes.wid = threehour.wid
    
LEFT JOIN
	weather.winddirection AS winddirection
    USE INDEX FOR JOIN (idx_wdid)
    ON winddirection.wdid = threehour.wdid
    
LEFT JOIN
	weather.visibility AS vis
    USE INDEX FOR JOIN (idx_visid)
    ON vis.visid = threehour.vid

WHERE
	threehour.siteid = inSiteID

ORDER BY
	threehour.updated DESC,
    threehour.datetime ASC

LIMIT
	0, 40
;

END